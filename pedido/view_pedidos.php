<?php
    include "../fachada.php";
    session_start();
    include "../header.php";
    include "../login/verifica.php";

    $dao = $factory->getPedidoDao();
    $pedidos = $dao->buscaTodos();

    $pedidos = (isset($_SESSION["pedidos"])) ? ($_SESSION["pedidos"]) : ($pedidos);
?>
<main role="main" class="container">
    <h3 class="mb-3">Lista de Pedidos</h3>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h3>".$_SESSION["message"]."</h3>";
                }
            ?>
        </div>
        <?php
            if(isset($_SESSION['perfil_id']) && trim($_SESSION['perfil_id']) == "1"){
        ?>
            <div class="col-lg-8 col-sm-12">
                <a href="view_cadastro_pedido.php" class="btn btn-success mb-2">Inserir novo</a>
            </div>
            <div class="col-lg-4 col-sm-12">
                <form class="form-inline mt-2 mt-md-0 form-search-list" action="<?=$base?>/pedido/executa_pesquisa.php" method="POST">
                    <input class="form-control mr-sm-2" type="text" name="pesquisa" aria-label="Pesquisar">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </div>
        <?php 
            }
        ?>
        <div class="col-12">
            <table class="table table-responsive">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Data do pedido</th>
                    <th scope="col">Data da entrega</th>
                    <th scope="col">Situação</th>
                    <?php
                        if(isset($_SESSION['perfil_id']) && trim($_SESSION['perfil_id']) == "1"){
                    ?>
                            <th scope="col">Alterar</th>
                            <th scope="col">Excluir</th>
                    <?php 
                        }
                    ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($pedidos){
                        foreach($pedidos as $item){
                ?>
                    <tr id="<?=$item->getID()?>">
                        <th class="item-pedido-lista" scope="row"><?=$item->getID()?></th>
                        <td class="item-pedido-lista"><?=$item->getNumero()?></td>
                        <td class="item-pedido-lista"><?=$item->getClienteNome()?></td>
                        <td class="item-pedido-lista"><?=$item->getDataPedido()?></td>
                        <td class="item-pedido-lista"><?=$item->getDataEntrega()?></td>
                        <td class="item-pedido-lista">
                            <?php
                                switch($item->getSituacao()){
                                    case 1:
                                        echo "Novo";
                                        break;
                                    case 2:
                                        echo "Entregue";
                                        break;
                                    case 3:
                                        echo "Cancelado";
                                        break;
                                }
                            ?>
                        </td>
                        <?php
                            if(isset($_SESSION['perfil_id']) && trim($_SESSION['perfil_id']) == "1"){
                        ?>
                            <td><a href="view_editar_pedido.php?id=<?=$item->getID()?>" class="btn btn-dark">Alterar</button></td>
                            <td><a href="exclui_pedido.php?id=<?=$item->getID()?>" id="excluiPedido" class="btn btn-danger" onclick="return confirm('Você quer mesmo remover este pedido?')">Excluir</button></td>
                    
                        <?php 
                            }    
                        ?>
                    </tr>
                <?php 
                        }
                    }else{
                        echo "<td colspan=6 style='text-align:center;'>Sem registros</td>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-12" id="item-pedido-detalhe">

        </div>
    </div>
</main>
<?php include "../footer.php"; ?>