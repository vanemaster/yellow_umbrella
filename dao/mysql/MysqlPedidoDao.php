<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/PedidoDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlPedidoDao extends DAO implements PedidoDao {

    private $table_name = 'pedido';
    
    public function insere($pedido) {

        $query = "INSERT INTO " . $this->table_name . 
        " (numero, data_pedido, data_entrega, situacao) VALUES" .
        " (:numero, :data_pedido, :data_entrega, :situacao)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":numero", $pedido->getNumero());
        $stmt->bindParam(":data_pedido", $pedido->getDataPedido());
        $stmt->bindParam(":data_entrega", $pedido->getDataEntrega());
        $stmt->bindParam(":situacao", $pedido->getSituacao());
        $stmt->bindParam(":cliente_id", $pedido->getClienteId());


        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return -1;
        }

    }

    public function remove($pedido) {
        $query_estoque = "DELETE FROM estoque WHERE pedido_id = ".$pedido->getId();
        $stmt = $this->conn->prepare($query_estoque);
        $stmt->execute();

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ".$pedido->getId();
       
        $stmt = $this->conn->prepare($query);

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($pedido) {

        $query = "UPDATE " . $this->table_name . 
        " SET numero = :numero, data_pedido = :data_pedido, data_entrega = :data_entrega, situacao = :situacao, cliente_id = :cliente_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":numero", $pedido->getNumero());
        $stmt->bindParam(":data_pedido", $pedido->getDataPedido());
        $stmt->bindParam(":data_entrega", $pedido->getDataEntrega());
        $stmt->bindParam(":situacao", $pedido->getSituacao());
        $stmt->bindParam(":cliente_id", $pedido->getClienteId());
        $stmt->bindParam(':id', $pedido->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorNumero($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, numero, data_pedido, data_entrega, situacao, cliente_id
                FROM
                    " . $this->table_name . "
                WHERE
                    numero = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if(!$pesquisa){
            $pedidos = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $pedidos = new Pedido($row['id'],$row['numero'], $row['data_pedido'], $row['data_entrega'], $row['situacao'], $row{'cliente_id'});
            }
        }else{
            $pedidos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $pedido = new Pedido($id, $numero, $data_pedido, $data_entrega, $situacao, $cliente_id); 
                $pedidos[] = $pedido;
            }
        }
     
        return $pedidos;
    }

    public function buscaPorNome($nome) {

        $pedido = null;

        $query = "SELECT
                    p.id, p.numero, p.data_pedido, p.data_entrega, situacao, e.id as cliente_id, e.nome as cliente_nome
                FROM
                    " . $this->table_name . " p
                LEFT JOIN cliente e on (e.id = p.cliente_id)
                WHERE
                    p.numero LIKE '%".$numero."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $pedidos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $pedido = new Pedido($id, $numero, $data_pedido, $data_entrega, $situacao, $cliente_id, $cliente_nome); 
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }

    public function buscaTodos() {

        $query = "SELECT
                    p.id, p.numero, p.data_pedido, p.data_entrega, situacao, f.preco as item_pedido_preco, f.quantidade as item_pedido_quantidade
                FROM
                    " . $this->table_name ." p 
                    LEFT JOIN item_pedido f on (p.pedido_id = f.id)
                    ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $pedidos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $pedido = new Pedido($id, $numero, $data_pedido, $data_entrega, $situacao, $cliente_id, $item_pedido_preco, $item_pedido_quantidade); 
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }
}
?>