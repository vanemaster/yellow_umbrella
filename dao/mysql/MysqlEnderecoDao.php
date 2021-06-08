<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/EnderecoDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlEnderecoDao extends DAO implements EnderecoDao {

    private $table_name = 'endereco';
    
    public function insere($endereco) {

        $query = "INSERT INTO " . $this->table_name . 
        " (rua, numero, complemento, cidade, estado_id) VALUES" .
        " (:rua, :numero, :complemento, :cidade, :estado_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindValue(":rua", $endereco->getRua());
        $stmt->bindValue(":numero", $endereco->getNumero());
        $stmt->bindValue(":complemento", $endereco->getComplemento());
        $stmt->bindValue(":cidade", $endereco->getCidade());
        $stmt->bindValue(":estado_id", $endereco->getEstadoID());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($endereco) {

        $stmt = $this->conn->prepare( $query_prod);
        $stmt->execute();

        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(':id', $endereco->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($endereco) {

        $query = "UPDATE " . $this->table_name . 
        " SET rua = :rua, numero = :numero, complemento = :complemento, cidade = :cidade, estado_id = :estado_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":rua", $endereco->getRua());
        $stmt->bindValue(":numero", $endereco->getNumero());
        $stmt->bindValue(":complemento", $endereco->getComplemento());
        $stmt->bindValue(":cidade", $endereco->getCidade());
        $stmt->bindValue(":estado_id", $endereco->getEstadoID());
        $stmt->bindValue(':id', $endereco->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, rua, numero, complemento, cidade, estado_id
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
            $enderecos = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $enderecos = new Endereco($row['id'],$row['rua'], $row['numero'], $row['complemento'], $row['cidade'], $row['estado_id']);
            }
        }else{
            $enderecos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $endereco = new Endereco($id,$rua,$numero,$complemento,$cidade,$estado_id); 
                $enderecos[] = $endereco;
            }
        }
     
        return $enderecos;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, rua, numero, complemento, cidade, estado_id
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $enderecos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $endereco = new Endereco($id,$rua,$numero,$complemento,$cidade,$estado_id); 
            $enderecos[] = $endereco;
        }
        return $enderecos;
    }
}
?>