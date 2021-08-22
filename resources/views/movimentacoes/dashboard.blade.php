@extends('layouts.main')

@section('title', 'Painel')

@section('content')
    <div class="card">
        <div class="card-header">
            Balanço próximos meses
        </div>
        <table class="table table-sm mb-0">
            <thead class="thead-dark">
                <tr>
                    <th class="pl-3">Mês</th>
                    <th class="text-right">Receitas</th>
                    <th class="text-right">Despesas</th>
                    <th class="text-right pr-3">Balanço</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dados as $mes)
                <tr>
                    <th class="pl-3">{{ $mes['mes'] }}</th>
                    <td class="text-right">{{ $fmt->formatCurrency($mes['rec'], 'BRL') }}</td>
                    <td class="text-right">{{ $fmt->formatCurrency($mes['des'], 'BRL') }}</td>
                    <td class="pr-3 text-right font-weight-bold text-{{ ($mes['bal'] < 0) ? 'danger' : 'success' }}">
                        {{ $fmt->formatCurrency($mes['bal'], 'BRL') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
