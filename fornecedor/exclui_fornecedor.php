<?php

include_once("../fachada.php");
session_start();
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getFornecedorDao();

$fornecedor = new Fornecedor($id, null, null, null, null);

unset($_SESSION["fornecedores"]);

$dao->remove($fornecedor);

header("Location: view_fornecedores.php");

?>
