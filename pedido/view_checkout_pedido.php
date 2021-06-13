<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $dao_produtos = $factory->getProdutoDao();
    $produtos = [];

    if(isset($_SESSION['carrinho'])){
        $produtos = $dao_produtos->buscaCarrinho($_SESSION['carrinho']);
    }

    $dao_cliente = $factory->getClienteDao();
    $cliente = $dao_cliente->buscaPorUsuarioId($_SESSION['id_usuario']);

    $dao_endereco = $factory->getEnderecoDao();
    $endereco = $dao_endereco->buscaPorId($cliente->getEnderecoID());

    $dao_estados = $factory->getEstadoDao();
    $estado = $dao_estados->buscaPorId($endereco->getEstadoID());

    $preco_total = 0;
?>

<main role="main" class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?=$base?>/assets/img/cat-umbrella.png" alt="" width="72" height="72">
        <h2>Checkout Pedido</h2>
        <p class="lead">Verifique as suas informações, os produtos do carrinho e após confirme o pedido.</p>
    </div>
    <div class="row">
        <div class="col-12">
            <?php 
                if(isset($_SESSION["message"])){
                    echo "<h3>".$_SESSION["message"]."</h3>";
                }
            ?>
        </div>
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Seu carrinho</span>
            <span class="badge badge-secondary badge-pill"><?=array_sum($_SESSION['carrinho'])?></span>
          </h4>
          <ul class="list-group mb-3">
            <?php
                if(count($produtos)){
                    foreach($produtos as $item){
            ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?=$item->getNome()?></h6>
                                <small class="text-muted"><?=$item->getDescricao()?></small>
                            </div>
                            <span class="text-muted">
                                <?php 
                                    echo $item->getProdutoQuantidade() * $item->getProdutoPreco();
                                    $preco_total = $preco_total + $item->getProdutoQuantidade() * $item->getProdutoPreco();
                                ?>
                            </span>
                        </li>
            <?php
                    }
                }else{
                    echo "<li class='list-group-item d-flex justify-content-between lh-condensed'>
                    <div>
                        <h6 class='my-0'>Carrinho vazio</h6>
                    </div>";
                }
            ?>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (BRL)</span>
              <strong><?=$preco_total?></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Dados do Cliente</h4>
            <div class="row checkout-pedido-dados">
              <div class="col-md-12 mb-3 dados-cliente">
               <div class="col-md-4">Nome</div>
               <div class="col-md-8"><?=$cliente->getNome()?></div>
              </div>
              <div class="col-md-12 mb-3 dados-cliente">
               <div class="col-md-4">E-mail</div>
               <div class="col-md-8"><?=$cliente->getEmail()?></div>
              </div>
              <div class="col-md-12 mb-3 dados-cliente">
               <div class="col-md-4">Telefone</div>
               <div class="col-md-8"><?=$cliente->getTelefone()?></div>
              </div>
              <div class="col-md-12 mb-3 dados-cliente">
               <div class="col-md-4">Endereço</div>
               <div class="col-md-8"><?=$endereco->getRua()?>, <?=$endereco->getNumero()?> <?=$endereco->getBairro()?> - <?=$endereco->getComplemento()?> / <?=$endereco->getCidade()?> - <?=$estado->getEstado()?> CEP: <?=$endereco->getCep()?></div>
              </div>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Pagamento - Cartão de Crédito</h4>

            <div class="row checkout-pedido-dados">
                <div class="col-md-12 mb-3 dados-cliente">
                    <div class="col-md-4">Número</div>
                    <div class="col-md-8"><?=$cliente->getCartaoCredito()?></div>
                </div>
            <hr class="mb-4">
            <a class="btn btn-success btn-lg btn-block" href="<?=$base?>/pedido/cadastro_pedido.php">Confirmar pedido</a>
        </div>
    </div>
</main>