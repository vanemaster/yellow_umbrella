<?php
interface ClienteDao {

    public function insere($cliente);
    public function remove($cliente);
    public function altera($cliente);
    public function buscaPorId($id);
    public function buscaPorUsuarioId($id);
    public function buscaPorNome($nome);
    public function buscaPorEmail($email);
    public function buscaTodos();
}
?>