<?php
interface FornecedorDao {

    public function insere($forncedor);
    public function remove($forncedor);
    public function altera($forncedor);
    public function buscaPorId($id);
    public function buscaPorNome($nome);
    public function buscaPorEmail($email);
    public function buscaTodos();
}
?>