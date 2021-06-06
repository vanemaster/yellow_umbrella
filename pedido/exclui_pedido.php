<?php

include_once("../fachada.php");
include_once("../login/verifica.php");

$id = @$_GET["id"];

$dao = $factory->getPedidoDao();

$pedido = new Pedido($id, null, null, null, null,null);

unset($_SESSION["pedidos"]);

$dao->remove($pedido);

header("Location: view_pedidos.php");

?>
