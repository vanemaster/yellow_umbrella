<?php
    
    include "../fachada.php";
    session_start();
    include "../header.php";
    include "../login/verifica.php";

    $dao = $factory->getUsuarioDao();
    $usuarios = $dao->buscaTodos();

    $usuarios = (isset($_SESSION["usuarios"])) ? ($_SESSION["usuarios"]) : ($usuarios);
?>
<main role="main" class="container">
    <h3 class="mb-3">Lista de Usuarios</h3>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h3>".$_SESSION["message"]."</h3>";
                }
            ?>
        </div>
        <div class="col-8">
            <a href="view_cadastro_usuario.php" class="btn btn-success mb-2">Inserir novo</a>
        </div>
        <div class="col-4">
            <form class="form-inline mt-2 mt-md-0 form-search-list" action="<?=$base?>/usuario/executa_pesquisa.php" method="POST">
                <input class="form-control mr-sm-2" type="text" name="pesquisa" aria-label="Pesquisar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
        <div class="col-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Alterar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // include "../model/Usuario.php";
                if($usuarios){
                    foreach($usuarios as $item){
            ?>
                <tr>
                <th scope="row"><?=$item->getID()?></th>
                <td><?=$item->getNome()?></td>
                <td><?=$item->getEmail()?></td>
                <td><a href="view_editar_usuario.php?id=<?=$item->getID()?>" class="btn btn-dark">Alterar</button></td>
                <td><a href="exclui_usuario.php?id=<?=$item->getID()?>" id="excluiUsuario" class="btn btn-danger" onclick="return confirm('Você quer mesmo remover este usuario?')">Excluir</button></td>
                </tr>
            <?php 
                    }
                }else{
                    echo "<td colspan=5 style='text-align:center;'>Sem registros</td>";
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
</main>
<?php include "../footer.php"; ?>