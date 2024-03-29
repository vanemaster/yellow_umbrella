<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/EstoqueDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlEstoqueDao extends DAO implements EstoqueDao {

    private $table_name = 'estoque';
    
    public function insere($estoque) {

        $query = "INSERT INTO " . $this->table_name . 
        " (quantidade, preco, produto_id) VALUES" .
        " (:quantidade, :preco, :produto_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindValue(":quantidade", $estoque->getQuantidade());
        $stmt->bindValue(":preco", $estoque->getPreco());
        $stmt->bindValue(":produto_id", $estoque->getProduto());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($estoque) {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(':id', $estoque->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($estoque) {

        $query = "UPDATE " . $this->table_name . 
        " SET quantidade = :quantidade, preco = :preco, produto_id = :produto_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":quantidade", $estoque->getQuantidade());
        $stmt->bindValue(":preco", $estoque->getPreco());
        $stmt->bindValue(":produto_id", $estoque->getProduto());
        $stmt->bindValue(':id', $estoque->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera_estoque($produto_id, $qtde) {

        $query = "UPDATE " . $this->table_name . 
        " SET quantidade = :quantidade" .
        " WHERE produto_id = :produto_id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":quantidade", $qtde);
        $stmt->bindValue(':produto_id', $produto_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    e.id, e.quantidade, e.preco, produto_id, p.nome as produto_nome
                FROM
                    " . $this->table_name . " e
                JOIN produto p on (produto_id = p.id)
                WHERE
                    e.id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $id);
        $stmt->execute();
     
        if(!$pesquisa){
            $estoques = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $estoques = new Estoque($row['id'],$row['quantidade'], $row['preco'], $row['produto_id'], $row['produto_nome']);
            }
        }else{
            $estoques = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $estoque = new Estoque($id, $quantidade, $preco, $produto_id, $produto_nome); 
                $estoques[] = $estoque;
            }
        }
     
        return $estoques;
    }

    public function buscaPorProdutoId($produto_id) {
        
        $estoque = null;

        $query = "SELECT
                    e.id, e.quantidade, e.preco, produto_id, p.nome as produto_nome
                FROM
                    " . $this->table_name . " e
                JOIN produto p on (produto_id = p.id)
                WHERE
                    produto_id = ?
                LIMIT
                    1 OFFSET 0";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $produto_id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $estoque = new Estoque($row['id'],$row['quantidade'], $row['preco'], $row['produto_id'], $row['produto_nome']);
        } 
     
        return $estoque;
    }

    public function buscaPorNome($nome) {

        $estoque = null;

        $query = "SELECT
                    e.id, e.quantidade, e.preco, produto_id, p.nome as produto_nome
                FROM
                    " . $this->table_name . " e
                JOIN produto p on (produto_id = p.id)
                WHERE
                    p.nome LIKE '%".$nome."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $estoques = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $estoque = new Estoque($id, $quantidade, $preco, $produto_id, $produto_nome); 
            $estoques[] = $estoque;
        }
        return $estoques;
    }

    public function buscaTodos() {

        $query = "SELECT
                    e.id, e.quantidade, e.preco, produto_id, p.nome as produto_nome
                FROM
                    " . $this->table_name ." e
                    JOIN produto p on (produto_id = p.id)
                    ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $estoques = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $estoque = new Estoque($id, $quantidade, $preco, $produto_id, $produto_nome); 
            $estoques[] = $estoque;
        }
        return $estoques;
    }
}
?>