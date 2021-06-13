<?php
session_start();
include_once('../fachada.php');

ini_set('display_errors', 'On');

$result = "";

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

        $result = array('carrinho_itens' => $_SESSION['carrinho'], 'carrinho_qtde' => array_sum($_SESSION['carrinho']));
    }else{
        $result = array('erro' => "Estoque indisponível");
    }

    echo json_encode($result);
}

if(isset($_POST['remove_item'])){
    if (array_key_exists(intval($_POST['id_produto']),$_SESSION['carrinho'])) {
        unset($_SESSION['carrinho'][$_POST['id_produto']]);
    }

    $result = array('carrinho_itens' => $_SESSION['carrinho'], 'carrinho_qtde' => array_sum($_SESSION['carrinho']));

    header("Location: view_carrinho.php");
}

?>