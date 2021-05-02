<?php
    session_start();
    include "../fachada.php";
    include "../header.php";

    $dao = $factory->getUsuarioDao();
    $usuarios = $dao->buscaTodos();
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
        <div class="col-12">
            <a href="view_cadastro_usuario.php" class="btn btn-success mb-2">Inserir novo</a>
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
<main>
<?php include "../footer.php"; ?>