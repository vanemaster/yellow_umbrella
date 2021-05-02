<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $dao = $factory->getEstoqueDao();
    $estoque = $dao->buscaTodos();
?>
<main role="main" class="container">
    <h3 class="mb-3">Lista de Estoque</h3>
    <div class="row">
        <div class="col-12">
            <a href="view_cadastro_estoque.php" class="btn btn-success mb-2">Inserir novo</a>
        </div>
        <div class="col-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço Unitário</th>
                <th scope="col">Alterar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($estoque){
                    foreach($estoque as $item){
            ?>
                <tr>
                <th scope="row"><?=$item->getID()?></th>
                <td><?=$item->getProduto()?></td>
                <td><?=$item->getQuantidade()?></td>
                <td><?=$item->getPreco()?></td>
                <td><a href="view_editar_estoque.php?id=<?=$item->getID()?>" class="btn btn-dark">Alterar</button></td>
                <td><a href="exclui_estoque.php?id=<?=$item->getID()?>" id="excluiProduto" class="btn btn-danger" onclick="return confirm('Você quer mesmo remover este estoque?')">Excluir</button></td>
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
    </div>
</main>
<?php include "../footer.php"; ?>