<?php

class Fornecedor{

    private $id;
    private $nome;
    private $descricao;
    private $email;
    private $telefone;

    public function __construct( $id, $nome, $descricao, $email, $telefone){
        $this->id=$id;
        $this->nome=$nome;
        $this->descricao=$descricao;
        $this->email=$email;
        $this->telefone=$telefone;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) {$this->descricao = $descricao;}

    public function getEmail() { return $this->email; }
    public function setEmail($email) {$this->email = $email;}
    
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) {$this->telefone = $telefone;}
}

?>