<?php
  $httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';

  $base = $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/yellow_umbrella';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/umbrella.ico">

    <title>Yellow Umbrella Store</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="../assets/css/sticky-footer.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?=$base?>/index/view_index.php">Yellow Umbrella Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <?php
              if(!isset($_SESSION["id_usuario"])){
            ?>
                <li class="nav-item active">
                  <a class="nav-link" href="<?=$base?>/login/view_login.php">Login</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link btn btn-outline-dark"" href="<?=$base?>/login/view_cadastro_cliente.php">Cadastre-se</a>
                </li>
            <?php
              }
              if(isset($_SESSION["id_usuario"]) && trim($_SESSION["id_usuario"]) != ""){
                if(isset($_SESSION["perfil_id"])){
                  if(trim($_SESSION["perfil_id"]) == "1"){
            ?>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?=$base?>/cliente/view_clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?=$base?>/produto/view_produtos.php">Produtos</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?=$base?>/fornecedor/view_fornecedores.php">Fornecedores</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?=$base?>/estoque/view_estoque.php">Estoque</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="<?=$base?>/usuario/view_usuarios.php">Usuários</a>
                    </li>
            <?php 
                  }  
                }
                if(trim($_SESSION["perfil_id"]) == "2"){
            ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="<?=$base?>/cliente/view_editar_cliente.php">Alterar seus dados</a>
                  </li>
            <?php
                }
              }
            ?>
          </ul>
          <?php
            if(isset($_SESSION["id_usuario"]) && trim($_SESSION["id_usuario"]) != ""){
          ?>
            <span class='greetings-user'>Olá <?=$_SESSION["nome_usuario"]?></span>
            <a class="btn btn-secondary btn-logout" href="<?=$base?>/login/executa_logout.php" onclick="return confirm('Você quer mesmo sair?')">Sair</a>
          <?php
            }
          ?>
        </div>
        <div class="carrinho-wrapper">
          <a href="<?=$base?>/pedido/view_carrinho.php" class="bi-cart4 btn btn-dark ml-3" style="font-size:1.25rem;" title="icon name" aria-hidden="true">
            <span class='carrinho-counter'>
              <?php 
                if(isset($_SESSION['carrinho'])){
                  echo array_sum($_SESSION['carrinho']);
                }
              ?>
            </span>
          </a>
        </div>
      </nav>
    </header>