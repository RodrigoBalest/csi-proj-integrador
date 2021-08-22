$(function () {
    let $form = $('#form-movimentacao');
    let $modal = $('#form-movimentacao-modal');
    let $modalTitle = $('#form-modal-title');
    let $btnSubmit = $form.find('button[type="submit"]');
    let url = '';
    let method = '';
    let tipo = '';

    // Manipula clicks nos botões de criar nova movimentação.
    $('.btn-create-mvto').on('click', function (ev) {
        ev.preventDefault();
        tipo = $(this).data('tipo');
        url = $(this).data('url');
        method = 'POST';
        $form.get(0).reset();
        if (tipo === 'receita') {
            $modalTitle.html('Nova receita');
        } else if (tipo === 'despesa') {
            $modalTitle.html('Nova despesa');
        }
        $form.find('.input-feedback').empty();
        $modal.modal('show');
    });

    // Manipula clicks nos botões de editar movimentação.
    $('.btn-edit-mvto').on('click', function (ev) {
        ev.preventDefault();
        tipo = $(this).data('tipo');
        let conta_id;
        url = $(this).data('url');
        method = 'PATCH';
        let key = $(this).data('key');
        let mvto;
        mvtos.forEach(function (c) {
            if (c.id === key) {
                mvto = c;
            }
        });
        if (mvto === undefined) {
            console.error('Movimentação selecionada não encontrada no objeto global \'mvtos\': key=' + key);
            return;
        }
        if (tipo === 'receita') {
            $modalTitle.html('Editar receita');
            conta_id = mvto.envia_para;
        } else if (tipo === 'despesa') {
            $modalTitle.html('Editar despesa');
            conta_id = mvto.recebe_de;
        }

        $('#mvto-nome').val(mvto.nome);
        $('#mvto-valor').val(mvto.valor);
        $('#mvto-cat').val(mvto.categoria_id);
        $('#mvto-conta').val(conta_id);
        $('#mvto-vcto').val(mvto.vence_em);
        $('.selectpicker').selectpicker('refresh');
        console.dir(mvto);
        $form.find('.input-feedback').empty();
        $modal.modal('show');
    });

    // Manipula o envio do formulário.
    $form.on('submit', function (ev) {
        ev.preventDefault();
        let dados = {
            tipo: tipo,
            nome: $('#mvto-nome').val(),
            valor: $('#mvto-valor').val(),
            categoria: $('#mvto-cat').val(),
            conta: $('#mvto-conta').val(),
            vencimento: $('#mvto-vcto').val()
        };
        $btnSubmit.prop('disabled', true).prepend('<i class="fas fa-spinner fa-pulse mr-1"></i>');
        $form.find('.input-feedback').empty();
        $.ajax({
            url: url,
            method: method,
            data: dados
        }).done(function () {
            window.location.reload();
        }).fail(function (data) {
            // Mostra os erros de validação, se houverem.
            if (data.status === 422) {
                for (let key in data.responseJSON.errors) {
                    let idTarget = '#mvto-' + key + '-error';
                    let erros = data.responseJSON.errors[key];
                    $(idTarget).text(erros.join('<br>'));
                }
            } else {
                alert('Erro ' + data.status + ': ' + data.statusText);
            }
        }).always(function() {
            // Reseta o botão de envio.
            $btnSubmit.prop('disabled', false).find('.fas').remove();
        });
    });

    // Manipula clicks nos botões de excluir movimentação.
    $('.btn-delete-mvto').on('click', function (ev) {
        ev.preventDefault();
        if (! confirm('Deseja mesmo excluir esta movimentação?')) {
            return;
        }
        let $btn = $(this);
        let deleteUrl = $btn.data('url');
        $btn.prop('disabled', true).find('i').toggleClass('fa-trash-alt fa-spinner fa-pulse');
        $.ajax({
            url: deleteUrl,
            method: 'DELETE'
        }).done(function () {
            window.location.reload();
        }).fail(function (data) {
            alert('Erro ' + data.status + ': ' + data.statusText);
            $btn.prop('disabled', false).find('i').toggleClass('fa-trash-alt fa-spinner fa-pulse');
        })
    });
});
