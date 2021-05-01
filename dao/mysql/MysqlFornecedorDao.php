<?php

include_once('FornecedorDao.php');
include_once('dao/DAO.php');

class MysqlFornecedorDao extends DAO implements FornecedorDao {

    private $table_name = 'fornecedor';
    
    public function insere($fornecedor) {

        $query = "INSERT INTO " . $this->table_name . 
        " (nome, descricao, email, telefone) VALUES" .
        " (:nome, :descricao, :email, :telefone)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nome", $fornecedor->getNome());
        $stmt->bindParam(":descricao", $fornecedor->getDescricao());
        $stmt->bindParam(":email", $fornecedor->getEmail());
        $stmt->bindParam(":telefone", $fornecedor->getTelefone());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($fornecedor) {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $fornecedor->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($fornecedor) {

        $query = "UPDATE " . $this->table_name . 
        " SET nome = :nome, descricao = :descricao, email = :email, telefone = :telefone" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $fornecedor->getNome());
        $stmt->bindParam(":descricao", $fornecedor->getDescricao());
        $stmt->bindParam(":email", $fornecedor->getEmail());
        $stmt->bindParam(":telefone", $fornecedor->getTelefone());
        $stmt->bindParam(':id', $fornecedor->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id) {
        
        $fornecedor = null;

        $query = "SELECT
                    id, nome, descricao, email, telefone
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
            $fornecedor = new Fornecedor($row['id'],$row['nome'], $row['descricao'], $row['email'], $row['telefone']);
        } 
     
        return $fornecedor;
    }

    public function buscaPorNome($nome) {

        $fornecedor = null;

        $query = "SELECT
                    id, nome, descricao, email, telefone
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
            $fornecedor = new Fornecedor($row['id'],$row['nome'], $row['descricao'], $row['email'], $row['telefone']);
        } 
     
        return $fornecedor;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, nome, descricao, email, telefone
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $fornecedors = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $fornecedor = new Fornecedor($id,$nome,$descricao,$email,$telefone); 
            $fornecedors[] = $fornecedor;
        }
        return $fornecedors;
    }
}
?>