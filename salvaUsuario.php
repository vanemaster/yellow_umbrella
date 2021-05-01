<?php

include_once "fachada.php";

$id = @$_POST["id"];
$nome = @$_POST["nome"];
$senha = @$_POST["senha"];
$login = @$_POST["login"];

$dao = $factory->getUsuarioDao();
$usuario = $dao->buscaPorId($id);
if($usuario===null) {
    $usuario = new Usuario($id,$login, $senha, $nome);
    $idInserido = $dao->insere($usuario);
    // se precisar o id novo...
} else {
    $usuario->setNome($nome);
    $usuario->setSenha($senha);
    $usuario->setLogin($login);
    $dao->altera($usuario);
}


header("Location: usuarios.php");

?>
