<?php
class Usuario {
    
    private $id;
    private $email;
    private $senha;
    private $nome;
    private $perfil_id;

    
    public function __construct( $id, $nome, $email, $senha, $perfil_id)
    {
        $this->id=$id;
        $this->email=$email;
        $this->senha=$senha;
        $this->nome=$nome;
        $this->perfil_id=$perfil_id;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getEmail() { return $this->email; }
    public function setEmail($email) {$this->email = $email;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) {$this->senha = $senha;}
    
    public function getPerfilID() { return $this->perfil_id; }
    public function setPerfilID($perfil_id) {$this->perfil_id = $perfil_id;}
}
?>