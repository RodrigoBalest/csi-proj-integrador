$(function () {
    let $form = $('#form-conta');
    let $modal = $('#form-conta-modal');
    let $modalTitle = $('#form-modal-title');
    let $btnSubmit = $form.find('button[type="submit"]');
    let url = '';
    let method = '';

    // Manipula clicks no botão de criar nova conta.
    $('.btn-create-conta').on('click', function (ev) {
        ev.preventDefault();
        url = $(this).data('url');
        method = 'POST';
        $form.get(0).reset();
        $('#conta-icone').selectpicker('refresh');
        $modalTitle.html('Nova conta');
        $form.find('.input-feedback').empty();
        $modal.modal('show');
    });

    // Manipula clicks nos botões de editar conta.
    $('.btn-edit-conta').on('click', function (ev) {
        ev.preventDefault();
        url = $(this).data('url');
        method = 'PATCH';
        let key = $(this).data('key');
        let conta;
        contas.forEach(function (c) {
           if (c.id === key) {
               conta = c;
           }
        });
        if (conta === undefined) {
            console.error('Conta selecionada não encontrada no objeto global \'contas\': key=' + key);
            return;
        }
        $modalTitle.html('Editar conta');
        $('#conta-nome').val(conta.nome);
        $('#conta-vi').val(conta.valor_inicial);
        $('#conta-icone').selectpicker('val', conta.icone);
        $form.find('.input-feedback').empty();
        $modal.modal('show');
    });

    // Manipula o envio do formulário.
    $form.on('submit', function (ev) {
        ev.preventDefault();
        let dados = {
            nome: $('#conta-nome').val(),
            valor_inicial: $('#conta-vi').val(),
            icone: $('#conta-icone').val()
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
                    let idTarget = (key === 'valor_inicial') ? 'vi' : key;
                    idTarget = '#conta-' + idTarget + '-error';
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

    // Manipula clicks nos botões de excluir conta.
    $('.btn-delete-conta').on('click', function (ev) {
        ev.preventDefault();
        if (! confirm('Deseja mesmo excluir esta conta?\nTodas as movimentações desta conta também serão excluídas.')) {
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
