<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimentacaoRequest;
use App\Http\Requests\MovimentosMesRequest;
use App\Models\Categoria;
use App\Models\Conta;
use App\Models\Movimentacao;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use NumberFormatter;
use Throwable;

class MovimentacaoController extends Controller
{
    private $mvtos;
    private $contas;
    private $categorias;

    public function __construct(Movimentacao $mvtos, Conta $contas, Categoria $categorias)
    {
        $this->mvtos = $mvtos;
        $this->contas = $contas;
        $this->categorias = $categorias;
    }

    /**
     * Exibe um balanço de receitas e despesas para os próximos 12 meses.
     *
     * @return View
     * @throws Exception
     */
    public function dashboard()
    {
        $dados = [];
        for ($k=0; $k<12; $k++) {
            $date = new DateTime();
            $date->add(new DateInterval('P' . $k . 'M'));
            $mes = ucfirst(strftime('%B %Y', $date->getTimestamp()));
            $mvtosMes = $this->mvtos
                ->porMesVcto($date->format('n'))
                ->porAnoVcto($date->format('Y'))
                ->get();

            $rec = 0;
            $des = 0;
            /** @var Movimentacao $m */
            foreach ($mvtosMes as $m) {
                // Se tem recebe_de e envia_para, é uma transferência.
                // Não vamos computar transferências.
                if (! is_null($m->recebe_de) && ! is_null($m->envia_para)) {
                    continue;
                }

                if ($m->is_despesa) {
                    $des += $m->valor;
                } elseif($m->is_receita) {
                    $rec += $m->valor;
                }
            };
            $bal = $rec - $des;

            $dados[] = compact('mes', 'rec', 'des', 'bal');
        }
        $fmt = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY );

        return view('movimentacoes.dashboard', compact('dados', 'fmt'));
    }

    /**
     * Exibe as movimentações de um mês.
     *
     * @param MovimentosMesRequest $request
     * @return View
     */
    public function index(MovimentosMesRequest $request)
    {
        $mes = $request->input('mes');
        $ano = $request->input('ano');

        $mvtos = $this->mvtos->porMesVcto($mes)->porAnoVcto($ano)->orderBy('vence_em', 'asc')->get();

        $total = $mvtos->map(function (Movimentacao $mvto) {
            if ($mvto->is_receita) {
                return $mvto->valor;
            } elseif ($mvto->is_despesa) {
                return $mvto->valor * -1;
            }
        })->sum();

        $date = Date::create($ano, $mes, 1);
        $mesNome = ucfirst(strftime('%B %Y', $date->getTimestamp()));
        $fmt = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY );

        $navMesParams = [
            'prox' => [
                'mes' => $mes == 12 ? 1 : $mes+1,
                'ano' => $mes == 12 ? $ano+1 : $ano
            ],
            'ant' => [
                'mes' => $mes == 1 ? 12 : $mes-1,
                'ano' => $mes == 1 ? $ano-1 : $ano
            ]
        ];

        $categorias = $this->categorias->orderBy('nome', 'asc')->get();
        $contas = $this->contas->orderBy('nome', 'asc')->get();

        $dados = compact(
            'mes',
            'ano',
            'mesNome',
            'fmt',
            'mvtos',
            'total',
            'navMesParams',
            'contas',
            'categorias'
        );

        return view('movimentacoes.mes', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MovimentacaoRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(MovimentacaoRequest $request)
    {
        $recebe_de = null;
        $envia_para = null;
        $tipo = $request->input('tipo');
        if ($tipo == 'receita') {
            $envia_para = $request->input('conta');
        } elseif ($tipo == 'despesa') {
            $recebe_de = $request->input('conta');
        }

        $mvto = $this->mvtos->newInstance([
            'nome' => $request->input('nome'),
            'valor' => $request->input('valor'),
            'vence_em' => $request->input('vencimento'),
            'categoria_id' => $request->input('categoria'),
            'recebe_de' => $recebe_de,
            'envia_para' => $envia_para,
            'usuario_id' => Auth::id()
        ]);

        $mvto->saveOrFail();

        $request->session()->flash('success', ucfirst($tipo) . ' cadastrada.');
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MovimentacaoRequest $request
     * @param Movimentacao $movimentacao
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(MovimentacaoRequest $request, Movimentacao $movimentacao)
    {
        $recebe_de = null;
        $envia_para = null;
        $tipo = $request->input('tipo');
        if ($tipo == 'receita') {
            $envia_para = $request->input('conta');
        } elseif ($tipo == 'despesa') {
            $recebe_de = $request->input('conta');
        }

        $movimentacao->nome = $request->input('nome');
        $movimentacao->valor = $request->input('valor');
        $movimentacao->vence_em = $request->input('vencimento');
        $movimentacao->categoria_id = $request->input('categoria');
        $movimentacao->recebe_de = $recebe_de;
        $movimentacao->envia_para = $envia_para;

        $movimentacao->saveOrFail();

        $request->session()->flash('success', 'Movimentação atualizada.');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Movimentacao $movimentacao
     * @return JsonResponse
     */
    public function destroy(Request $request, Movimentacao $movimentacao)
    {
        if ($movimentacao->delete()) {
            $request->session()->flash('success', 'Movimentação excluída!');
            $success = true;
        } else {
            $request->session()->flash('warning', 'Não foi possível excluir a movimentação.');
            $success = false;
        }
        return response()->json(['success' => $success]);
    }
}
