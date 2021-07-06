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
        .form-login {
            width: 100%;
            max-width: 330px;
            padding: 15px;
        }
        .form-login a {
            text-decoration: none;
        }
        .bg-dark .form-login a {
            color: #fdb811;
            text-shadow: -1px -1px 1px #222;
        }
    </style>
@endpush

@section('content')
    <form class="form-login text-center">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Acesse sua conta</h1>
        <label for="inputEmail" class="sr-only">E-mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Senha" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Mantenha-me conectado
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Acessar</button>
        <p><a href="{{ route('cadastrar') }}">Criar minha conta</a></p>
    </form>
@endsection
