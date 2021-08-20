<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use DateInterval;
use DateTime;
use NumberFormatter;

class IndexController extends Controller
{
    private $mvtos;

    public function __construct(Movimentacao $mvtos)
    {
        $this->mvtos = $mvtos;
    }

    public function index()
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

                // Se tem recebe_de, é uma despesa.
                if (! is_null($m->recebe_de)) {
                    $des += $m->valor;
                // Se tem envia_para, é uma receita.
                } elseif(! is_null($m->envia_para)) {
                    $rec += $m->valor;
                }
            };
            $bal = $rec - $des;

            $dados[] = compact('mes', 'rec', 'des', 'bal');
        }
        $fmt = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY );

        return view('dashboard', compact('dados', 'fmt'));
    }
}
