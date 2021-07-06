@extends('layouts.main')

@section('title', 'Painel')

@section('content')
    <h1 class="mt-2">Usuários</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Fulano de Tal</td>
                <td>fulano@fulano.com</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i> Remover
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="btn-group mt-3" role="group" aria-label="Ações">
        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus-circle"></i>
            Convidar outro usuário
        </button>
    </div>
@endsection

@section('body-end')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Convidar outro usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="usuario-email">E-mail</label>
                            <input type="text" name="email" id="cat-nome" class="form-control">
                            <small class="form-text text-muted">Informe o e-mail da pessoa que você quer convidar.</small>
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
