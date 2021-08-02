<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fa/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <style type="text/css">
        html, body, main {
            height: 100%;
        }
        .bg-dark .form-control {
            background-color: #4e5861;
            color: #ddd;
            border-color: #2d3338;
        }
        .bg-dark .form-control::placeholder {
            color: #aaa;
        }
    </style>
    @stack('head')
    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
</head>
<body class="bg-dark text-light">

    <main class="d-flex flex-column justify-content-center align-items-center">
        @yield('content')
    </main>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @stack('footer')
</body>
</html>
