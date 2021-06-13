<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

interface PedidoDao {

    public function insere($pedido);
    public function remove($pedido);
    public function altera($pedido);
    public function buscaPorId($id);
    public function buscaPorNumero($numero);
    public function buscaPorNome($nome);

    public function buscaTodos();
}
?>
