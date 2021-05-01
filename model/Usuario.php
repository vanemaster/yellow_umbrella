<?php
class Usuario {
    
    private $id;
    private $email;
    private $senha;
    private $nome;

    
    public function __construct( $id, $email, $senha, $nome)
    {
        $this->id=$id;
        $this->email=$email;
        $this->senha=$senha;
        $this->nome=$nome;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getEmail() { return $this->email; }
    public function setEmail($email) {$this->email = $email;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) {$this->senha = $senha;}
}
?>