<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

abstract class DaoFactory {

    protected abstract function getConnection();

    public abstract function getUsuarioDao();
}
?>