<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fa/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @stack('head')
    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
</head>
<body>

    <main class="d-flex">
        <div class="sidebar bg-dark" id="sidebar">
            <h1><img id="logo" src="{{ asset('assets/img/logo-inv.png') }}" alt="{{ config('app.name') }}"></h1>
            <nav class="mt-3">
                <ul class="nav sidebar-nav">
                    @include('includes.navlink', ['route' => 'dashboard', 'label' => 'Início', 'icon' => 'fas fa-fw fa-home'])
                    @include('includes.navlink', ['route' => 'contas.index', 'label' => 'Contas', 'icon' => 'fas fa-fw fa-wallet'])
                    @include('includes.navlink', ['route' => 'categorias', 'label' => 'Categorias', 'icon' => 'fas fa-fw fa-tags'])
                    @include('includes.navlink', ['route' => 'movimentacoes', 'label' => 'Movimentações', 'icon' => 'fas fa-fw fa-exchange-alt'])
{{--                    @include('includes.navlink', ['route' => 'fixas', 'label' => 'Receitas e despesas fixas', 'icon' => 'fas fa-fw fa-thumbtack'])--}}
{{--                    @include('includes.navlink', ['route' => 'usuarios', 'label' => 'Usuários', 'icon' => 'fas fa-fw fa-user-friends'])--}}
                    @include('includes.navlink', ['route' => 'sair', 'label' => 'Sair', 'icon' => 'fas fa-fw fa-sign-out-alt'])
                </ul>
            </nav>
        </div>
        <main class="container-fluid">
            @yield('content')
        </main>
    </main>

    @yield('body-end')

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    @stack('footer')
</body>
</html>
