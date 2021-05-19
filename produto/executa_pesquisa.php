<?php
include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

$dao = $factory->getProdutoDao();

if($result){

    if(intval($_POST["pesquisa"]) > 0){
        $produto = $dao->buscaPorId(intval($_POST["pesquisa"]),true);
    }else{
        $produto = $dao->buscaPorNome($_POST["pesquisa"]);
    }

    if(!$produto){
        $_SESSION["message"] = "Não foram encontrados resultados.";
        unset($_SESSION["produtos"]);
    }else{
        $_SESSION["produtos"] = $produto;
    }
}else{
    $_SESSION["produtos"] = $dao->buscaTodos();
}

header('Location: view_produtos.php');

?>