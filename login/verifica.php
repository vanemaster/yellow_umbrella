<?php 
// Inicia sessões 
include_once "comum.php";

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) 
{ 
    $_SESSION["message"] = "Por favor faça login ou cadastre-se";
    // Usuário não logado! Redireciona para a página de login 
    header("Location: ../login/view_login.php"); 
} 
?>