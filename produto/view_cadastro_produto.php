<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $dao = $factory->getFornecedorDao();
    $fornecedores = $dao->buscaTodos();
?>

<main role="main" class="container">
    <h3 class="mb-3">Novo Produto</h3>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <form action="cadastro_produto.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" class="form-control" name="nome" id="exampleFormControlInput1" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Fornecedor</label>
                    <select class="form-control" name="fornecedor_id" id="exampleFormControlSelect1" required>
                        <?php
                            if ($fornecedores){
                                foreach ($fornecedores as $item){
                        ?>
                                    <option value="<?=$item->getID()?>"><?=$item->getNome()?></option>
                        <?php
                                }
                            }else{
                                    echo "<option>Não há fornecedores cadastrados</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Enviar</button>
                    <a href="view_produtos.php" class="btn btn-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include "../footer.php"; ?>