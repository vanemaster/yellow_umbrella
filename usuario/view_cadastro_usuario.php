<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";
?>

<main role="main" class="container">
    <h3 class="mb-3">Novo Usuário</h3>
    <div class="row">
        <form action="cadastro_usuario.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" class="form-control" name="nome" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Email</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput2" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput3">Senha</label>
                <input type="password" class="form-control" name="senha" id="exampleFormControlInput3" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="view_usuarios.php" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</main>

<?php include "../footer.php"; ?>