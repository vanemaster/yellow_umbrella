<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getUsuarioDao();

$usuario = new Usuario($id, null, null, null);

$dao->remove($usuario);

header("Location: view_usuarios.php");

?>
