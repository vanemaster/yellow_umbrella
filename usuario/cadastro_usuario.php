<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$result = true;
$_SESSION["message"] = "";


if(!isset($_POST["nome"]) or trim($_POST["nome"]) == ""){
    $result = false;
}

if(!isset($_POST["email"]) or trim($_POST["email"]) == ""){
    $result = false;
}

if(!isset($_POST["senha"]) or trim($_POST["senha"]) == ""){
    $result = false;
}

if(!isset($_POST["perfil_id"]) or trim($_POST["perfil_id"]) == ""){
    $result = false;
}


if($result){
    $dao = $factory->getUsuarioDao();

    $usuario = $dao->buscaPorEmail($_POST["email"]);

    if($usuario && isset($_POST["id"]) && trim($_POST["id"]) != ""){
        $usuario->setNome($_POST["nome"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setSenha(md5($_POST["senha"]));
        $usuario->setPerfilID($_POST["perfil_id"]);
        $dao->altera($usuario);
    }else{
        if(!$usuario){
            $usuario = new Usuario(null, $_POST["nome"], $_POST["email"], md5($_POST["senha"]), $_POST['perfil_id']);
            $idInserido = $dao->insere($usuario);
        }else{
            $_SESSION["message"] = "Usuário já inserido";
        }
        
    }

    if(isset($_SESSION["usuarios"])){
        unset($_SESSION["usuarios"]);
    }

    header("Location: view_usuarios.php");
}


?>