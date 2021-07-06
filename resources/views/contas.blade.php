@extends('layouts.main')

@section('title', 'Contas')

@push('head')
    <style type="text/css">
        .bootstrap-select .icone-conta {
            padding: 0.5em;
            display: inline-block;
            vertical-align: middle;
        }
        .bootstrap-select .icone-conta img {
            width: 1.5em;
            height: 1.5em;
        }
    </style>
@endpush

@section('content')
    <h1 class="mt-2">Contas</h1>

    <div class="card-deck">
        <div class="card p-3 mb-3 flex-row">
            <div>
                <div class="icone-conta text-center mr-3" style="background-color: var(--green)">
                    <img src="{{ asset('assets/img/wallet-solid.svg') }}" alt="Carteira">
                </div>
            </div>
            <div>
                <h2>Carteira</h2>
                <table class="table table-sm table-borderless width-auto">
                    <tr>
                        <th>Valor inicial:</th>
                        <td class="text-right">R$ 0,00</td>
                    </tr>
                    <tr>
                        <th>Valor atual:</th>
                        <td class="text-right">R$ 1.345,66</td>
                    </tr>
                </table>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </div>
        </div>

        <div class="card p-3 mb-3 flex-row">
            <div>
                <div class="icone-conta text-center mr-3" style="background-color:#FFF22D; color:#33348E;">
                    <img src="{{ asset('assets/img/bb.svg') }}" alt="Banco do Brasil">
                </div>
            </div>
            <div>
                <h2>CC Banco do Brasil</h2>
                <table class="table table-sm table-borderless width-auto">
                    <tr>
                        <th>Valor inicial:</th>
                        <td class="text-right">R$ 100,00</td>
                    </tr>
                    <tr>
                        <th>Valor atual:</th>
                        <td class="text-right">R$ 926,18</td>
                    </tr>
                </table>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </div>
        </div>

        <div class="card p-3 mb-3 flex-row">
            <div>
                <div class="icone-conta text-center mr-3" style="background-color:#8a05be;">
                    <img src="{{ asset('assets/img/nubank.svg') }}" alt="Nubank">
                </div>
            </div>
            <div>
                <h2>Nubank</h2>
                <table class="table table-sm table-borderless width-auto">
                    <tr>
                        <th>Valor inicial:</th>
                        <td class="text-right">R$ 0,00</td>
                    </tr>
                    <tr>
                        <th>Valor atual:</th>
                        <td class="text-right">R$ 600,00</td>
                    </tr>
                </table>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success">
        <i class="fas fa-plus"></i>
        Nova conta
    </button>
@endsection

@section('body-end')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="conta-nome">Nome</label>
                            <input type="text" name="nome" id="conta-nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="conta-vi">Valor inicial</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="valor" id="conta-vi" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="conta-icone">Ícone</label>
                            <select name="icone" id="conta-icone" class="selectpicker form-control">
                                <option data-content="<div class='icone-conta text-center mr-3' style='background-color:var(--green);'><img src='{{ asset('assets/img/wallet-solid.svg') }}' alt='Carteira'></div> Carteira" value="carteira">Carteira</option>
                                <option data-content="<div class='icone-conta text-center mr-3' style='background-color:#FFF22D; color:#33348E;'><img src='{{ asset('assets/img/bb.svg') }}' alt='Banco do Brasil'></div> Banco do Brasil" value="bb">Banco do Brasil</option>
                                <option data-content="<div class='icone-conta text-center mr-3' style='background-color:#8a05be;'><img src='{{ asset('assets/img/nubank.svg') }}' alt='Nubank'></div> Nubank" value="nubank">Nubank</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
