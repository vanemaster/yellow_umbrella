<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Loja Web II</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/sticky-footer.css" rel="stylesheet">
  </head>

<body class="text-center">
    <header class="titulo">
        <div class="row">
            <div class="col-sm">
                <h1>Bem vindo à loja web!!</h1>
            </div>
        </div>
    </header>
    <div class="row-login">
        <div class="col-md-4 offset-md-4">    
            <form class="form-signin">
                <label for="inputEmail" class="sr-only">Email de Login</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email de Login" required="" autofocus="">
                <label for="inputPassword" class="sr-only">Senha</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="">
                <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="remember-me">Me Lembre
                </label>
                </div>
                <button type="button" class="btn btn-outline-secondary btn-lg btn-block">Entrar</button>
                <p class="mt-5 mb-3 text-muted">© 2021</p>
            </form>
        </div>
    </div>
</body>
<?php include "footer.php"; ?>