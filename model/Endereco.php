<?php

class Endereco{

    private $id;
    private $rua;
    private $numero;
    private $complemento;
    private $bairro;
    private $cep;
    private $cidade;
    private $estado_id;

    public function __construct( $id, $rua, $numero, $complemento, $bairro, $cep, $cidade, $estado_id){
        $this->id=$id;
        $this->rua=$rua;
        $this->numero=$numero;
        $this->complemento=$complemento;
        $this->bairro=$bairro;
        $this->cep=$cep;
        $this->cidade=$cidade;
        $this->estado_id=$estado_id;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getRua() { return $this->rua; }
    public function setRua($rua) {$this->rua = $rua;}

    public function getNumero() { return $this->numero; }
    public function setNumero($numero) {$this->numero = $numero;}

    public function getComplemento() { return $this->complemento; }
    public function setComplemento($complemento) {$this->complemento = $complemento;}

    public function getBairro() { return $this->bairro; }
    public function setBairro($bairro) {$this->bairro = $bairro;}
    
    public function getCep() { return $this->cep; }
    public function setCep($cep) {$this->cep = $cep;}
    
    public function getCidade() { return $this->cidade; }
    public function setCidade($cidade) {$this->cidade = $cidade;}
    
    public function getEstadoID() { return $this->estado_id; }
    public function setEstadoID($estado_id) {$this->estado_id = $estado_id;}
}

?>