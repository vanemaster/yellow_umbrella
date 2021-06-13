<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class ItemPedido{
    private $id;
    private $quantidade;
    private $preco;
    private $pedido_id;
    private $produto_id;

    public function __construct( $id=null, $quantidade, $preco, $pedido_id, $produto_id){
        $this->id=$id;
        $this->quantidade=$quantidade;
        $this->preco=$preco;
        $this->pedido_id=$pedido_id;
        $this->produto_id=$produto_id;
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
}

?>