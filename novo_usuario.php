<?php
$page_title = "Demo : Inserção de Usuário";
// layout do cabeçalho
include_once "header.php";
 ?>
 <section>
<form action="insere_usuario.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
         <tr>
            <td>Login</td>
            <td><input type='text' name='login' class='form-control' /></td>
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
</section>
<?php
// layout do rodapé
include_once "footer.php";
?>


