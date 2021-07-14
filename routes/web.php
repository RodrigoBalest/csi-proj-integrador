<?php

use App\Http\Controllers\ContaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('contas', ContaController::class);





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
})->name('dashboard');

Route::get('/login', function () {
    return view('auth.login');
});





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
})->name('categorias');

Route::get('/movimentacoes', function () {
    return view('movimentacoes');
})->name('movimentacoes');

Route::get('/fixas', function () {
    return view('fixas');
})->name('fixas');

Route::get('/usuarios', function () {
    return view('usuarios');
})->name('usuarios');

Route::get('/sair', function () {
    return view('login');
})->name('sair');

Route::get('/cadastrar', function () {
    return view('cadastrar');
})->name('cadastrar');
