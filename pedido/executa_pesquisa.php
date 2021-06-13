<?php
include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

$dao = $factory->getPedidoDao();

if($result){

    if(intval($_POST["pesquisa"]) > 0){
        $pedido = $dao->buscaPorNumero(intval($_POST["pesquisa"]),true);
    }else{
        $pedido = $dao->buscaPorNome($_POST["pesquisa"]);
    }

    if(!$pedido){
        $_SESSION["message"] = "Não foram encontrados resultados.";
        unset($_SESSION["pedidos"]);
    }else{
        $_SESSION["pedidos"] = $pedido;
    }
}else{
    $_SESSION["pedidos"] = $dao->buscaTodos();
}

header('Location: view_pedidos.php');

?>