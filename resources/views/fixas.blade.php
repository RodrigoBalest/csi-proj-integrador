@extends('layouts.main')

@section('title', 'Receitas e Despesas Fixas')

@push('head')
    <style type="text/css">
        .selectpicker-icone {
            color: white;
            padding: 0.5em;
            border-radius: 50%;
            width: 36px;
            height: 36px;
        }
    </style>
@endpush

@section('content')
    <h1 class="mt-2">Receitas e despesas fixas</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Categoria</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th class="text-right">Valor</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="col-icones">
                <div class="fixa-icone">
                    <i class="fas fa-wallet" style="background-color: var(--green)"></i>
                </div>
            </td>
            <td>Salário</td>
            <td>Receita</td>
            <td class="text-right text-success">R$ 1.859,97</td>
            <td>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-icones">
                <div class="fixa-icone">
                    <i class="fas fa-home" style="background-color: var(--gray)"></i>
                </div>
            </td>
            <td>Aluguel</td>
            <td>Despesa</td>
            <td class="text-right text-danger">R$ 500,00</td>
            <td>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-icones">
                <div class="fixa-icone">
                    <i class="fas fa-wifi" style="background-color: var(--blue)"></i>
                </div>
            </td>
            <td>Internet</td>
            <td>Despesa</td>
            <td class="text-right text-danger">R$ 75,00</td>
            <td>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-icones">
                <div class="fixa-icone">
                    <i class="fas fa-home" style="background-color: var(--gray)"></i>
                </div>
            </td>
            <td>Energia elétrica</td>
            <td>Despesa</td>
            <td class="text-right text-danger">R$ 150,00</td>
            <td>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="btn-group mt-3" role="group" aria-label="Ações">
        <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-minus-circle"></i>
            Nova despesa fixa
        </button>
        <button class="btn btn-success">
            <i class="fas fa-plus-circle"></i>
            Nova receita fixa
        </button>
    </div>
@endsection

@section('body-end')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova despesa fixa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="fixa-nome">Nome</label>
                            <input type="text" name="nome" id="cat-nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="fixa-nome">Dia de vencimento</label>
                            <input type="number" name="nome" id="cat-nome" class="form-control" value="5">
                        </div>
                        <div class="form-group">
                            <label for="fixa-valor">Valor:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" name="valor" id="fixa" class="form-control" value="0" step="0.01">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fixa-cat">Categoria</label>
                            <select name="cat" id="fixa-cat" class="selectpicker form-control">
                                <option data-content="<i class='fas fa-car selectpicker-icone' style='background-color: var(--indigo)'></i> Transporte" value="transporte">Transporte</option>
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
