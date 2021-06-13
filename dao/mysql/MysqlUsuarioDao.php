<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/UsuarioDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');


 class MysqlUsuarioDao extends DAO implements UsuarioDao {

    private $table_name = 'usuario';
    
    public function insere($usuario) {

        $query = "INSERT INTO " . $this->table_name . 
        " (email, senha, nome, perfil_id) VALUES" .
        " (:email, :senha, :nome, :perfil_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":senha", $usuario->getSenha());
        $stmt->bindValue(":nome", $usuario->getNome());
        $stmt->bindValue(":perfil_id", $usuario->getPerfilID());

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
        $stmt->bindValue(':id', $usuario->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($usuario) {

        $query = "UPDATE " . $this->table_name . 
        " SET email = :email, senha = :senha, nome = :nome, perfil_id = :perfil_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":senha", $usuario->getSenha());
        $stmt->bindValue(":nome", $usuario->getNome());
        $stmt->bindValue(":perfil_id", $usuario->getPerfilID());
        $stmt->bindValue(':id', $usuario->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, email, nome, senha, perfil_id
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
            $usuarios = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $usuarios = new Usuario($row['id'],$row['nome'], $row['email'], $row['senha'], $row['perfil_id']);
            }
        }else{
            $usuarios = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $usuario = new Usuario($id,$nome,$email,$senha,$perfil_id); 
                $usuarios[] = $usuario;
            }
        }
         
     
        return $usuarios;
    }

    public function buscaPorEmail($email) {

        $usuario = null;

        $query = "SELECT
                    id, email, nome, senha, perfil_id
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
            $usuario = new Usuario($row['id'],$row['nome'], $row['email'], $row['senha'], $row['perfil_id']);
        } 
     
        return $usuario;
    }

    public function buscaPorNome($nome) {

        $query = "SELECT
                    id, email, nome, senha, perfil_id
                FROM
                    " . $this->table_name . "
                WHERE
                    nome LIKE '%".$nome."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $usuario = new Usuario($id,$nome,$email,$senha,$perfil_id); 
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    public function buscaTodos() {

        $query = "SELECT
                    id, nome, email, senha, perfil_id
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $usuario = new Usuario($id,$nome,$email,$senha,$perfil_id); 
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }
}
?>