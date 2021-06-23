<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/PedidoDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlPedidoDao extends DAO implements PedidoDao {

    private $table_name = 'pedido';
    
    public function insere($pedido) {

        $query = "INSERT INTO " . $this->table_name . 
        " (numero, data_pedido, data_entrega, situacao, cliente_id) VALUES" .
        " (:numero, :data_pedido, :data_entrega, :situacao, :cliente_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindValue(":numero", $pedido->getNumero());
        $stmt->bindValue(":data_pedido", $pedido->getDataPedido());
        $stmt->bindValue(":data_entrega", $pedido->getDataEntrega());
        $stmt->bindValue(":situacao", $pedido->getSituacao());
        $stmt->bindValue(":cliente_id", $pedido->getClienteID());

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return -1;
        }

    }

    public function remove($pedido) {

        // Ao remover um pedido, os itens voltam pro estoque - a menos que já tenha sido cancelado ou entregue
        if($pedido->getSituacao() != "3" && $pedido->getSituacao() != "2"){
            $query_item = "SELECT * FROM item_pedido WHERE pedido_id = ".$pedido->getID();
            $stmt = $this->conn->prepare($query_item);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $item_pedido = new ItemPedido($row['id'],$row['quantidade'], $row['preco'], $row['pedido_id'], $row['produto_id']);

                $query_estoque = "SELECT * FROM estoque WHERE produto_id = ".$row['produto_id'];
                $stmt = $this->conn->prepare($query_estoque);
                $stmt->execute();

                $estoque = null;
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row) {
                    $estoque = new Estoque($row['id'],$row['quantidade'], $row['preco'], $row['produto_id'], null);
                    $novo_estoque = $item_pedido->getQuantidade() + $estoque->getQuantidade();

                    $query_atualiza_estoque = "UPDATE estoque SET quantidade = ".$novo_estoque." WHERE produto_id = ".$row['produto_id'];
                    $stmt = $this->conn->prepare($query_atualiza_estoque);
                    $stmt->execute();
                }
            }
        }


        $query_items_pedido = "DELETE FROM item_pedido WHERE pedido_id = ".$pedido->getId();
        $stmt = $this->conn->prepare($query_items_pedido);
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

        // Pedido CANCELADO retorna itens pro estoque
        if($pedido->getSituacao() == "3"){
            $query_item = "SELECT * FROM item_pedido WHERE pedido_id = ".$pedido->getID();
            $stmt = $this->conn->prepare($query_item);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $item_pedido = new ItemPedido($row['id'],$row['quantidade'], $row['preco'], $row['pedido_id'], $row['produto_id']);

                $query_estoque = "SELECT * FROM estoque WHERE produto_id = ".$row['produto_id'];
                $stmt = $this->conn->prepare($query_estoque);
                $stmt->execute();

                $estoque = null;
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row) {
                    $estoque = new Estoque($row['id'],$row['quantidade'], $row['preco'], $row['produto_id'], null);
                    $novo_estoque = $item_pedido->getQuantidade() + $estoque->getQuantidade();

                    $query_atualiza_estoque = "UPDATE estoque SET quantidade = ".$novo_estoque." WHERE produto_id = ".$row['produto_id'];
                    $stmt = $this->conn->prepare($query_atualiza_estoque);
                    $stmt->execute();
                }
            }
        }

        $query = "UPDATE " . $this->table_name . 
        " SET numero = :numero, data_pedido = :data_pedido, data_entrega = :data_entrega, situacao = :situacao, cliente_id = :cliente_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":numero", $pedido->getNumero());
        $stmt->bindValue(":data_pedido", $pedido->getDataPedido());
        $stmt->bindValue(":data_entrega", $pedido->getDataEntrega());
        $stmt->bindValue(":situacao", $pedido->getSituacao());
        $stmt->bindValue(":cliente_id", $pedido->getClienteID());
        $stmt->bindValue(':id', $pedido->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id) {
        
        $query = "SELECT
                    id, numero, data_pedido, data_entrega, situacao, cliente_id
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $pedidos = null;
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $pedidos = new Pedido($row['id'],$row['numero'], $row['data_pedido'], $row['data_entrega'], $row['situacao'], $row['cliente_id']);
        }
     
        return $pedidos;
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
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if(!$pesquisa){
            $pedidos = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $pedidos = new Pedido($row['id'],$row['numero'], $row['data_pedido'], $row['data_entrega'], $row['situacao'], $row['cliente_id']);
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
                    e.nome LIKE '%".$nome."%'";
     
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

    public function buscaUltimoPedido() {

        $query = "SELECT
                    p.id, p.numero, p.data_pedido, p.data_entrega, p.situacao, p.cliente_id, f.preco as item_pedido_preco, f.quantidade as item_pedido_quantidade
                FROM
                    " . $this->table_name ." p 
                    LEFT JOIN item_pedido f on (p.id = f.pedido_id)
                    ORDER BY 
                        id DESC
                    LIMIT 
                        1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $pedidos = null;
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $pedidos = new Pedido($row['id'],$row['numero'], $row['data_pedido'], $row['data_entrega'], $row['situacao'], $row['cliente_id']);
        }

        return $pedidos;
    }

    public function buscaTodos() {

        $query = "SELECT
                    p.id, p.numero, p.data_pedido, p.data_entrega, p.situacao, p.cliente_id, c.nome as cliente_nome
                FROM
                    " . $this->table_name ." p
                    JOIN cliente c on (p.cliente_id = c.id)
                    GROUP BY p.id
                    ORDER BY p.id ASC
                    ";
     
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
}
?>