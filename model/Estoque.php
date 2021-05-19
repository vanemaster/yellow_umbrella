<?php 

class Estoque{
    private $id;
    private $quantidade;
    private $preco;
    private $produto_id;
    private $produto_nome;


    public function __construct( $id=null, $quantidade, $preco, $produto_id, $produto_nome=null){
        $this->id=$id;
        $this->quantidade=$quantidade;
        $this->preco=$preco;
        $this->produto_id=$produto_id;
        $this->produto_nome=$produto_nome;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getQuantidade() { return $this->quantidade; }
    public function setQuantidade($quantidade) {$this->quantidade = $quantidade;}

    public function getPreco() { return $this->preco; }
    public function setPreco($preco) {$this->preco = $preco;}
    
    public function getProduto() { return $this->produto_id; }
    public function setProduto($produto_id) {$this->produto_id = $produto_id;}
    
    public function getProdutoNome() { return $this->produto_nome; }
    public function setProdutoNome($produto_nome) {$this->produto_nome = $produto_nome;}

}

?>