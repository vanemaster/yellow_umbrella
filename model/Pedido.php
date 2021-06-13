<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class Pedido{
    private $id;
    private $numero;
    private $data_pedido;
    private $data_entrega;
    private $situacao;
    private $cliente_id;
    private $cliente_nome;

    public function __construct( $id=null, $numero, $data_pedido, $data_entrega, $situacao, $cliente_id, $cliente_nome=null){
        $this->id=$id;
        $this->numero=$numero;
        $this->data_pedido=$data_pedido;
        $this->data_entrega=$data_entrega;
        $this->situacao=$situacao;
        $this->cliente_id=$cliente_id;
        $this->cliente_nome=$cliente_nome;
    }

    public function getId() { return intval($this->id); }
    public function setId($id) {$this->id = intval($id);}

    public function getNumero() { return $this->numero; }
    public function setNumero($numero) {$this->numero = $numero;}

    public function getDataPedido() { return $this->data_pedido; }
    public function setDataPedido($data_pedido) {$this->data_pedido = $data_pedido;}

    public function getDataEntrega() { return $this->data_entrega; }
    public function setDataEntrega($data_entrega) {$this->data_entrega = $data_entrega;}
    
    public function getSituacao() { return $this->situacao; }
    public function setSituacao($situacao) {$this->situacao = $situacao;}

    public function getClienteID() { return $this->cliente_id; }
    public function setClienteID($cliente_id) {$this->cliente_id = $cliente_id;}
    
    public function getClienteNome() { return $this->cliente_nome; }
    public function setClienteNome($cliente_nome) {$this->cliente_nome = $cliente_nome;}
    
}

?>