<?php
include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";

if(!isset($_POST["pesquisa"]) or trim($_POST["pesquisa"]) == ""){
    $result = false;
}

$dao = $factory->getUsuarioDao();

if($result){    

    if(intval($_POST["pesquisa"]) > 0){
        $usuario = $dao->buscaPorId($_POST["pesquisa"],true);
    }else{
        $usuario = $dao->buscaPorNome($_POST["pesquisa"]);
    }

    if(!$usuario){
        $_SESSION["message"] = "Não foram encontrados resultados.";
        unset($_SESSION["usuarios"]);
    }else{
        $_SESSION["usuarios"] = $usuario;
    }
}else{
    $_SESSION["usuarios"] = $dao->buscaTodos();
}

header('Location: view_usuarios.php');

?>