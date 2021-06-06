<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $dao = $factory->getPedidoDao();
    $pedidos = $dao->buscaTodos();
?>

<main role="main" class="container">
    <h3 class="mb-3">Novo Pedido</h3>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h3>".$_SESSION["message"]."</h3>";
                }
            ?>
        </div>
        <div class="col-lg-6 col-sm-12">
            <form action="cadastro_pedido.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Numero</label>
                    <input type="text" class="form-control" name="numero" id="exampleFormControlInput1" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Data de pedido</label>
                    <input type="text" class="form-control data" name="data_pedido" id="exampleFormControlInput2" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Data de entrega</label>
                    <input type="text" class="form-control data" name="data_entrega" id="exampleFormControlInput3" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput4">Situação</label>
                        <select class="form-control" name="situacao" id="exampleFormControlInput4" required>
                            <option value="1">Novo</option>
                            <option value="2">Entregue</option>
                            <option value="3">Cancelado</option>
                        </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Enviar</button>
                    <a href="view_pedidos.php" class="btn btn-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include "../footer.php"; ?>