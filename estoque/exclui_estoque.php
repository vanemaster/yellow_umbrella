<?php

include_once("../fachada.php");
session_start();
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getEstoqueDao();

$estoque = new Estoque($id, null, null, null);

unset($_SESSION["estoque"]);

$dao->remove($estoque);

header("Location: view_estoque.php");

?>
