<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class ItemPedido{
    private $id;
    private $quantidade;
    private $preco;
    private $pedido_id;
    private $produto_id;
    private $produto_imagem;
    private $produto_nome;
    private $produto_descricao;
    private $produto_preco;

    public function __construct(
        $id=null,
        $quantidade,
        $preco,
        $pedido_id,
        $produto_id,
        $produto_imagem=null,
        $produto_nome=null,
        $produto_descricao=null,
        $produto_preco=null
    ){
        $this->id=$id;
        $this->quantidade=$quantidade;
        $this->preco=$preco;
        $this->pedido_id=$pedido_id;
        $this->produto_id=$produto_id;
        $this->produto_imagem=$produto_imagem;
        $this->produto_nome=$produto_nome;
        $this->produto_descricao=$produto_descricao;
        $this->produto_preco=$produto_preco;
    }

    public function getId() { return intval($this->id); }
    public function setId($id) {$this->id = intval($id);}

    public function getQuantidade() { return $this->quantidade; }
    public function setQuantidade($quantidade) {$this->quantidade = $quantidade;}

    public function getPreco() { return $this->preco; }
    public function setPreco($preco) {$this->preco = $preco;}

    public function getPedidoID() { return $this->pedido_id; }
    public function setPedidoID($pedido_id) {$this->pedido_id = $pedido_id;}
    
    public function getProdutoID() { return $this->produto_id; }
    public function setProdutoID($produto_id) {$this->produto_id = $produto_id;}    
    
    public function getProdutoImagem() { return $this->produto_imagem; }
    public function setProdutoImagem($produto_imagem) {$this->produto_imagem = $produto_imagem;}    
    
    public function getProdutoNome() { return $this->produto_nome; }
    public function setProdutoNome($produto_nome) {$this->produto_nome = $produto_nome;}    
    
    public function getProdutoDescricao() { return $this->produto_descricao; }
    public function setProdutoDescricao($produto_descricao) {$this->produto_descricao = $produto_descricao;}    
    
    public function getProdutoPreco() { return $this->produto_preco; }
    public function setProdutoPreco($produto_preco) {$this->produto_preco = $produto_preco;}    
}

?>