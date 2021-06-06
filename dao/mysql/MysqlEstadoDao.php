<?php

include_once('../EstadoDao.php');
include_once('dao/DAO.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');


 class MysqlEstadoDao extends DAO implements EstadoDao {

    private $table_name = 'estados';
    
    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, sigla, estado
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
            $estados = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $estados = new Estado($row['id'],$row['sigla'],$row['estado']);
            }
        }else{
            $estados = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $estado = new Estado($id,$sigla,$estado); 
                $estados[] = $estado;
            }
        }
         
     
        return $estados;
    }

    public function buscaPorEstado($estado) {

        $query = "SELECT
                    id, sigla, estado
                FROM
                    " . $this->table_name . "
                WHERE
                    estado LIKE '%".$estado."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $estados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $estado = new Estado($id,$sigla,$estado); 
            $estados[] = $estado;
        }
        return $estados;
    }
    
    public function buscaPorSigla($sigla) {

        $query = "SELECT
                    id, sigla, estado
                FROM
                    " . $this->table_name . "
                WHERE
                    sigla = '".$sigla."'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $estados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $estado = new Estado($id,$sigla,$estado); 
            $estados[] = $estado;
        }
        return $estados;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, sigla, estado
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $estados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $estado = new Estado($id,$sigla,$estado); 
            $estados[] = $estado;
        }
        return $estados;
    }
}
?>