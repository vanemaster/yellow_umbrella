<?php

include_once('../DaoFactory.php');
include_once('MysqlUsuarioDao.php');
include_once('MysqlProdutoDao.php');
include_once('MysqlFornecedorDao.php');
include_once('MysqlEstoqueDao.php');

class MysqlDaofactory extends DaoFactory {

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "web2";
    private $port = "3306";
    private $username = "root";
    private $password = "";
    //private $password = "v6a10fr4nc486";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
        $dsn="mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
  
        try{
            $this->conn = new PDO($dsn, $this->username, $this->password);
            //$this->conn = new PDO("pgsql:host=localhost;port=5432;dbname=PHP_tutorial", $this->username, $this->password);
    
      }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage() . "\n";
            echo "DSN = " . $dsn;
        }
        return $this->conn;
    }

    public function getUsuarioDao() {

        return new MysqlUsuarioDao($this->getConnection());

    }
    public function getProdutoDao() {

        return new MysqlProdutoDao($this->getConnection());

    }
    public function getFornecedorDao() {

        return new MysqlFornecedorDao($this->getConnection());

    }
    public function getEstoqueDao() {

        return new MysqlEstoqueDao($this->getConnection());

    }
}
?>
