<?php

include_once "../fachada.php";

$id = @$_GET["id"];

$dao = $factory->getProdutoDao();

$produto = new Produto($id, null, null, null);

$dao->remove($produto);

header("Location: view_produtos.php");

?>
