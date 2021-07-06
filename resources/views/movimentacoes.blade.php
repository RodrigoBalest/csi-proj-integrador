@extends('layouts.main')

@section('title', 'Movimentações')

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
    <h1 class="mt-2">Movimentações</h1>

    <header class="header-movimentacoes d-flex align-items-center justify-content-center">
        <button class="btn btn-light mr-3">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h2 class="my-3">Setembro 2020</h2>
        <button class="btn btn-light ml-3">
            <i class="fas fa-arrow-right"></i>
        </button>
    </header>

    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex">
                <div class="mov-icone">
                    <i class="fas fa-wallet" style="background-color: var(--green)"></i>
                </div>
                <div class="mov-dados flex-grow-1">
                    <p class="text-muted"><small>Carteira</small></p>
                    <p>Salário</p>
                </div>
                <div class="mr-3 d-flex flex-column align-items-end justify-content-end">
                    <i class="far fa-check-square mb-3"></i>
                </div>
                <div class="mov-valores text-right">
                    <p class="text-muted"><small>02, Quinta</small></p>
                    <p class="text-success">R$ 1.859,97</p>
                </div>
            </li>

            <li class="list-group-item d-flex">
                <div class="mov-icone">
                    <i class="fas fa-home" style="background-color: var(--gray)"></i>
                </div>
                <div class="mov-dados flex-grow-1">
                    <p class="text-muted"><small>Carteira</small></p>
                    <p>Aluguel</p>
                </div>
                <div class="mr-3 d-flex flex-column align-items-end justify-content-end">
                    <i class="far fa-square mb-3"></i>
                </div>
                <div class="mov-valores text-right">
                    <p class="text-muted"><small>07, Segunda</small></p>
                    <p class="text-danger">R$ 500,00</p>
                </div>
            </li>

            <li class="list-group-item d-flex">
                <div class="mov-icone">
                    <i class="fas fa-car" style="background-color: var(--indigo)"></i>
                </div>
                <div class="mov-dados flex-grow-1">
                    <p class="text-muted"><small>Carteira</small></p>
                    <p>Combustível</p>
                </div>
                <div class="mr-3 d-flex flex-column align-items-end justify-content-end">
                    <i class="far fa-square mb-3"></i>
                </div>
                <div class="mov-valores text-right">
                    <p class="text-muted"><small>08, Terça</small></p>
                    <p class="text-danger">R$ 100,00</p>
                </div>
            </li>

            <li class="list-group-item d-flex">
                <div class="mov-icone">
                    <i class="fas fa-wifi" style="background-color: var(--blue)"></i>
                </div>
                <div class="mov-dados flex-grow-1">
                    <p class="text-muted"><small>Nubank</small></p>
                    <p>Celular pré pago</p>
                </div>
                <div class="mr-3 d-flex flex-column align-items-end justify-content-end">
                    <i class="far fa-square mb-3"></i>
                </div>
                <div class="mov-valores text-right">
                    <p class="text-muted"><small>08, Terça</small></p>
                    <p class="text-danger">R$ 12,00</p>
                </div>
            </li>
        </ul>
    </div>
    <div class="text-right p-4 font-weight-bold">
        Total: <span class="text-success h3 ml-2 font-weight-bold">R$ 1.247,97</span>
    </div>

    <div class="btn-group mt-3" role="group" aria-label="Ações">
        <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-minus-circle"></i>
            Nova despesa
        </button>
        <button class="btn btn-success">
            <i class="fas fa-plus-circle"></i>
            Nova receita
        </button>
    </div>
@endsection

@section('body-end')
@section('body-end')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova despesa</h5>
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
                        <div class="form-group">
                            <label for="conta-icone">Conta</label>
                            <select name="icone" id="conta-icone" class="selectpicker form-control">
                                <option data-content="<i class='fas fa-wallet selectpicker-icone' style='background-color: var(--green)'></i> Carteira" value="carteira">Carteira</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fixa-valor">Vencimento:</label>
                            <div class="input-group">
                                <input type="date" name="vencimento" id="fixa" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
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
