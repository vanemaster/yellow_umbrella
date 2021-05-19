<?php
include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

$dao = $factory->getEstoqueDao();

if($result){

    if(intval($_POST["pesquisa"]) > 0){
        $estoque = $dao->buscaPorId(intval($_POST["pesquisa"]),true);
    }else{
        $estoque = $dao->buscaPorNome($_POST["pesquisa"]);
    }

    if(!$estoque){
        $_SESSION["message"] = "Não foram encontrados resultados.";
        unset($_SESSION["estoque"]);
    }else{
        $_SESSION["estoque"] = $estoque;
    }
}else{
    $_SESSION["estoque"] = $dao->buscaTodos();
}

header('Location: view_estoque.php');

?>