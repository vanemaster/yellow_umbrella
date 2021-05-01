<?php
    session_start();
    include "../fachada.php";
    include "../header.php";

    $dao = $factory->getProdutoDao();
    $produtos = $dao->buscaTodos();
?>
<main role="main" class="container">
    <h3 class="mb-3">Lista de Produtos</h3>
    <div class="row">
        <div class="col-12">
            <a href="view_cadastro_produto.php" class="btn btn-success mb-2">Inserir novo</a>
        </div>
        <div class="col-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Alterar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($produtos as $item){
            ?>
                <tr>
                <th scope="row"><?=$item->getID()?></th>
                <td><?=$item->getNome()?></td>
                <td><?=$item->getDescricao()?></td>
                <td><a href="view_editar_produto.php?id=<?=$item->getID()?>" class="btn btn-dark">Alterar</button></td>
                <td><a href="exclui_produto.php?id=<?=$item->getID()?>" class="btn btn-danger">Excluir</button></td>
                </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
<main>
<?php include "../footer.php"; ?>