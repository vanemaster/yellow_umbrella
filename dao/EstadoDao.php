<?php
interface EstadoDao {

    public function buscaPorId($id);
    public function buscaPorEstado($estado);
    public function buscaPorSigla($sigla);
    public function buscaTodos();
}
?>