<?php
session_start();
include_once "../header.php";
?>
<main role="main" class="container">
    <h3 class="mb-3">Entre!</h3>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h5>".$_SESSION["message"]."</h5>";
                }
            ?>
        </div>
        <div class="col-lg-6 col-sm-12">
            <form action="executa_login.php" method="POST" role="form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Enviar</button>
                    <a href="<?=$base?>/cliente/view_cadastro_cliente.php" class="btn btn-light">Cadastre-se</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php
// layout do rodapé
include_once "../footer.php";
?>
