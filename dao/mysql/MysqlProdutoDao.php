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
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":descricao", $produto->getDescricao());
        $stmt->bindValue(":imagem", $produto->getImagem());
        $stmt->bindValue(":fornecedor_id", $produto->getFornecedor());

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
        $stmt->bindValue(":nome", $produto->getNome());
        $stmt->bindValue(":descricao", $produto->getDescricao());
        $stmt->bindValue(":imagem", $produto->getImagem());
        $stmt->bindValue(":fornecedor_id", $produto->getFornecedor());
        $stmt->bindValue(':id', $produto->getId());

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function buscaCarrinho($carrinho) {
        
        $result = [];

        foreach ($carrinho as $id => $qtde){
            $query = "SELECT
                    p.id, p.nome, p.descricao, p.imagem, e.preco as produto_preco
                FROM
                    " . $this->table_name . " p
                LEFT JOIN estoque e on (e.produto_id = p.id)
                WHERE
                    p.id = ?
                LIMIT
                    1 OFFSET 0";

            $stmt = $this->conn->prepare( $query );
            $stmt->bindValue(1, $id);
            $stmt->execute();

            $produto = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($row) {
                $produto = new Produto($row['id'],$row['nome'], $row['descricao'], $row['imagem'], null, null, $row['produto_preco'], $qtde);
                array_push($result, $produto);
            }
        }
     
        return $result;
    }

    public function buscaPorId($id, $pesquisa=null) {
        
        $query = "SELECT
                    p.id, p.nome, p.descricao, p.imagem, p.fornecedor_id, f.nome as fornecedor_nome, e.preco as produto_preco
                FROM
                    " . $this->table_name . " p
                LEFT JOIN estoque e on (e.produto_id = p.id)
                LEFT JOIN fornecedor f on (fornecedor_id = f.id)
                WHERE
                    p.id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if(!$pesquisa){
            $produtos = null;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row) {
                $produtos = new Produto($row['id'],$row['nome'], $row['descricao'], $row['imagem'], $row['fornecedor_id'], $row['fornecedor_nome'], $row['produto_preco']);
            }
        }else{
            $produtos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                extract($row);
                $produto = new Produto($id, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome, $produto_preco); 
                $produtos[] = $produto;
            }
        }
     
        return $produtos;
    }

    public function buscaPorNome($nome) {

        $produto = null;

        $query = "SELECT
                    p.id, p.nome, p.descricao, p.imagem, fornecedor_id, f.nome as fornecedor_nome, e.preco as produto_preco
                FROM
                    " . $this->table_name . " p
                LEFT JOIN estoque e on (e.produto_id = p.id)
                LEFT JOIN fornecedor f on (fornecedor_id = f.id)
                WHERE
                    p.nome LIKE '%".$nome."%'";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $produtos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $produto = new Produto($id, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome, $produto_preco); 
            $produtos[] = $produto;
        }
        return $produtos;
    }

    public function buscaTodos() {

        $query = "SELECT
                    p.id, p.nome, p.descricao, p.imagem, fornecedor_id, f.nome as fornecedor_nome, e.preco as produto_preco, e.quantidade as produto_quantidade
                FROM
                    " . $this->table_name ." p 
                    LEFT JOIN estoque e on (e.produto_id = p.id)
                    LEFT JOIN fornecedor f on (fornecedor_id = f.id)
                    ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $produtos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);
            $produto = new Produto($id, $nome, $descricao, $imagem, $fornecedor_id, $fornecedor_nome, $produto_preco, $produto_quantidade); 
            $produtos[] = $produto;
        }
        return $produtos;
    }
}
?>