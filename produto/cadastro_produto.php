<?php

include_once("../fachada.php");

$result = true;

if(!isset($_POST["nome"]) and $_POST["nome"] != ""){
    $result = false;
}

if(!isset($_POST["descricao"]) and $_POST["descricao"] != ""){
    $result = false;
}

if($result){
    $dao = $factory->getProdutoDao();
    if(isset($_POST["id"]) and $_POST["id"] != ""){
        $produto = $dao->buscaPorId($_POST["id"]);
        
        $produto->setNome($_POST["nome"]);
        $produto->setDescricao($_POST["descricao"]);
        $dao->altera($produto);

        header("Location: view_editar_produto.php?id=".$_POST["id"]);
    }else{
        $foto="";
        $produto = new Produto(null, $_POST["nome"], $_POST["descricao"], $foto);
        $idInserido = $dao->insere($produto);

        header("Location: view_cadastro_produto.php");
    }

}

?>