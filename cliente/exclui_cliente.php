<?php

include_once("../fachada.php");
session_start();
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getClienteDao();

$cliente = new Cliente($id, null, null, null, null, null, null);

unset($_SESSION["clientes"]);

$dao->remove($cliente);

header("Location: view_clientes.php");

?>
