<?php
class Estado {
    
    private $id;
    private $sigla;
    private $estado;

    
    public function __construct( $id, $sigla, $estado)
    {
        $this->id=$id;
        $this->estado=$estado;
        $this->sigla=$sigla;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getEstado() { return $this->estado; }
    public function setEstado($estado) {$this->estado = $estado;}
    
    public function getSigla() { return $this->sigla; }
    public function setSigla($sigla) {$this->sigla = $sigla;}
}
?>