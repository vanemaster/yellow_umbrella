<?php
    session_start();
    include "../fachada.php";
    include "../header.php";

    $id = @$_GET["id"];
    $dao = $factory->getEstoqueDao();
    $estoque = $dao->buscaPorId($id);

    if($estoque==null) {
        $estoque = new Estoque(null, null, null, null, null);
    }

    $dao = $factory->getProdutoDao();
    $produtos = $dao->buscaTodos();
?>

<main role="main" class="container">
    <h3 class="mb-3">Alterar Estoque</h3>
    <div class="row">
        <form action="cadastro_estoque.php" method="post">
            <input type="hidden" name="id" value="<?=$estoque->getId()?>"/>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Produto</label>
                <select class="form-control" name="produto_id" id="exampleFormControlSelect1">
                    <?php
                        if ($produtos){
                            foreach ($produtos as $item){
                    ?>
                                <option value="<?=$item->getID()?>" <?php if($item->getID() == $estoque->getProduto()){echo "selected='selected'";}?>><?=$item->getNome()?></option>
                    <?php
                            }
                        }else{
                                echo "<option>Não há produtos cadastrados</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Quantidade</label>
                <input type="number" class="form-control" value="<?=$estoque->getQuantidade()?>" name="quantidade" id="exampleFormControlInput1" required>
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Preço Unitário</label>
                <input type="text" class="form-control money" name="preco" value="<?=$estoque->getPreco()?>" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="view_produtos.php" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</main>

<?php include "../footer.php"; ?>