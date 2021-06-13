<?php
    
    include "../fachada.php";
    session_start();
    include "../header.php";

    $dao = $factory->getProdutoDao();
    $produtos = $dao->buscaTodos();

    $produtos = (isset($_SESSION["produtos_index"])) ? ($_SESSION["produtos_index"]) : ($produtos);
?>
<main role="main" class="container">
    <?php
        if(isset($_SESSION["id_usuario"]) && trim($_SESSION["id_usuario"]) != "" && isset($_SESSION["perfil_id"]) && trim($_SESSION["perfil_id"]) == 1){
    ?>
        <div class="row">
            <div class="col-4 index-cover">
                <img src="../assets/img/cat-umbrella.png">
            </div>
            <div class="col-8 welcome-message">
                <h4>Bem Vindo(a) à <span style="color:#ffff00;">Y</span>ellow <span style="color:#ffff00;">U</span>mbrella!</h4>
            </div>
        </div>
    <?php
        }else{
    ?>
        <section class="jumbotron text-center">
            <div class="col-5 jumbotron-content-img">
                <img class="img-jumbotron" src="<?=$base?>/assets/img/cat-umbrella.png"/>
            </div>
            <div class="col-5 jumbotron-content-text">
                <div class="col-12">
                    <h1 class="jumbotron-heading"><span style="color:#ffff00;">Y</span>ellow <span style="color:#ffff00;">U</span>mbrella!</h1>
                    <p class="lead text-muted">Seja bem vindo(a) à casa dos guarda chuvas! Conheça nossos modelos e encante-se!</p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 pesquisa-wrapper">
                        <form class="form-inline mt-2 mt-md-0 form-search-index" action="<?=$base?>/index/pesquisa_produtos.php" method="POST">
                            <input class="form-control mr-sm-2" type="text" name="pesquisa" aria-label="Pesquisar" placeholder="Digite o nome do produto">
                            <button class="btn btn-dark my-2 my-sm-0" type="submit">Pesquisar</button>
                        </form>
                        <form class="form-search-index" action="<?=$base?>/index/pesquisa_produtos.php" method="POST">
                            <input type="hidden" name="limpar_pesquisa" value="0"/>
                            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Limpar Pesquisa</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <?php
                        if($produtos){
                            foreach($produtos as $produto){
                    ?>
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow item-produto-card">
                                        <img class="card-img-top imagem-produto-card" src="<?=$base?>/produto/imagens/<?=$produto->getImagem()?>" alt="Imagem produto">
                                        <div class="card-body">
                                            <p class="card-text"><?=$produto->getNome()?></p>
                                            <p class="card-text"><?=$produto->getDescricao()?></p>
                                            <?php
                                                if($produto->getProdutoPreco() > 0){
                                            ?>
                                                    <p class="card-text">R$ <?=$produto->getProdutoPreco()?></p>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-warning btn-add-cart" id="<?=$produto->getID()?>">Adicionar ao carrinho</button>
                                                        </div>
                                                    </div>
                                            <?php 
                                                }else{
                                            ?>
                                                    <p class="card-text produto-indisponivel">Indisponivel</p>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-dark">Avise-me</button>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                    <?php 
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
</main>
<?php include "../footer.php"; ?>