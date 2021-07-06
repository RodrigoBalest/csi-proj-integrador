@extends('layouts.auth')

@section('title', 'Acessar')

@push('head')
    <style type="text/css">
        #inputEmail {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        #inputPassword {
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }
        .checkbox label {
            font-weight: normal;
        }
        .form-control {
            padding: 10px;
        }
        .form-cadastrar {
            width: 100%;
            max-width: 330px;
            padding: 15px;
        }
        .form-cadastrar a {
            text-decoration: none;
        }
        .bg-dark .form-cadastrar a {
            color: #fdb811;
            text-shadow: -1px -1px 1px #222;
        }
        .form-cadastrar label {
            font-weight: normal;
            font-size: 0.8em;
            text-align: left;
            display: block;
            margin: 0 0 0 .5em;
        }
    </style>
@endpush

@section('content')
    <form class="form-cadastrar text-center">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Criar minha conta</h1>

        <label for="inputNome">Nome</label>
        <input type="text" id="inputNome" class="form-control mb-2" required autofocus>

        <label for="inputEmail">E-mail</label>
        <input type="email" id="inputEmail" class="form-control mb-2" required>

        <label for="inputPassword">Senha</label>
        <input type="password" id="inputPassword" class="form-control mb-2" required>

        <label for="inputPassword2">Confirme sua senha</label>
        <input type="password" id="inputPassword2" class="form-control mb-4" required>

        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Criar conta</button>
        <p><a href="{{ route('sair') }}">Já tenho uma conta</a></p>
    </form>
@endsection
