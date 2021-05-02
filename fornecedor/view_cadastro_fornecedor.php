<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
?>

<main role="main" class="container">
    <h3 class="mb-3">Novo Fornecedor</h3>
    <div class="row">
        <form action="cadastro_fornecedor.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" class="form-control" name="nome" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descrição</label>
                <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput2" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput3">Telefone</label>
                <input type="text" class="form-control telefone" name="telefone" id="exampleFormControlInput3" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="view_fornecedores.php" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</main>

<?php include "../footer.php"; ?>