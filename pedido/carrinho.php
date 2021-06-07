<?php
session_start();
include_once('../fachada.php');

ini_set('display_errors', 'On');

$result = "";

// $_SESSION['carrinho'] = [];

if(isset($_POST['add_item'])){
    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = [];
    }

    $dao = $factory->getEstoqueDao();
    $produto = $dao->buscaPorProdutoId($_POST['id_produto']);

    if($produto->getQuantidade() > 0){
        if(!isset($_SESSION['carrinho'][$_POST['id_produto']])){
            $_SESSION['carrinho'][$_POST['id_produto']] = 1;
        }else{
            $_SESSION['carrinho'][$_POST['id_produto']] = $_SESSION['carrinho'][$_POST['id_produto']] + 1;
        }

        $dao->altera_estoque($_POST['id_produto'],$produto->getQuantidade() - 1);

        $result = array('carrinho_itens' => $_SESSION['carrinho'], 'carrinho_qtde' => count($_SESSION['carrinho']));
    }else{
        $result = array('erro' => "Estoque indisponível");
    }
}

if(isset($_POST['remove_item'])){
    if (($key = array_search($_POST['id_produto'], $_SESSION['carrinho'])) !== false) {
        unset($_SESSION['carrinho'][$key]);
    }

    $result = array('carrinho_itens' => $_SESSION['carrinho'], 'carrinho_qtde' => count($_SESSION['carrinho']));
}

echo json_encode($result);

?>