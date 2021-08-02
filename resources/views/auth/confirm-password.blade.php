@extends('layouts.auth')

@section('title', 'Confirme sua senha')

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
    <form method="POST" action="{{ route('password.confirm') }}">
        <img src="{{ asset('assets/img/logo-inv.png') }}" alt="Pataka - Gerenciador financeiro pessoal" class="mb-4">
        <h1 class="h3 mb-3">Confirme sua senha</h1>

        <p>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>

        @csrf

        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Confirme sua senha" class="@error('password') is-invalid @enderror form-control" required>
            @error('password')<small class="text-danger font-italic">{{ $message }}</small>@enderror
        </div>

        <button class="btn btn-lg btn-primary btn-block mb-3" type="submit">Confirmar</button>
    </form>
@endsection
