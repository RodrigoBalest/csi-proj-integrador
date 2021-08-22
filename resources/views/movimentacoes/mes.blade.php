@extends('layouts.main')

@section('title', 'Movimentações')

@push('head')
    <style type="text/css">
        .mov-valores {
            width: 150px;
        }

        .selectpicker-icone {
            color: white;
            padding: 0.5em;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            position: relative;
        }

        .selectpicker-icone::before {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    </style>
@endpush

@push('footer')
    <script>
        let mvtos = @json($mvtos);
    </script>
    <script src="{{ asset('assets/js/movimentacoes.js') }}"></script>
@endpush

@section('content')
    <header class="header-movimentacoes d-flex align-items-center justify-content-center">
        <a class="btn btn-light mr-3" href="{{ route('movimentacoes.index', ['mes' => $navMesParams['ant']['mes'], 'ano' => $navMesParams['ant']['ano']]) }}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="my-3">{{ $mesNome }}</h2>
        <a class="btn btn-light ml-3" href="{{ route('movimentacoes.index', ['mes' => $navMesParams['prox']['mes'], 'ano' => $navMesParams['prox']['ano']]) }}">
            <i class="fas fa-arrow-right"></i>
        </a>
    </header>

    <div class="card">
        <ul class="list-group list-group-flush">

            @if($mvtos->count() == 0)
                <li class="list-group-item list-group-item-warning text-center">
                    Não há movimentações cadastradas para este mês.
                </li>
            @endif

            <?php /** @var \App\Models\Movimentacao $mvto */ ?>
            @foreach($mvtos as $mvto)
                @php
                    $tipo = 'transferencia';
                    $tipo = $mvto->is_receita ? 'receita' : $tipo;
                    $tipo = $mvto->is_despesa ? 'despesa' : $tipo;
                @endphp
                <li class="list-group-item d-flex">
                    <div class="mov-icone">
                        <i class="fas {{ $mvto->categoria->icone }}" style="background-color: #{{ $mvto->categoria->cor }}"></i>
                    </div>
                    <div class="mov-dados flex-grow-1">
                        <p class="text-muted"><small>{{ ($mvto->origem ?: $mvto->destino)->nome }}</small></p>
                        <p>{{ ucfirst($mvto->nome) }}</p>
                    </div>
                    <div class="mr-3 d-flex flex-column align-items-end justify-content-end">
                        <div class="btn-group btn-group-sm mb-3" role="group" aria-label="Ações">
                            <button class="btn btn-primary btn-edit-mvto" data-tipo="{{ $tipo }}" data-url="{{ route('movimentacoes.update', $mvto->getKey()) }}" data-key="{{ $mvto->getKey() }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-danger btn-delete-mvto" data-tipo="{{ $tipo }}" data-url="{{ route('movimentacoes.destroy', $mvto->getKey()) }}">
                                <i class="fas fa-trash-alt"></i> Excluir
                            </button>
                        </div>
                    </div>
                    <div class="mov-valores text-right">
                        <p class="text-muted">
                            <small>
                                {{ $mvto->vence_em->isoFormat('DD') }},
                                {{ Str::of($mvto->vence_em->isoFormat('dddd'))->replace('-feira', '')->ucfirst() }}
                            </small>
                        </p>
                        <p class="text-{{ $mvto->is_receita ? 'success' : ($mvto->is_despesa ? 'danger' : 'secondary') }}">
                            {{ $fmt->formatCurrency($mvto->valor, 'BRL') }}
                        </p>
                    </div>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="row">
        <div class="col-md order-md-last text-right p-4 font-weight-bold">
            Total:
            <span class="text-{{ $total > 0 ? 'success' : ($total == 0 ? 'secondary' : 'danger') }} h3 ml-2 font-weight-bold">
                {{ $fmt->formatCurrency($total, 'BRL') }}
            </span>
        </div>
        <div class="col-md order-md-first text-center text-md-left mt-3">
            <div class="btn-group mt-3" role="group" aria-label="Ações">
                <button class="btn btn-danger btn-create-mvto" data-tipo="despesa" data-url="{{ route('movimentacoes.store') }}">
                    <i class="fas fa-minus-circle"></i>
                    Nova despesa
                </button>
                <button class="btn btn-success btn-create-mvto" data-tipo="receita" data-url="{{ route('movimentacoes.store') }}">
                    <i class="fas fa-plus-circle"></i>
                    Nova receita
                </button>
            </div>
        </div>
    </div>
@endsection

@section('body-end')
    <div class="modal fade" id="form-movimentacao-modal" tabindex="-1" aria-hidden="true">
        <form id="form-movimentacao">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form-modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mvto-nome">Nome</label>
                            <input type="text" name="nome" id="mvto-nome" class="form-control">
                            <small class="text-danger input-feedback" id="mvto-nome-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="mvto-valor">Valor:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="valor" id="mvto-valor" class="form-control" value="0" step="0.01">
                            </div>
                            <small class="text-danger input-feedback" id="mvto-valor-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="mvto-cat">Categoria</label>
                            <select name="cat" id="mvto-cat" class="selectpicker form-control">
                                @each('includes.categoriaoption', $categorias, 'cat')
                            </select>
                            <small class="text-danger input-feedback" id="mvto-categoria-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="mvto-conta">Conta</label>
                            <select name="icone" id="mvto-conta" class="selectpicker form-control">
                                @each('includes.contaoption', $contas, 'conta')
                            </select>
                            <small class="text-danger input-feedback" id="mvto-conta-error"></small>
                        </div>
                        <div class="form-group">
                            <label for="mvto-vcto">Vencimento:</label>
                            <div class="input-group">
                                <input type="date" name="vencimento" id="mvto-vcto" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                            <small class="text-danger input-feedback" id="mvto-vencimento-error"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
