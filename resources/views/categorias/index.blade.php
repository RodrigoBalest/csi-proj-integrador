@extends('layouts.main')

@section('title', 'Categorias')

@push('head')
    <style type="text/css">
        #cat-cor {
            max-width: 100px;
        }
        .icon-picker .dropdown-item {
            width: auto;
            padding: .25em .5em;
        }
        .tbl-lista-categorias td {
            vertical-align: middle;
        }
    </style>
@endpush

@push('footer')
    <script>
        let categorias = @json($categorias);
    </script>
    <script src="{{ asset('assets/js/categorias.js') }}"></script>
@endpush

@section('content')
    <table class="table tbl-lista-categorias">
        <tbody>
        @php /** @var \App\Models\Categoria $cat */ @endphp
        <?php foreach($categorias as $cat): ?>
        <tr>
            <td class="col-icones">
                <i class="fas fa-fw <?= $cat['icone']; ?>" style="background-color: #<?= $cat['cor']; ?>"></i>
            </td>
            <td><?= $cat['nome']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Ações">
                    <button class="btn btn-sm btn-primary btn-edit-categoria" data-url="{{ route('categorias.update', $cat->getKey()) }}" data-key="{{ $cat->getKey() }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    @if($categorias->count() > 1)
                    <button class="btn btn-sm btn-danger btn-delete-categoria" data-url="{{ route('categorias.destroy', $cat->getKey()) }}">
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                    @endif
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button data-url="{{ route('categorias.store') }}" class="btn btn-success btn-create-categoria">
        <i class="fas fa-plus"></i>
        Nova categoria
    </button>
@endsection

@section('body-end')
    <div class="modal fade" id="form-categoria-modal" tabindex="-1" aria-hidden="true">
        <form id="form-categoria">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form-modal-title">Nova categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cat-nome">Nome</label>
                            <input type="text" name="nome" id="cat-nome" class="form-control">
                            <small class="text-danger input-feedback" id="cat-nome-error"></small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="cat-cor">Cor</label>
                                <input type="color" id="cat-cor" name="cor" class="form-control">
                                <small class="text-danger input-feedback" id="cat-cor-error"></small>
                            </div>
                            <div class="form-group col-6">
                                <label for="cat-icone">Ícone</label>
                                <div class="dropdown icon-picker" id="icon-picker">
                                    <input type="hidden" name="icone" value="">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="selected-icon">&nbsp;</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-container d-inline-flex flex-wrap">
                                            @foreach($icones as $icone)
                                                <a class="dropdown-item" href="#" data-value="{{ $icone }}"><i class="fas fa-fw {{ $icone }}"></i></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <small class="text-danger input-feedback" id="cat-icone-error"></small>
                            </div>
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
