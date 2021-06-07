<?php
interface EstoqueDao {

    public function insere($estoque);
    public function remove($estoque);
    public function altera($estoque);
    public function altera_estoque($produto_id, $qtde);
    public function buscaPorId($id);
    public function buscaPorProdutoId($produto_id);
    public function buscaPorNome($nome);
    public function buscaTodos();
}
?>