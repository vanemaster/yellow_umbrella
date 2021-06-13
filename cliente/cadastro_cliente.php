<?php

include_once('../fachada.php');

$redirect = '../pedido/view_carrinho.php';

if(!isset($_POST['cadastro_externo'])){
    include_once('../login/verifica.php');
    $redirect = 'view_clientes.php';    
}

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

if(!isset($_POST['bairro']) or $_POST['bairro'] == ''){
    $result = false;
}

if(!isset($_POST['cep']) or $_POST['cep'] == ''){
    $result = false;
}

if(!isset($_POST['cidade']) or $_POST['cidade'] == ''){
    $result = false;
}

if(!isset($_POST['estado_id']) or $_POST['estado_id'] == ''){
    $result = false;
}

if(!isset($_POST['senha']) or $_POST['senha'] == ''){
    $result = false;
}

if($result){
    $dao_cliente = $factory->getClienteDao();
    $dao_endereco = $factory->getEnderecoDao();
    $dao_usuario = $factory->getUsuarioDao();

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
        $endereco->setBairro($_POST['bairro']);
        $endereco->setCep($_POST['cep']);
        $endereco->setCidade($_POST['cidade']);
        $endereco->setEstadoID($_POST['estado_id']);
        $dao_endereco->altera($endereco);

        $usuario = $dao_usuario->buscaPorId($cliente->getUsuarioID());
        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha(md5($_POST['senha']));
        $usuario->setPerfilID(2);
        $dao_usuario->altera($usuario);
        
    }else{
        $endereco = new Endereco(null, $_POST['rua'], $_POST['numero'], $_POST['complemento'], $_POST['bairro'],$_POST['cep'],$_POST['cidade'], $_POST['estado_id']);
        $idInseridoEndereco = $dao_endereco->insere($endereco);

        $usuario = new Usuario(null, $_POST["nome"], $_POST["email"], md5($_POST["senha"]), 2);
        $idInseridoUsuario = $dao_usuario->insere($usuario);

        $cliente = new Cliente(null, $_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['cartao_credito'], $idInseridoEndereco, $idInseridoUsuario);
        $idInseridoCliente = $dao_cliente->insere($cliente);

        // Ja deixa o cliente logado
        if(isset($_POST['cadastro_externo'])){
            session_start();
            $_SESSION["id_usuario"]= $idInseridoUsuario; 
            $_SESSION["perfil_id"]= 2; 
            $_SESSION["nome_usuario"] = stripslashes($usuario->getNome());
        }

    }

    if(isset($_SESSION['clientes'])){
        unset($_SESSION['clientes']);
    }

    header('Location:'.$redirect);

}

?>