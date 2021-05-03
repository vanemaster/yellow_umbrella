<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;


if(!isset($_POST["quantidade"]) or $_POST["quantidade"] == ""){
    $result = false;
}

if(!isset($_POST["preco"]) or $_POST["preco"] == ""){
    $result = false;
}

if(!isset($_POST["produto_id"]) or $_POST["produto_id"] == ""){
    $result = false;
}

if($result){
    $dao = $factory->getEstoqueDao();

    $preco = str_replace(".","",$_POST["preco"]);
    $preco = str_replace(",",".",$preco);
    $preco = floatval($preco);
    $estoque = $dao->buscaPorProdutoId(intval($_POST["produto_id"]));

    if($estoque){
        $estoque->setQuantidade($_POST["quantidade"]);
        $estoque->setPreco($preco);
        $estoque->setProduto(intval($_POST["produto_id"]));
        $dao->altera($estoque);
    }else{
        $estoque = new Estoque(null, $_POST["quantidade"], $preco, intval($_POST["produto_id"]));
        $idInserido = $dao->insere($estoque);
    }

    if(isset($_SESSION["estoque"])){
        unset($_SESSION["estoque"]);
    }

    header("Location: view_estoque.php");
}

?>