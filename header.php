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
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Yellow Umbrella Store</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/sticky-footer.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">Yellow Umbrella Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?=$base?>/index/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php
              if(!isset($_SESSION["id_usuario"])){
            ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?=$base?>/login/view_login.php">Login</a>
                </li>
            <?php
              }
              if(isset($_SESSION["id_usuario"]) && trim($_SESSION["id_usuario"]) != ""){
            ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?=$base?>/produto/view_produtos.php">Produtos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=$base?>/fornecedor/view_fornecedores.php">Fornecedores</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=$base?>/estoque/view_estoque.php">Estoque</a>
                </li>
            <?php 
              }
            ?>
          </ul>
          <?php
            if(isset($_SESSION["id_usuario"]) && trim($_SESSION["id_usuario"]) != ""){
          ?>
            <span class='greetings-user'>Olá <?=$_SESSION["nome_usuario"]?></span>
            <a class="btn btn-danger btn-logout" href="<?=$base?>/login/executa_logout.php" onclick="return confirm('Você quer mesmo sair?')">Sair</a>
          <?php
            }
          ?>
          

          <!-- <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </nav>
    </header>