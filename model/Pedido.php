<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class Pedido{
    private $id;
    private $numero;
    private $data_pedido;
    private $data_entrega;
    private $situacao;
    private $cliente_id;

    public function __construct( $id=null, $numero, $data_pedido, $data_entrega,$cliente_id){
        $this->id=$id;
        $this->numero=$numero;
        $this->data_pedido=$data_pedido;
        $this->data_entrega=$data_entrega;
        $this->situacao=$situacao;
        $this->cliente=$cliente_id;
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

    public function getCliente() { return $this->cliente_id; }
    public function setCliente($cliente_id) {$this->cliente_id = $cliente_id;}
    
}

?>