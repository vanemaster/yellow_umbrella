<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/ClienteDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlClienteDao extends DAO implements ClienteDao {

    private $table_name = 'cliente';
    
    public function insere($cliente) {

        $query = "INSERT INTO " . $this->table_name . 
        " (nome, telefone, email, cartao_credito, endereco_id, usuario_id) VALUES" .
        " (:nome, :telefone, :email, :cartao_credito, :endereco_id, :usuario_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nome", $cliente->getNome());
        $stmt->bindParam(":cartao_credito", $cliente->getCartaoCredito());
        $stmt->bindParam(":email", $cliente->getEmail());
        $stmt->bindParam(":telefone", $cliente->getTelefone());
        $stmt->bindParam(":endereco_id", $cliente->getEnderecoID());
        $stmt->bindParam(":usuario_id", $cliente->getUsuarioID());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($cliente) {

        $stmt = $this->conn->prepare( $query_prod);
        $stmt->execute();

        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $cliente->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($cliente) {

        $query = "UPDATE " . $this->table_name . 
        " SET nome = :nome, telefone = :telefone, email = :email, cartao_credito = :cartao_credito, endereco_id = :endereco_id, usuario_id = :usuario_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $cliente->getNome());
        $stmt->bindParam(":telefone", $cliente->getTelefone());
        $stmt->bindParam(":email", $cliente->getEmail());
        $stmt->bindParam(":cartao_credito", $cliente->getCartaoCredito());
        $stmt->bindParam(":endereco_id", $cliente->getEnderecoID());
        $stmt->bindParam(":usuario_id", $cliente->getUsuarioID());
        $stmt->bindParam(':id', $cliente->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, nome, telefone, email, cartao_credito, endereco_id, usuario_id
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
     
        if(!$pesquisa){
            $clientes = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $clientes = new Cliente($row['id'],$row['nome'], $row['telefone'], $row['email'], $row['cartao_credito'], $row['endereco_id'], $row['usuario_id']);
            }
        }else{
            $clientes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $cliente = new Cliente($id,$nome,$telefone,$email,$cartao_credito, $endereco_id, $usuario_id); 
                $clientes[] = $cliente;
            }
        }
     
        return $clientes;
    }

    public function buscaPorNome($nome) {

        $cliente = null;

        $query = "SELECT
                    id, nome, telefone, email, cartao_credito, endereco_id, usuario_id
                FROM
                    " . $this->table_name . "
                WHERE
                    nome LIKE '%".$nome."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $clientes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $cliente = new Cliente($id,$nome,$telefone,$email,$cartao_credito, $endereco_id, $usuario_id); 
            $clientes[] = $cliente;
        }
        return $clientes;
    }

    public function buscaPorEmail($email) {

        $cliente = null;

        $query = "SELECT
                    id, nome, telefone, email, cartao_credito, endereco_id, usuario_id
                FROM
                    " . $this->table_name . "
                WHERE
                    email = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $nome);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $cliente = new Cliente($row['id'],$row['nome'], $row['telefone'], $row['email'], $row['cartao_credito'], $row['endereco_id'], $row['usuario_id']);
        } 
     
        return $cliente;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, nome, telefone, email, cartao_credito, endereco_id, usuario_id
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $clientes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $cliente = new Cliente($id,$nome,$telefone,$email,$cartao_credito, $endereco_id, $usuario_id); 
            $clientes[] = $cliente;
        }
        return $clientes;
    }
}
?>