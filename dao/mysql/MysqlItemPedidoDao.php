<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/ItemPedidoDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlItemPedidoDao extends DAO implements ItemPedidoDao {

    private $table_name = 'item_pedido';
    
    public function insere($item_pedido) {

        $query = "INSERT INTO " . $this->table_name . 
        " (quantidade, preco, pedido_id, produto_id) VALUES" .
        " (:quantidade, :preco, :pedido_id, :produto_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindValue(":quantidade", $item_pedido->getQuantidade());
        $stmt->bindValue(":preco", $item_pedido->getPreco());
        $stmt->bindValue(":pedido_id", $item_pedido->getPedidoID());
        $stmt->bindValue(":produto_id", $item_pedido->getProdutoID());;


        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return -1;
        }

    }

    public function remove($item_pedido) {

        $query_item = "SELECT * FROM".$this->table_name."WHERE id = ".$item_pedido;
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
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ".$item_pedido->getId();
       
        $stmt = $this->conn->prepare($query);

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($item_pedido) {

        $query = "UPDATE " . $this->table_name . 
        " SET quantidade = :quantidade, preco = :preco, pedido_id = :pedido_id, produto_id = :produto_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":quantidade", $item_pedido->getQuantidade());
        $stmt->bindValue(":preco", $item_pedido->getPreco());
        $stmt->bindValue(":pedido_id", $item_pedido->getPedidoID());
        $stmt->bindValue(":produto_id", $item_pedido->getProdutoID());
        $stmt->bindValue(':id', $item_pedido->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorNumPedido($pedido_id) {
        
        $query = "SELECT
                    ip.id, ip.quantidade, ip.preco, ip.pedido_id, ip.produto_id, p.imagem as produto_imagem, p.nome as produto_nome, p.descricao as produto_descricao, e.preco as produto_preco
                FROM
                    " . $this->table_name . " ip
                JOIN produto p on (ip.produto_id = p.id)
                JOIN estoque e on (p.id = e.produto_id)
                WHERE
                    ip.pedido_id = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $pedido_id);
        $stmt->execute();

        $item_pedidos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $item_pedido = new ItemPedido($id, $quantidade, $preco, $pedido_id, $produto_id, $produto_imagem, $produto_nome, $produto_descricao, $produto_preco); 
            $item_pedidos[] = $item_pedido;
        }
     
        return $item_pedidos;
    }
}
?>