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
          var json_response = $.parseJSON(response);
          $('.carrinho-counter').html(json_response.carrinho_qtde);
          
          button.html('Adicionado!').removeClass('btn-warning').addClass('btn-success');
          setTimeout(function() {  button.html('Adicionar ao carrinho').removeClass('btn-success').addClass('btn-warning'); }, 1000);  
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });
    });

    $(".item-pedido-lista").click(function(){
      var item = $(this);
      var strList = "";
      $.ajax({
        url: URL_BASE + "/pedido/detalhes_pedido.php",
        type: "post",
        data: {"pedido_id": item.parent().attr("id")},
        success: function(response){
          var json_response = $.parseJSON(response);
          strList = "<table class='table table-sm table-hover table-lista-item-pedidos'>\
          <thead>\
          <tr>\
          <th>Imagem</th>\
          <th>Produto</th>\
          <th>Descricao</th>\
          <th>Quantidade</th>\
          <th>Preco</th>\
          <th>Preco Unitario</th>\
          </tr>\
          </thead><tbody>";
          for (var i = 0; i < json_response.length; i++) {
            strList += "<tr>\
            <td><img src='"+URL_BASE+"/produto/imagens/"+json_response[i].imagem+"' class='imagem-tabela-item-pedido'/></td>\
            <td>"+json_response[i].nome+"</td>\
            <td>"+json_response[i].descricao+"</td>\
            <td>"+json_response[i].quantidade+"</td>\
            <td>"+json_response[i].preco+"</td>\
            <td>"+json_response[i].preco_unitario+"</td>\
            </tr>";
          }
          strList += "</tbody></table>";
          $("#item-pedido-detalhe").html(strList);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    });
});