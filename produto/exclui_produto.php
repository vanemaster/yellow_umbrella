<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getProdutoDao();

$produto = new Produto($id, null, null, null, null, null);

unset($_SESSION["produtos"]);

$dao->remove($produto);

header("Location: view_produtos.php");

?>
