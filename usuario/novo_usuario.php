<?php
$page_title = "Demo : Inserção de Usuário";
// layout do cabeçalho
include_once "../header.php";
 ?>
 <main role="main" class="container">
    <h3 class="mb-3">Novo Usuário</h3>
    <div class="row">
        <form action="salva_usuario.php" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Email</td>
                    <td><input type='email' name='email' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Senha</td>
                    <td><input type='text' name='senha' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='nome' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Inserir</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</main>
<?php
// layout do rodapé
include_once "../footer.php";
?>


