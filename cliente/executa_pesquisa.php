<?php
include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

$dao = $factory->getClienteDao();

if($result){

    if(intval($_POST["pesquisa"]) > 0){
        $cliente = $dao->buscaPorId(intval($_POST["pesquisa"]),true);
    }else{
        $cliente = $dao->buscaPorNome($_POST["pesquisa"]);
    }

    if(!$cliente){
        $_SESSION["message"] = "Não foram encontrados resultados.";
        unset($_SESSION["clientes"]);
    }else{
        $_SESSION["clientes"] = $cliente;
    }
}else{
    $_SESSION["clientes"] = $dao->buscaTodos();
}

header('Location: view_clientes.php');

?>