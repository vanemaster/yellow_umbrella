<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/FornecedorDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlFornecedorDao extends DAO implements FornecedorDao {

    private $table_name = 'fornecedor';
    
    public function insere($fornecedor) {

        $query = "INSERT INTO " . $this->table_name . 
        " (nome, descricao, email, telefone) VALUES" .
        " (:nome, :descricao, :email, :telefone)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindValue(":nome", $fornecedor->getNome());
        $stmt->bindValue(":descricao", $fornecedor->getDescricao());
        $stmt->bindValue(":email", $fornecedor->getEmail());
        $stmt->bindValue(":telefone", $fornecedor->getTelefone());

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
        $stmt->bindValue(':id', $fornecedor->getId());

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
        $stmt->bindValue(":nome", $fornecedor->getNome());
        $stmt->bindValue(":descricao", $fornecedor->getDescricao());
        $stmt->bindValue(":email", $fornecedor->getEmail());
        $stmt->bindValue(":telefone", $fornecedor->getTelefone());
        $stmt->bindValue(':id', $fornecedor->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, nome, descricao, email, telefone
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $id);
        $stmt->execute();
     
        if(!$pesquisa){
            $fornecedores = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $fornecedores = new Fornecedor($row['id'],$row['nome'], $row['descricao'], $row['email'], $row['telefone']);
            }
        }else{
            $fornecedores = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $fornecedor = new Fornecedor($id,$nome,$descricao,$email,$telefone); 
                $fornecedores[] = $fornecedor;
            }
        }
     
        return $fornecedores;
    }

    public function buscaPorNome($nome) {

        $fornecedor = null;

        $query = "SELECT
                    id, nome, descricao, email, telefone
                FROM
                    " . $this->table_name . "
                WHERE
                    nome LIKE '%".$nome."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $fornecedores = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $fornecedor = new Fornecedor($id,$nome,$descricao,$email,$telefone); 
            $fornecedores[] = $fornecedor;
        }
        return $fornecedores;
    }

    public function buscaPorEmail($email) {

        $fornecedor = null;

        $query = "SELECT
                    id, nome, descricao, email, telefone
                FROM
                    " . $this->table_name . "
                WHERE
                    email = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $email);
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

        $fornecedores = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $fornecedor = new Fornecedor($id,$nome,$descricao,$email,$telefone); 
            $fornecedores[] = $fornecedor;
        }
        return $fornecedores;
    }
}
?>