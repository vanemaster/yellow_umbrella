<?php

include_once "fachada.php";

$id = @$_GET["id"];

$dao = $factory->getUsuarioDao();

$usuario = new Usuario($id, null, null, null);

$dao->remove($usuario);

header("Location: usuarios.php");

?>
