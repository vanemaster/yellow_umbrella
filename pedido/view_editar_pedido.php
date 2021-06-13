<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $id = @$_GET["id"];
    $dao = $factory->getPedidoDao();
    $pedido = $dao->buscaPorId($id);

    if($pedido==null) {
        $pedido = new Pedido(null,null,null, null, null,null);
    }
?>

<main role="main" class="container">
    <h3 class="mb-3">Alterar Pedido</h3>
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
                <input type="hidden" name="id" value="<?=$pedido->getId()?>"/>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Numero</label>
                    <input type="text" class="form-control" value="<?=$pedido->getNumero()?>" name="numero" id="exampleFormControlInput1" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Data de pedido</label>
                    <input type="text" class="form-control" value="<?=$pedido->getDataPedido()?>" name="data_pedido" id="exampleFormControlInput2" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Data de entrega</label>
                    <input type="text" class="form-control" value="<?=$pedido->getDataEntrega()?>" name="data_entrega" id="exampleFormControlInput3" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput4">Situação</label>
                        <select class="form-control" name="situacao" id="exampleFormControlInput4" required>
                            <option value="1" <?php if($pedido->getSituacao() == 1){echo "selected='selected'";}?>>Novo</option>
                            <option value="2" <?php if($pedido->getSituacao() == 2){echo "selected='selected'";}?>>Entregue</option>
                            <option value="3" <?php if($pedido->getSituacao() == 3){echo "selected='selected'";}?>>Cancelado</option>
                        </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Editar</button>
                    <a href="view_pedidoes.php" class="btn btn-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include "../footer.php"; ?>