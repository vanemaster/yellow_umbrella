<?php

include_once('../fachada.php');
include_once('../login/verifica.php');

$result = true;

if(!isset($_POST['nome']) or $_POST['nome'] == ''){
    $result = false;
}

if(!isset($_POST['cartao_credito']) or $_POST['cartao_credito'] == ''){
    $result = false;
}

if(!isset($_POST['email']) or $_POST['email'] == ''){
    $result = false;
}

if(!isset($_POST['telefone']) or $_POST['telefone'] == ''){
    $result = false;
}

// Endereco
if(!isset($_POST['rua']) or $_POST['rua'] == ''){
    $result = false;
}

if(!isset($_POST['numero']) or $_POST['numero'] == ''){
    $result = false;
}

if(!isset($_POST['complemento']) or $_POST['complemento'] == ''){
    $result = false;
}

if(!isset($_POST['cidade']) or $_POST['cidade'] == ''){
    $result = false;
}

if(!isset($_POST['estado_id']) or $_POST['estado_id'] == ''){
    $result = false;
}

if($result){
    $dao_cliente = $factory->getClienteDao();
    $dao_endereco = $factory->getEnderecoDao();

    if(isset($_POST['id']) and $_POST['id'] != ''){
        $cliente = $dao_cliente->buscaPorId($_POST['id']);
        $cliente->setNome($_POST['nome']);
        $cliente->setCartaoCredito($_POST['cartao_credito']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTelefone($_POST['telefone']);
        $dao_cliente->altera($cliente);

        $endereco = $dao_endereco->buscaPorId($cliente->getEnderecoID());
        $endereco->setRua($_POST['rua']);
        $endereco->setNumero($_POST['numero']);
        $endereco->setComplemento($_POST['complemento']);
        $endereco->setCidade($_POST['cidade']);
        $endereco->setEstadoID($_POST['estado_id']);
        $dao_endereco->altera($endereco);
        
    }else{
        $endereco = new Endereco(null, $_POST['rua'], $_POST['numero'], $_POST['complemento'],$_POST['cidade'], $_POST['estado_id']);
        $idInseridoEndereco = $dao_endereco->insere($endereco);

        $cliente = new Cliente(null, $_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['cartao_credito'], $idInseridoEndereco);
        $idInseridoCliente = $dao_cliente->insere($cliente);
    }

    if(isset($_SESSION['clientes'])){
        unset($_SESSION['clientes']);
    }

    header('Location: view_clientes.php');

}

?>