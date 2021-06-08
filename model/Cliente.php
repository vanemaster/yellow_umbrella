<?php

class Cliente{

    private $id;
    private $nome;
    private $telefone;
    private $email;
    private $cartao_credito;
    private $endereco_id;
    private $usuario_id;

    public function __construct( $id, $nome, $telefone, $email, $cartao_credito, $endereco_id, $usuario_id){
        $this->id=$id;
        $this->nome=$nome;
        $this->cartao_credito=$cartao_credito;
        $this->email=$email;
        $this->telefone=$telefone;
        $this->endereco_id=$endereco_id;
        $this->usuario_id=$usuario_id;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getCartaoCredito() { return $this->cartao_credito; }
    public function setCartaoCredito($cartao_credito) {$this->cartao_credito = $cartao_credito;}

    public function getEmail() { return $this->email; }
    public function setEmail($email) {$this->email = $email;}
    
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) {$this->telefone = $telefone;}
    
    public function getEnderecoID() { return $this->endereco_id; }
    public function setEnderecoID($endereco_id) {$this->endereco_id = $endereco_id;}
    
    public function getUsuarioID() { return $this->usuario_id; }
    public function setUsuarioID($usuario_id) {$this->usuario_id = $usuario_id;}
}

?>