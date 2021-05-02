<?php
    session_start();
    include "../fachada.php";
    include "../header.php";

    $dao = $factory->getFornecedorDao();
    $fornecedores = $dao->buscaTodos();
?>
<main role="main" class="container">
    <h3 class="mb-3">Lista de Fornecedores</h3>
    <div class="row">
        <div class="col-12">
            <a href="view_cadastro_fornecedor.php" class="btn btn-success mb-2">Inserir novo</a>
        </div>
        <div class="col-12">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Alterar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($fornecedores as $item){
            ?>
                <tr>
                <th scope="row"><?=$item->getID()?></th>
                <td><?=$item->getNome()?></td>
                <td><?=$item->getDescricao()?></td>
                <td><?=$item->getEmail()?></td>
                <td><?=$item->getTelefone()?></td>
                <td><a href="view_editar_fornecedor.php?id=<?=$item->getID()?>" class="btn btn-dark">Alterar</button></td>
                <td><a href="exclui_fornecedor.php?id=<?=$item->getID()?>" id="excluiFornecedor" class="btn btn-danger" onclick="return confirm('Você quer mesmo remover este fornecedor?')">Excluir</button></td>
                </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
<main>
<?php include "../footer.php"; ?>