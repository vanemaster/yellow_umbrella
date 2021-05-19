<?php
include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

$dao = $factory->getFornecedorDao();

if($result){

    if(intval($_POST["pesquisa"]) > 0){
        $fornecedor = $dao->buscaPorId(intval($_POST["pesquisa"]),true);
    }else{
        $fornecedor = $dao->buscaPorNome($_POST["pesquisa"]);
    }

    if(!$fornecedor){
        $_SESSION["message"] = "Não foram encontrados resultados.";
        unset($_SESSION["fornecedores"]);
    }else{
        $_SESSION["fornecedores"] = $fornecedor;
    }
}else{
    $_SESSION["fornecedores"] = $dao->buscaTodos();
}

header('Location: view_fornecedores.php');

?>