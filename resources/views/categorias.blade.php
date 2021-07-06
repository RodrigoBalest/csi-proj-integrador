@extends('layouts.main')

@section('title', 'Categorias')

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
    <h1 class="mt-2">Categorias</h1>

    <table class="table">
        <tbody>
        <?php foreach($dados as $d): ?>
        <tr>
            <td class="col-icones">
                <i class="fas <?= $d['icone']; ?>" style="background-color: var(<?= $d['cor']; ?>)"></i>
            </td>
            <td><?= $d['nome']; ?></td>
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
        <?php endforeach; ?>
        </tbody>
    </table>

    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success">
        <i class="fas fa-plus"></i>
        Nova categoria
    </button>
@endsection

@section('body-end')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="cat-nome">Nome</label>
                            <input type="text" name="nome" id="cat-nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cat-icone">Ícone</label>
                            <select name="icone" id="cat-icone" class="selectpicker form-control">
                                <option data-content="<i class='fas fa-home selectpicker-icone' style='background-color: var(--gray)'></i> Home" value="home">Home</option>
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
