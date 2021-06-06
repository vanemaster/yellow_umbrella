<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;

ini_set('display_errors', 'On');


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


if($result){
    $dao = $factory->getPedidoDao();
    if(isset($_POST["id"]) and $_POST["id"] != ""){
        $pedido = $dao->buscaPorId($_POST["id"]);
        
        $pedido->setNumero($_POST["numero"]);
        $pedido->setDataPedido($_POST["data_pedido"]);
        $pedido->setDataEntrega($_POST["data_entrega"]);
        $pedido->setSituacao($_POST["situacao"]);
        $pedido->setClienteID($_POST["cliente_id"]);
        $dao->altera($pedido);
        
    }else{
        $pedido = new Pedido(null, $_POST["numero"], $_POST["data_pedido"], $_POST["data_entrega"], $_POST["situacao"], $_POST["cliente_id"]);
        $idInserido = $dao->insere($pedido);
    }

    if(isset($_SESSION["pedidos"])){
        unset($_SESSION["pedidos"]);
    }

    header("Location: view_pedidos.php");
}

?>
