<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/ProdutoDao.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DAO.php');

class MysqlProdutoDao extends DAO implements ProdutoDao {

    private $table_name = 'produto';
    
    public function insere($produto) {

        $query = "INSERT INTO " . $this->table_name . 
        " (nome, descricao, imagem, fornecedor_id) VALUES" .
        " (:nome, :descricao, :imagem, :fornecedor_id)";

        $stmt = $this->conn->prepare($query);

        // bind values 
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":imagem", $produto->getImagem());
        $stmt->bindParam(":fornecedor_id", $produto->getFornecedor());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }

    }

    public function remove($produto) {
        $query_estoque = "DELETE FROM estoque WHERE produto_id = ".$produto->getId();
        $stmt = $this->conn->prepare($query_estoque);
        $stmt->execute();

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ".$produto->getId();
       
        $stmt = $this->conn->prepare($query);

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function altera($produto) {

        $query = "UPDATE " . $this->table_name . 
        " SET nome = :nome, descricao = :descricao, imagem = :imagem, fornecedor_id = :fornecedor_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":nome", $produto->getNome());
        $stmt->bindParam(":descricao", $produto->getDescricao());
        $stmt->bindParam(":imagem", $produto->getImagem());
        $stmt->bindParam(":fornecedor_id", $produto->getFornecedor());
        $stmt->bindParam(':id', $produto->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    id, nome, descricao, imagem, fornecedor_id
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
            $produtos = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $produtos = new Produto($row['id'],$row['nome'], $row['descricao'], $row['imagem'], $row['fornecedor_id']);
            }
        }else{
            $produtos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $produto = new Produto($id, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome); 
                $produtos[] = $produto;
            }
        }
     
        return $produtos;
    }

    public function buscaPorNome($nome) {

        $produto = null;

        $query = "SELECT
                    p.id, p.nome, p.descricao, p.imagem, fornecedor_id, f.nome as fornecedor_nome
                FROM
                    " . $this->table_name . " p
                LEFT JOIN fornecedor f on (fornecedor_id = f.id)
                WHERE
                    p.nome LIKE '%".$nome."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $produtos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $produto = new Produto($id, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome); 
            $produtos[] = $produto;
        }
        return $produtos;
    }

    public function buscaTodos() {

        $query = "SELECT
                    p.id, p.nome, p.descricao, p.imagem, fornecedor_id, f.nome as fornecedor_nome
                FROM
                    " . $this->table_name ." p 
                    LEFT JOIN fornecedor f on (fornecedor_id = f.id)
                    ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $produtos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $produto = new Produto($id, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome); 
            $produtos[] = $produto;
        }
        return $produtos;
    }
}
?>