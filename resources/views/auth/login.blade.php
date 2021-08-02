@extends('layouts.auth')

@section('title', 'Acessar')

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
            margin-inline: auto;
        }
        form a {
            text-decoration: none;
        }
        .bg-dark form a {
            color: #fdb811;
            text-shadow: -1px -1px 1px #222;
        }
    </style>
@endpush

@section('content')
    @if (session('status'))
        <span class="alert alert-success">{{ session('status') ?? '' }} </span>
    @endif

    <div class="text-center w-100">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Acesse sua conta</h1>

        @if ($message = session('success'))
            <div class="text-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <form method="post" action="{{ route('login.post') }}">
            <div class="form-group">
                <label for="inputEmail" class="sr-only">E-mail</label>
                <input type="email" id="inputEmail" class="@error('email') is-invalid @enderror form-control" placeholder="E-mail" name="email" required autofocus>
                @error('email')<small class="text-danger font-italic">{{ $message }}</small>@enderror
            </div>
            <div class="form-group mb-3">
                <label for="inputPassword" class="sr-only">Senha</label>
                <input type="password" id="inputPassword" class="@error('password') is-invalid @enderror form-control" placeholder="Senha" name="password" required>
                @error('password')<small class="text-danger font-italic">{{ $message }}</small>@enderror
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Mantenha-me conectado
                </label>
            </div>
            @csrf
            <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Acessar</button>
            <p><a href="{{ route('register.get') }}">Criar minha conta</a></p>
            <p><a href="{{ route('password.request') }}">Esqueci minha senha</a></p>
        </form>
    </div>
@endsection
