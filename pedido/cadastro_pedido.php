<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;

ini_set('display_errors', 'On');

$dao_pedido = $factory->getPedidoDao();
$dao_produto = $factory->getProdutoDao();
$dao_estoque = $factory->getEstoqueDao();
$dao_cliente = $factory->getClienteDao();

$redirect = "";

// Cliente logado finalizando pedido
if(isset($_SESSION['perfil_id']) && trim($_SESSION['perfil_id']) == "2"){

    $ultimo_pedido = $dao_pedido->buscaUltimoPedido();

    if($ultimo_pedido){
        $_POST['numero'] = $ultimo_pedido->getNumero() + 1;
    }else{
        $_POST['numero'] = 1;
    }
    $_POST['data_pedido'] = date("Y-m-d H:i:s");
    $_POST['data_entrega'] = date("Y-m-d H:i:s",strtotime($_POST['data_pedido']. ' + 10 days'));
    $_POST['situacao'] = 1;
    $cliente = $dao_cliente->buscaPorUsuarioId(intval($_SESSION['id_usuario']));
    $_POST['cliente_id'] = $cliente->getId();

    $pedido = new Pedido(null, $_POST["numero"], $_POST["data_pedido"], $_POST["data_entrega"], $_POST["situacao"], $_POST["cliente_id"]);
    $idInserido = $dao_pedido->insere($pedido);

    if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho'])){
        if($idInserido){
            $dao_item_pedido = $factory->getItemPedidoDao();
            foreach ($_SESSION['carrinho'] as $prod_id => $qtde){
                // cadastro item pedido
                $produto = $dao_produto->buscaPorId(($prod_id));
                $novo_item = new ItemPedido(null, $qtde, ($produto->getProdutoPreco() * $qtde), $idInserido, $prod_id);
                $dao_item_pedido->insere($novo_item);

                // baixa estoque
                $estoque = $dao_estoque->buscaPorProdutoId($prod_id);
                $estoque->setQuantidade($estoque->getQuantidade() - $qtde);
                $dao_estoque->altera($estoque);
            }

            unset($_SESSION["carrinho"]);
        }
    }

    $redirect = "Location: view_confirmacao_pedido.php";

}else{
    // admin
    if(!isset($_POST["numero"]) or $_POST["numero"] == ""){
        $result = false;
    }
    
    if(!isset($_POST["data_pedido"]) or $_POST["data_pedido"] == ""){
        $result = false;
    }
    
    if(!isset($_POST["data_entrega"]) or $_POST["data_entrega"] == ""){
        $result = false;
    }
    
    if(!isset($_POST["situacao"]) or $_POST["situacao"] == ""){
        $result = false;
    }

    // alterar/inserir itens do pedido
    if($result){
        if(isset($_POST["id"]) and $_POST["id"] != ""){
            $pedido = $dao_pedido->buscaPorNumero($_POST["id"]);
            
            $pedido->setNumero($_POST["numero"]);
            $pedido->setDataPedido($_POST["data_pedido"]);
            $pedido->setDataEntrega($_POST["data_entrega"]);
            $pedido->setSituacao($_POST["situacao"]);
            $pedido->setClienteID($_POST["cliente_id"]);
            $dao_pedido->altera($pedido);
            
        }else{
            $pedido = new Pedido(null, $_POST["numero"], $_POST["data_pedido"], $_POST["data_entrega"], $_POST["situacao"], $_POST["cliente_id"]);
            $idInserido = $dao_pedido->insere($pedido);
        }
    }

    $redirect = "Location: view_pedidos.php";
}

if(isset($_SESSION["pedidos"])){
    unset($_SESSION["pedidos"]);
}

header($redirect);

?>
