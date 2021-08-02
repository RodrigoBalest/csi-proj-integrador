<?php

use App\Http\Controllers\ContaController;
use Illuminate\Support\Facades\Route;

Route::resource('contas', ContaController::class)
    ->except(['create', 'show', 'edit'])
    ->middleware(['auth', 'verified']);

Route::get('/info', function () {
    return phpinfo();
});

Route::get('/', function () {
    $dados = [];
    for ($k=0; $k<12; $k++) {
        //    $mes = date('n') + $k;
        //    $mes = date($mes % 12);

        $date = new DateTime();
        $date->add(new DateInterval('P' . $k . 'M'));
        $mes = utf8_encode(ucfirst(strftime('%B %Y', $date->getTimestamp())));
        $rec = 1500 + (rand(1, 100000) / 100);
        $des = 1400 + (rand(1, 100000) / 100);
        $bal = $rec - $des;

        $dados[] = compact('mes', 'rec', 'des', 'bal');
    }
    $fmt = new NumberFormatter(config('locale'), NumberFormatter::CURRENCY );
    return view('dashboard', compact('dados', 'fmt'));
})->name('dashboard')->middleware(['auth', 'verified']);


Route::get('/categorias', function () {
    $dados = [
        [
            'icone' => 'fa-home',
            'cor' => '--gray',
            'nome' => 'Moradia'
        ], [
            'icone' => 'fa-car',
            'cor' => '--indigo',
            'nome' => 'Transporte'
        ], [
            'icone' => 'fa-wifi',
            'cor' => '--blue',
            'nome' => 'Serviços'
        ], [
            'icone' => 'fa-shopping-cart',
            'cor' => '--teal',
            'nome' => 'Mercado'
        ], [
            'icone' => 'fa-gamepad',
            'cor' => '--cyan',
            'nome' => 'Lazer'
        ]
    ];
    return view('categorias', compact('dados'));
})->name('categorias')->middleware(['auth', 'verified']);

Route::get('/movimentacoes', function () {
    return view('movimentacoes');
})->name('movimentacoes')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
