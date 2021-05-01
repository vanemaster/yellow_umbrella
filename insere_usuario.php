<?php
include_once "fachada.php";


// $login = @$_GET["login"];
// $senha = @$_GET["senha"];
// $nome = @$_GET["nome"];

$login = @$_POST["login"];
$senha = @$_POST["senha"];
$nome = @$_POST["nome"];

$usuario = new Usuario(null,$login,$senha,$nome);
$dao = $factory->getUsuarioDao();
$dao->insere($usuario);

header("Location: usuarios.php");
exit;

?>