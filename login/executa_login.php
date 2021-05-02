<?php 
// Métodos de acesso ao banco de dados 
require "../fachada.php"; 
 
// Inicia sessão 
session_start();
$_SESSION["message"] = "";

// Recupera o login 
$email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE; 

// Recupera a senha, a criptografando em MD5 
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

// Usuário não forneceu a senha ou o login 
if(!$email || !$senha) 
{ 
    $_SESSION["message"] = "E-mail ou senha incorretos!<br>";
    header("Location: view_login.php"); 
}  

$dao = $factory->getUsuarioDao();
$usuario = $dao->buscaPorEmail($email);

$problemas = FALSE;
if($usuario) {
    // Agora verifica a senha 
    if(!strcmp($senha, $usuario->getSenha())) 
    { 
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
        $_SESSION["id_usuario"]= $usuario->getId(); 
        $_SESSION["nome_usuario"] = stripslashes($usuario->getNome()); 
        //$_SESSION["permissao"]= $dados["postar"]; 
        header("Location: ../index/view_index.php"); 
        exit; 
    } else {
        $problemas = TRUE; 
    }
} else {
    $problemas = TRUE; 
}

if($problemas==TRUE) {
    $_SESSION["message"] = "E-mail ou senha incorretos!<br>";
    header("Location: view_login.php"); 
}
?>