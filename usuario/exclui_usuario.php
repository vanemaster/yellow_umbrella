<?php

include_once("../fachada.php");
session_start();
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getUsuarioDao();

$usuario = new Usuario($id, null, null, null);

unset($_SESSION["usuarios"]);

$dao->remove($usuario);

header("Location: view_usuarios.php");

?>
