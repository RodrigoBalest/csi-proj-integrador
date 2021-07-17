@extends('layouts.main')

@section('title', 'Contas')

@push('head')
    <style type="text/css">
        .bootstrap-select img {
            width: 1.5em;
            height: 1.5em;
        }
        .bootstrap-select .dropdown-item {
            padding: .25rem .75rem;
        }
    </style>
@endpush

@push('footer')
    <script>
        let contas = @json($contas);
    </script>
    <script src="{{ asset('assets/js/contas.js') }}"></script>
@endpush

@section('content')
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    @php /** @var \App\Models\Conta $conta */ @endphp
    @foreach($contas as $conta)
        <div class="col">
            <div class="card p-3 mb-3 flex-row">
                <div class="col-conta-icone mr-3 flex-shrink-0">
                    <img src="{{ asset('assets/logos/' . $conta->icone . '.svg') }}" alt="{{ $conta->nome }}">
                </div>
                <div class="flex-grow-1">
                    <h3 class="h4">{{ $conta->nome }}</h3>
                    <table class="table table-sm table-borderless width-auto">
                        <tr>
                            <th>Valor inicial:</th>
                            <td class="text-right">R$ {{ number_format($conta->valor_inicial, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Saldo atual:</th>
                            <td class="text-right">R$ {{ number_format($conta->saldo_atual, 2, ',', '.') }}</td>
                        </tr>
                    </table>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <button class="btn btn-sm btn-primary btn-edit-conta" data-url="{{ route('contas.update', $conta->getKey()) }}" data-key="{{ $conta->getKey() }}">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete-conta" data-url="{{ route('contas.destroy', $conta->getKey()) }}">
                            <i class="fas fa-trash-alt"></i> Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <button data-url="{{ route('contas.store') }}" class="btn btn-success btn-create-conta">
        <i class="fas fa-plus"></i>
        Nova conta
    </button>
@endsection

@section('body-end')
    <div class="modal fade" id="form-conta-modal" tabindex="-1" aria-labelledby="form-modal-title" aria-hidden="true">
        <form id="form-conta">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form-modal-title">Nova conta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="conta-nome">Nome</label>
                                <input type="text" name="nome" id="conta-nome" class="form-control">
                                <small class="text-danger input-feedback" id="conta-nome-error"></small>
                            </div>
                            <div class="form-group">
                                <label for="conta-vi">Valor inicial</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" name="valor_inicial" id="conta-vi" class="form-control" value="0" step="0.01">
                                </div>
                                <small class="text-danger input-feedback" id="conta-vi-error"></small>
                            </div>
                            <div class="form-group">
                                <label for="conta-icone">Ícone</label>
                                <select name="icone" id="conta-icone" name="icone" class="selectpicker form-control">
                                @foreach($icones as $chave => $nome)
                                    <option data-content="<img src='{{ asset('assets/logos/' . $chave . '.svg') }}' alt='{{ $nome }}'> {{ $nome }}" value="{{ $chave }}">{{ $nome }}</option>
                                @endforeach
                                </select>
                                <small class="text-danger input-feedback" id="conta-icone-error"></small>
                            </div>
                        </form>
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
