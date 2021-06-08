<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";
?>

<main role="main" class="container">
    <h3 class="mb-3">Novo Usuário</h3>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
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
                    <label for="perfil">Perfil</label>
                    <select name="perfil_id" id="perfil" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Cliente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Senha</label>
                    <input type="password" class="form-control" name="senha" id="exampleFormControlInput3" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Enviar</button>
                    <a href="view_usuarios.php" class="btn btn-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include "../footer.php"; ?>