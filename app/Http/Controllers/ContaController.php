<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ContaController extends Controller
{
    private $contas;

    public function __construct(Conta $contas)
    {
        $this->contas = $contas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vars['contas'] = $this->contas->orderBy('created_at')->get();
        $vars['icones'] = $this->contas->getIcones();

        return view('contas.index', $vars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContaRequest $request
     * @return Response
     * @throws Throwable
     */
    public function store(ContaRequest $request)
    {
        $conta = $this->contas->newInstance([
            'nome' => $request->input('nome'),
            'valor_inicial' => $request->input('valor_inicial'),
            'icone' => $request->input('icone'),
            'usuario_id' => Auth::id()
        ]);

        $conta->saveOrFail();

        $request->session()->flash('success', 'Conta criada!');
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContaRequest $request
     * @param Conta $conta
     * @return Response
     * @throws Throwable
     */
    public function update(ContaRequest $request, Conta $conta)
    {
        $conta->nome = $request->input('nome');
        $conta->valor_inicial = $request->input('valor_inicial');
        $conta->icone = $request->input('icone');

        $conta->saveOrFail();

        $request->session()->flash('success', 'Conta alterada!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Conta $conta
     * @return JsonResponse
     */
    public function destroy(Request $request, Conta $conta)
    {
        $numContas = $this->contas->count();
        if ($numContas > 1) {
            $conta->delete();
            $request->session()->flash('success', 'Conta excluída!');
            return response()->json(['success' => true]);
        }

        $request->session()->flash('warning', 'Não é possível excluir a única conta.');
        return response()->json(['success' => false]);
    }
}
