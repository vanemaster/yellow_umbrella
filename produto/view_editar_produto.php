<?php
    session_start();
    include "../fachada.php";
    include "../header.php";

    $id = @$_GET["id"];
    $dao = $factory->getProdutoDao();
    $produto = $dao->buscaPorId($id);

    if($produto==null) {
        $produto = new Produto(null,null, null, null);
    }
?>

<main role="main" class="container">
    <h3 class="mb-3">Alterar Produto</h3>
    <div class="row">
        <form action="cadastro_produto.php" method="post">
            <input type="hidden" name="id" value="<?=$produto->getId()?>"/>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" value="<?=$produto->getNome()?>" class="form-control" name="nome" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descrição</label>
                <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3"><?=$produto->getDescricao()?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="view_produtos.php" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</main>

<?php include "../footer.php"; ?>