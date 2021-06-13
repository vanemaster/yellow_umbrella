<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

interface ItemPedidoDao {

    public function insere($item_pedido);
    public function remove($item_pedido);
    public function altera($item_pedido);
    public function buscaPorNumPedido($numero);
}
?>
