@extends('layouts.auth')

@section('title', 'Esqueci a senha')

@push('head')
    <style type="text/css">
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
    @if (session('status'))
        <span class="alert alert-success">{{ session('status') ?? '' }} </span>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Esqueci minha senha</h1>

        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

        @csrf

        <div class="form-group">
            <input type="email" name="email" id="inputEmail" value="{{ old('email') }}" placeholder="Informe seu e-mail" class="@error('email') is-invalid @enderror form-control" required>
            @error('email')<small class="text-danger font-italic">{{ $message }}</small>@enderror
        </div>

        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Me envie o link!</button>
    </form>
@endsection
