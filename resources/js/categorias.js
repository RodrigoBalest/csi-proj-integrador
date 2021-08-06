$(function () {
    let $form = $('#form-categoria');
    let $modal = $('#form-categoria-modal');
    let $modalTitle = $('#form-modal-title');
    let $btnSubmit = $form.find('button[type="submit"]');
    let url = '';
    let method = '';

    let iconeSelector = function () {
       let $container = $('#icon-picker');
       let $input = $container.find('input');
       let $display = $container.find('.selected-icon');
       let $options = $container.find('.dropdown-item');
       let val = $input.val();

       if (val !== '') {
           setVal(val);
       }

       $options.on('click', function (ev) {
          ev.preventDefault();
          let val = $(this).data('value');
          setVal(val);
       });

       function reset() {
           $input.val('');
           $display.html('');
       }

       function setVal(_val) {
           val = _val;
           $input.val(_val);
           let html = '<i class="fas fa-fw ' + _val + '"></i>';
           $display.html(html);
       }

       function getVal() {
           return val
       }

       return {
           reset: reset,
           setVal: setVal,
           getVal: getVal
       };
    }();

    // Manipula clicks no botão de criar nova categoria.
    $('.btn-create-categoria').on('click', function (ev) {
        ev.preventDefault();
        url = $(this).data('url');
        method = 'POST';
        $form.get(0).reset();
        iconeSelector.reset();
        $modalTitle.html('Nova conta');
        $form.find('.input-feedback').empty();
        $modal.modal('show');
    });

    // Manipula clicks nos botões de editar categoria.
    $('.btn-edit-categoria').on('click', function (ev) {
        ev.preventDefault();
        url = $(this).data('url');
        method = 'PATCH';
        let key = $(this).data('key');
        let categoria;
        categorias.forEach(function (c) {
           if (c.id === key) {
               categoria = c;
           }
        });
        if (categoria === undefined) {
            console.error('Categoria selecionada não encontrada no objeto global \'categorias\': key=' + key);
            return;
        }
        $modalTitle.html('Editar categoria');
        $('#cat-nome').val(categoria.nome);
        $('#cat-cor').val('#' + categoria.cor);
        iconeSelector.setVal(categoria.icone);
        $form.find('.input-feedback').empty();
        $modal.modal('show');
    });

    // Manipula o envio do formulário.
    $form.on('submit', function (ev) {
        ev.preventDefault();
        let dados = {
            nome: $('#cat-nome').val(),
            cor: $('#cat-cor').val(),
            icone: iconeSelector.getVal()
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
                    let idTarget = '#cat-' + key + '-error';
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

    // Manipula clicks nos botões de excluir categoria.
    $('.btn-delete-categoria').on('click', function (ev) {
        ev.preventDefault();
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
