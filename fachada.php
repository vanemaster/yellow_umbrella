<?php

error_reporting(E_ERROR | E_PARSE);

include_once('model/Usuario.php');
include_once('dao/UsuarioDao.php');
include_once('dao/DaoFactory.php');
include_once('dao/postgres/PostgresDaoFactory.php');
include_once('dao/mysql/MysqlDaoFactory.php');

//$factory = new PostgresDaofactory();
$factory = new MysqlDaofactory();


?>
