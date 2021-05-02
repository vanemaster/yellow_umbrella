<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $id = @$_GET["id"];
    $dao = $factory->getFornecedorDao();
    $fornecedor = $dao->buscaPorId($id);

    if($fornecedor==null) {
        $fornecedor = new Fornecedor(null,null, null, null);
    }
?>

<main role="main" class="container">
    <h3 class="mb-3">Alterar Fornecedor</h3>
    <div class="row">
        <form action="cadastro_fornecedor.php" method="post">
            <input type="hidden" name="id" value="<?=$fornecedor->getId()?>"/>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" value="<?=$fornecedor->getNome()?>" class="form-control" name="nome" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descrição</label>
                <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3"><?=$fornecedor->getDescricao()?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Email</label>
                <input type="email" class="form-control" name="email" value="<?=$fornecedor->getEmail()?>" id="exampleFormControlInput2">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput3">Telefone</label>
                <input type="text" class="form-control telefone" name="telefone" value="<?=$fornecedor->getTelefone()?>" id="exampleFormControlInput3">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="view_fornecedores.php" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</main>

<?php include "../footer.php"; ?>