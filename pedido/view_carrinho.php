<?php
    include "../fachada.php";
    session_start();
    include "../header.php";

    $dao = $factory->getProdutoDao();
    $produtos = [];

    if(isset($_SESSION['carrinho'])){
        $produtos = $dao->buscaCarrinho($_SESSION['carrinho']);
    }

    $preco_total = 0;

?>
<main role="main" class="container">
    <h3 class="mb-3">Carrinho</h3>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h3>".$_SESSION["message"]."</h3>";
                }
            ?>
        </div>
        <div class="col-lg-12 col-sm-12">
            <a href="checkout_pedido.php" class="btn btn-success mb-2">Finalizar Pedido</a>
        </div>
        <div class="col-12">
        <table class="table table-responsive">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Preço Unitário</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Total</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(count($produtos)){
                    foreach($produtos as $item){
            ?>
                        <tr>
                            <th><img src="<?php echo $base."/produto/imagens/".$item->getImagem();?>" class='imagem-produto img-thumbnail img-carrinho' id='imagem-produto'></th>
                            <td><?=$item->getNome()?></td>
                            <td><?=$item->getDescricao()?></td>
                            <td><?=$item->getProdutoPreco()?></td>
                            <td><?=$item->getProdutoQuantidade()?></td>
                            <td><?php 
                                    echo $item->getProdutoQuantidade() * $item->getProdutoPreco();
                                    $preco_total = $preco_total + $item->getProdutoQuantidade() * $item->getProdutoPreco();
                                ?>
                            </td>
                            <td><a href="exclui_produto.php?id=<?=$item->getID()?>" id="excluiProduto" class="btn btn-danger" onclick="return confirm('Você quer mesmo remover este produto?')">Excluir</button></td>
                        </tr>
            <?php 
                    }
            ?>
                    <tr>
                        <td colspan="6" style="text-align:right;">Total</td>
                        <td colspan="1" style="text-align:left;">
                            <?=$preco_total?>
                        </td>
                    </tr>
            <?php
                }else{
                    echo "<td colspan=6 style='text-align:center;'>Carrinho vazio</td>";
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
</main>
<?php include "../footer.php"; ?>