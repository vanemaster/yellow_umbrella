<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');


if(!isset($_POST["nome"]) or $_POST["nome"] == ""){
    $result = false;
}

if(!isset($_POST["descricao"]) or $_POST["descricao"] == ""){
    $result = false;
}

if(!isset($_POST["fornecedor_id"]) or $_POST["fornecedor_id"] == ""){
    $result = false;
}
echo "<pre>";
if(!isset($_FILES["imagem"]["tmp_name"])){
    $result = false;
}else{
    $type = explode("/",$_FILES["imagem"]["type"]);
    
    if($type[0] != "image"){
        $result = false;
        $_SESSION["message"] = "Apenas imagens são permitidas para o produto.";
    }
    
    $nome_temporario = $_FILES["imagem"]["tmp_name"];
    $nome_real = explode(".",$_FILES["imagem"]["name"]);
    $nome_atualizado = str_replace(" ", "_", $nome_real[0])."_".date('m-d-Y_his').".".$nome_real[1];
    $pasta_atual = getcwd().DIRECTORY_SEPARATOR;

    $pasta_destino = $pasta_atual."imagens/".$nome_atualizado;
    
    if (!copy($nome_temporario,$pasta_destino)){
        $_SESSION["message"] = "Não foi possível salvar a imagem.";
    }
}

if($result){
    $dao = $factory->getProdutoDao();
    if(isset($_POST["id"]) and $_POST["id"] != ""){
        $produto = $dao->buscaPorId($_POST["id"]);
        
        $produto->setNome($_POST["nome"]);
        $produto->setDescricao($_POST["descricao"]);
        $produto->setImagem($nome_atualizado);
        $produto->setFornecedor(intval($_POST["fornecedor_id"]));
        $dao->altera($produto);
        
    }else{
        $produto = new Produto(null, $_POST["nome"], $_POST["descricao"], $nome_atualizado, intval($_POST["fornecedor_id"]));
        $idInserido = $dao->insere($produto);
    }

    if(isset($_SESSION["produtos"])){
        unset($_SESSION["produtos"]);
    }

    header("Location: view_produtos.php");
}

?>
