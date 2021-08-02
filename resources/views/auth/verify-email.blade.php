@extends('layouts.auth')

@section('title', 'Verificar e-mail')

@push('head')
    <style type="text/css">
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
    <div class="text-center">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Verificar e-mail</h1>

        <p class="verify-msg">Obrigado por se registar! Antes de começar, poderia confirmar o seu endereço de e-mail clicando no link presente no e-mail que acabamos de te enviar?<br>
            Caso não tenha recebido o email, teremos o maior prazer em reenviar-lhe outro.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="text-success">
                <strong>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</strong>
            </div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">{{ __('Resend Verification Email') }}</button>

            <p><a href="{{ route('logout') }}">Sair</a></p>
        </form>
    </div>
@endsection
