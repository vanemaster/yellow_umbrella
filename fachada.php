<?php

error_reporting(E_ERROR | E_PARSE);

include_once('model/Usuario.php');
include_once('model/Produto.php');
include_once('model/Fornecedor.php');
include_once('model/Cliente.php');
include_once('model/Endereco.php');
include_once('model/Estado.php');
include_once('model/Estoque.php');
include_once('dao/UsuarioDao.php');
include_once('dao/ProdutoDao.php');
include_once('dao/FornecedorDao.php');
include_once('dao/ClienteDao.php');
include_once('dao/EnderecoDao.php');
include_once('dao/EstoqueDao.php');
include_once('dao/EstadoDao.php');
include_once('dao/DaoFactory.php');
include_once('dao/mysql/MysqlDaoFactory.php');
$factory = new MysqlDaofactory();


?>
