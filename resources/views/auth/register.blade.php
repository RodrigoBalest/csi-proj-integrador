@extends('layouts.auth')

@section('title', 'Registre-se')

@push('head')
    <style type="text/css">
        .checkbox label {
            font-weight: normal;
        }

        .form-control {
            padding: 10px;
        }

        form {
            width: 100%;
            max-width: 330px;
            padding: 15px;
        }

        form a {
            text-decoration: none;
        }

        .bg-dark form a {
            color: #fdb811;
            text-shadow: -1px -1px 1px #222;
        }

        form label {
            font-weight: normal;
            font-size: 0.8em;
            text-align: left;
            display: block;
            margin: 0 0 0 .5em;
        }
    </style>
@endpush

@section('content')
    <form class="text-center" method="post" action="{{ route('register.post') }}">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Criar minha conta</h1>

        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" name="nome" id="inputNome" value="{{ old('nome') }}" class="@error('nome') is-invalid @enderror form-control" required autofocus>
            @error('nome')<small class="text-danger font-italic">{{ $message }}</small>@enderror
        </div>

        <div class="form-group">
            <label for="inputEmail">E-mail</label>
            <input type="email" name="email" id="inputEmail" value="{{ old('email') }}" class="@error('email') is-invalid @enderror form-control" required>
            @error('email')<small class="text-danger font-italic">{{ $message }}</small>@enderror
        </div>

        <div class="form-group">
            <label for="inputPassword">Senha</label>
            <input type="password" name="senha" id="inputPassword" class="@error('senha') is-invalid @enderror form-control" required>
            <small class="font-italic text-muted">A senha deve ter pelo menos 8 caracteres.</small>
            @error('senha')<small class="text-danger font-italic">{{ $message }}</small>@enderror
        </div>

        <div class="form-group mb-4">
            <label for="inputPassword2">Confirme sua senha</label>
            <input type="password" name="senha_confirmation" id="inputPassword2" class="form-control" required>
        </div>

        {{ csrf_field() }}

        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Criar conta</button>
        <p><a href="{{ route('login') }}">Já tenho uma conta</a></p>
    </form>
@endsection
