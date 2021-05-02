<?php

include_once("../fachada.php");

$result = true;


if(!isset($_POST["nome"]) or $_POST["nome"] == ""){
    $result = false;
}

if(!isset($_POST["descricao"]) or $_POST["descricao"] == ""){
    $result = false;
}

if(!isset($_POST["fornecedor_id"]) or $_POST["fornecedor_id"] == ""){
    $result = false;
}

if($result){
    $dao = $factory->getProdutoDao();
    if(isset($_POST["id"]) and $_POST["id"] != ""){
        $produto = $dao->buscaPorId($_POST["id"]);
        
        $produto->setNome($_POST["nome"]);
        $produto->setDescricao($_POST["descricao"]);
        $produto->setFornecedor(intval($_POST["fornecedor_id"]));
        $dao->altera($produto);
        
    }else{
        $foto="";
        $produto = new Produto(null, $_POST["nome"], $_POST["descricao"], $foto, intval($_POST["fornecedor_id"]));
        $idInserido = $dao->insere($produto);

        
    }

    header("Location: view_produtos.php");
}

?>