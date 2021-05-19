<?php 
class Produto{
    private $id;
    private $nome;
    private $descricao;
    private $imagem;
    private $fornecedor_id;
    private $fornecedor_nome;


    public function __construct( $id=null, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome=null){
        $this->id=$id;
        $this->nome=$nome;
        $this->descricao=$descricao;
        $this->imagem=$imagem;
        $this->fornecedor_id=$fornecedor_id;
        $this->fornecedor_nome=$fornecedor_nome;
    }

    public function getId() { return intval($this->id); }
    public function setId($id) {$this->id = intval($id);}

    public function getNome() { return $this->nome; }
    public function setNome($nome) {$this->nome = $nome;}

    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) {$this->descricao = $descricao;}

    public function getImagem() { return $this->imagem; }
    public function setImagem($imagem) {$this->imagem = $imagem;}
    
    public function getFornecedor() { return $this->fornecedor_id; }
    public function setFornecedor($fornecedor_id) {$this->fornecedor_id = $fornecedor_id;}
    
    public function getFornecedorNome() { return $this->fornecedor_nome; }
    public function setFornecedorNome($fornecedor_nome) {$this->fornecedor_id = $fornecedor_nome;}

}

?>