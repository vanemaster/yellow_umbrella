<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

?>

<main role="main" class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?=$base?>/assets/img/cat-umbrella.png" alt="" width="72" height="72">
        <h2>Pedido Realizado Com Sucesso!</h2>
        <p class="lead">Obrigado por comprar em nossa loja :)</p>
        <a href="<?=$base?>/pedido/view_pedidos.php" class="btn btn-warning">Verificar Pedidos</a>
        <a href="<?=$base?>/index/view_index.php" class="btn btn-dark">Voltar para a Loja</a>
    </div>
</main>