$(document).ready(function(){

  var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.telefone').mask(SPMaskBehavior, spOptions);

    $('.money').mask('#.##0,00', {reverse: true});

    $(".data").mask("99/99/9999");

    $(".btn-add-cart").click(function(){
      var button = $(this);
      $.ajax({
        url: URL_BASE + "/pedido/carrinho.php",
        type: "post",
        data: {"add_item":true, "id_produto":button.attr('id')} ,
        success: function (response) {
          console.log('response');
          console.log(response);
          button.html('Adicionado!').removeClass('btn-warning').addClass('btn-success');
          var json_response = $.parseJSON(response);
          $('.carrinho-counter').html(json_response.carrinho_qtde);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });
    });
});