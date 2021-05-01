<?php

include_once('ProdutoDao.php');
include_once('dao/DAO.php');

class MysqlProdutoDao extends DAO implements ProdutoDao {

    private $table_name = 'produto';
    
    public function insere($produto) {

        $query = "INSERT INTO " . $this->table_name . 
        " (nome, descricao, foto) VALUES" .
        " (:nome, :descricao, :foto)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":foto", $produto->getFoto());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($produto) {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $produto->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($produto) {

        $query = "UPDATE " . $this->table_name . 
        " SET nome = :nome, descricao = :descricao, foto = :foto" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":foto", $produto->getFoto());
        $stmt->bindParam(':id', $produto->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id) {
        
        $produto = null;

        $query = "SELECT
                    id, nome, descricao, foto
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['id'],$row['nome'], $row['descricao'], $row['foto']);
        } 
     
        return $produto;
    }

    public function buscaPorNome($nome) {

        $produto = null;

        $query = "SELECT
                    id, nome, descricao, foto
                FROM
                    " . $this->table_name . "
                WHERE
                    login = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $nome);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $produto = new Produto($row['id'],$row['nome'], $row['descricao'], $row['foto']);
        } 
     
        return $produto;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, nome, descricao, foto
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $produtos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $produto = new Produto($id,$nome,$descricao,$foto); 
            $produtos[] = $produto;
        }
        return $produtos;
    }
}
?>