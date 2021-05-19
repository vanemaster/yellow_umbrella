<?php
include_once("../fachada.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

if(isset($_POST["limpar_pesquisa"])){
    $result = false;
    unset($_SESSION["produtos_index"]);
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
        unset($_SESSION["produtos_index"]);
    }else{
        $_SESSION["produtos_index"] = $produto;
    }
}else{
    $_SESSION["produtos_index"] = $dao->buscaTodos();
}

header('Location: view_index.php');

?>