<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;

if(!isset($_POST["nome"]) or $_POST["nome"] == ""){
    $result = false;
}

if(!isset($_POST["descricao"]) or $_POST["descricao"] == ""){
    $result = false;
}

if(!isset($_POST["email"]) or $_POST["email"] == ""){
    $result = false;
}

if(!isset($_POST["telefone"]) or $_POST["telefone"] == ""){
    $result = false;
}

if($result){
    $dao = $factory->getFornecedorDao();
    if(isset($_POST["id"]) and $_POST["id"] != ""){
        $fornecedor = $dao->buscaPorId($_POST["id"]);
        
        $fornecedor->setNome($_POST["nome"]);
        $fornecedor->setDescricao($_POST["descricao"]);
        $fornecedor->setEmail($_POST["email"]);
        $fornecedor->setTelefone($_POST["telefone"]);
        $dao->altera($fornecedor);
        
    }else{
        $fornecedor = new Fornecedor(null, $_POST["nome"], $_POST["descricao"], $_POST["email"], $_POST["telefone"]);
        $idInserido = $dao->insere($fornecedor);
    }

    if(isset($_SESSION["fornecedores"])){
        unset($_SESSION["fornecedores"]);
    }

    header("Location: view_fornecedores.php");

}

?>