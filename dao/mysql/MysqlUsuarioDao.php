<?php

include_once('../UsuarioDao.php');
include_once('dao/DAO.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');


 class MysqlUsuarioDao extends DAO implements UsuarioDao {

    private $table_name = 'usuario';
    
    public function insere($usuario) {

        $query = "INSERT INTO " . $this->table_name . 
        " (email, senha, nome) VALUES" .
        " (:email, :senha, :nome)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":email", $usuario->getEmail());
        $stmt->bindParam(":senha", $usuario->getSenha());
        $stmt->bindParam(":nome", $usuario->getNome());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($usuario) {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $usuario->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($usuario) {

        $query = "UPDATE " . $this->table_name . 
        " SET email = :email, senha = :senha, nome = :nome" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":email", $usuario->getEmail());
        $stmt->bindParam(":senha", $usuario->getSenha());
        $stmt->bindParam(":nome", $usuario->getNome());
        $stmt->bindParam(':id', $usuario->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, email, nome, senha
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
            $usuarios = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $usuarios = new Usuario($row['id'],$row['nome'], $row['email'], $row['senha']);
            }
        }else{
            $usuarios = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $usuario = new Usuario($id,$nome,$email,$senha); 
                $usuarios[] = $usuario;
            }
        }
         
     
        return $usuarios;
    }

    public function buscaPorEmail($email) {

        $usuario = null;

        $query = "SELECT
                    id, email, nome, senha
                FROM
                    " . $this->table_name . "
                WHERE
                    email = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $email);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $usuario = new Usuario($row['id'],$row['nome'], $row['email'], $row['senha']);
        } 
     
        return $usuario;
    }

    public function buscaPorNome($nome) {

        $query = "SELECT
                    id, email, nome, senha
                FROM
                    " . $this->table_name . "
                WHERE
                    nome LIKE '%".$nome."%'
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $usuario = new Usuario($id,$nome,$email,$senha); 
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, nome, email, senha
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $usuario = new Usuario($id,$nome,$email,$senha); 
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }
}
?>