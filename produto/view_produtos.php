<?php
    include "../fachada.php";
    session_start();
    include "../header.php";
    include "../login/verifica.php";

    $dao = $factory->getProdutoDao();
    $produtos = $dao->buscaTodos();

    $produtos = (isset($_SESSION["produtos"])) ? ($_SESSION["produtos"]) : ($produtos);
?>
<main role="main" class="container">
    <h3 class="mb-3">Lista de Produtos</h3>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h3>".$_SESSION["message"]."</h3>";
                }
            ?>
        </div>
        <div class="col-lg-8 col-sm-12">
            <a href="view_cadastro_produto.php" class="btn btn-success mb-2">Inserir novo</a>
        </div>
        <div class="col-lg-4 col-sm-12">
            <form class="form-inline mt-2 mt-md-0 form-search-list" action="<?=$base?>/produto/executa_pesquisa.php" method="POST">
                <input class="form-control mr-sm-2" type="text" name="pesquisa" aria-label="Pesquisar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
        <div class="col-12">
        <table class="table table-responsive">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Fornecedor</th>
                <th scope="col">Alterar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($produtos){
                    foreach($produtos as $item){
            ?>
                <tr>
                <th scope="row"><?=$item->getID()?></th>
                <td><?=$item->getNome()?></td>
                <td><?=$item->getDescricao()?></td>
                <td><?=$item->getFornecedorNome()?></td>
                <td><a href="view_editar_produto.php?id=<?=$item->getID()?>" class="btn btn-dark">Alterar</button></td>
                <td><a href="exclui_produto.php?id=<?=$item->getID()?>" id="excluiProduto" class="btn btn-danger" onclick="return confirm('Você quer mesmo remover este produto?')">Excluir</button></td>
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