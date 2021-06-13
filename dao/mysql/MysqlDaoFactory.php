<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

include_once($_SERVER['DOCUMENT_ROOT'].'/yellow_umbrella/dao/DaoFactory.php');
include_once('MysqlUsuarioDao.php');
include_once('MysqlProdutoDao.php');
include_once('MysqlFornecedorDao.php');
include_once('MysqlEnderecoDao.php');
include_once('MysqlEstadoDao.php');
include_once('MysqlClienteDao.php');
include_once('MysqlPedidoDao.php');
include_once('MysqlItemPedidoDao.php');
include_once('MysqlEstoqueDao.php');

class MysqlDaofactory extends DaoFactory {

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "web2";
    private $port = "3306";
    private $username = "root";
    private $password = "v6a10fr4nc486";
    // private $password = "";
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
    public function getClienteDao() {

        return new MysqlClienteDao($this->getConnection());

    }
    public function getEnderecoDao() {

        return new MysqlEnderecoDao($this->getConnection());

    }
    public function getEstadoDao() {

        return new MysqlEstadoDao($this->getConnection());
    }
    public function getPedidoDao() {

        return new MysqlPedidoDao($this->getConnection());

    }
    public function getItemPedidoDao() {

        return new MysqlItemPedidoDao($this->getConnection());

    }
}
?>
