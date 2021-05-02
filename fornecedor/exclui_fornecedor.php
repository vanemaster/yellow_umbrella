<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getFornecedorDao();

$fornecedor = new Fornecedor($id, null, null, null);

$dao->remove($fornecedor);

header("Location: view_fornecedores.php");

?>
