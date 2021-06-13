<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao_pedido = $factory->getPedidoDao();

$dao_item_pedido = $factory->getItemPedidoDao();
$itens_pedido = $dao_item_pedido->buscaPorNumPedido($id);

if($itens_pedido){
    $dao_estoque = $factory->getEstoqueDao();
    
    foreach($itens_pedido as $item){
        $estoque = $dao_estoque->buscaPorProdutoId($item->getProduto());

        if($estoque){
            $estoque->setQuantidade($estoque->getQuantidade() + $item->getQuantidade());
            $dao_estoque->altera($estoque);
        }
    }
}

$pedido = new Pedido($id, null, null, null, null,null);

unset($_SESSION["pedidos"]);

$dao_pedido->remove($pedido);

header("Location: view_pedidos.php");

?>
