<?php

include_once "../fachada.php";

$id = @$_GET["id"];

$dao = $factory->getEstoqueDao();

$estoque = new Estoque($id, null, null, null);

$dao->remove($estoque);

header("Location: view_estoque.php");

?>
