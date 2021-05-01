<?php 

class Produto{
    private $id;
    private $nome;
    private $descricao;
    private $foto;


    public function __construct( $id, $nome, $descricao, $foto){
        $this->id=$id;
        $this->nome=$nome;
        $this->descricao=$descricao;
        $this->foto=$foto;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) {$this->descricao = $descricao;}

    public function getFoto() { return $this->foto; }
    public function setFoto($foto) {$this->foto = $foto;}

}

?>