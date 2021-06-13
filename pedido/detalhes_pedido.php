<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$list_items = [];

ini_set('display_errors', 'On');

$dao_item_pedido = $factory->getItemPedidoDao();

if(!isset($_POST["pedido_id"]) or $_POST["pedido_id"] == ""){
    $result = false;
}

if($result){
    $items = $dao_item_pedido->buscaPorNumPedido($_POST['pedido_id']);

    if($items){

        foreach($items as $item){
            $list_items[] = array(
                "pedido_id" => $item->getPedidoID(),
                "quantidade" => $item->getQuantidade(),
                "preco" => $item->getPreco(),
                "preco_unitario" => $item->getProdutoPreco(),
                "nome" => $item->getProdutoNome(),
                "imagem" => $item->getProdutoImagem(),
                "descricao" => $item->getProdutoDescricao(),
            );
        }
        
        echo json_encode($list_items);
    }
}


?>