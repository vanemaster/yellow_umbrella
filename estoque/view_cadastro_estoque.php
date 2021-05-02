<?php
    session_start();
    include "../fachada.php";
    include "../header.php";

    $dao = $factory->getProdutoDao();
    $produtos = $dao->buscaTodos();
?>

<main role="main" class="container">
    <h3 class="mb-3">Cadastrar Estoque</h3>
    <div class="row">
        <form action="cadastro_estoque.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Produto</label>
                <select class="form-control" name="produto_id" id="exampleFormControlSelect1" required>
                    <?php
                        if ($produtos){
                            foreach ($produtos as $item){
                    ?>
                                <option value="<?=$item->getID()?>"><?=$item->getNome()?></option>
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
                <input type="number" min=0 max=10000 class="form-control" name="quantidade" id="exampleFormControlInput1" required>
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Preço Unitário</label>
                <input type="text" class="form-control money" name="preco" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="view_produtos.php" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</main>
<?php include "../footer.php"; ?>