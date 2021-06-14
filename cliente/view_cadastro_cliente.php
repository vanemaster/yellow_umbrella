<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    // include "../login/verifica.php";

    $dao_estados = $factory->getEstadoDao();
    $estados = $dao_estados->buscaTodos();
?>

<main role="main" class="container">
    <?php 
        if(!isset($_SESSION['perfil_id'])){
    ?>
            <h3 class="mb-3">Preencha seus Dados</h3>
    <?php
        }else{
    ?>
            <h3 class="mb-3">Novo Cliente</h3>
    <?php
        }
    ?>
    
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <form action="cadastro_cliente.php" method="post">
                <?php 
                    if(isset($_SESSION['perfil_id']) && trim($_SESSION['perfil_id']) == "2"){
                ?>
                        <input type="hidden" name="cadastro_externo" value="0"/>
                <?php 
                    }
                ?>
                <div class="form-group">
                    <label for="inputNome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="inputNome" required>
                </div>
                <div class="form-group">
                    <label for="inputCartao">Cartão Credito</label>
                    <input type="text" class="form-control" name="cartao_credito" id="inputCartao" required>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" required>
                </div>
                <div class="form-group">
                    <label for="inputTelefone">Telefone</label>
                    <input type="text" class="form-control telefone" name="telefone" id="inputTelefone" required>
                </div>
                <div class="form-group">
                    <label for="inputSenha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="inputSenha" required>
                </div>
                <fieldset class="fieldset-forms">
                    <legend class="legend-fieldset-forms">Endereço</legend>
                    <div class="form-group">
                        <label for="inputRua">Rua</label>
                        <input type="text" class="form-control" name="rua" id="inputRua" required>
                    </div>
                    <div class="form-group">
                        <label for="inputNumero">Numero</label>
                        <input type="number" min="0" max="1000000" class="form-control" name="numero" id="inputNumero" required>
                    </div>
                    <div class="form-group">
                        <label for="inputComplemento">Complemento</label>
                        <input type="text" class="form-control" name="complemento" id="inputComplemento" required>
                    </div>
                    <div class="form-group">
                        <label for="inputBairro">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="inputBairro" required>
                    </div>
                    <div class="form-group">
                        <label for="inputCep">Cep</label>
                        <input type="text" class="form-control" name="cep" id="inputCep" required>
                    </div>
                    <div class="form-group">
                        <label for="inputCidade">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="inputCidade" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado_id" id="estado" class="form-control">
                        <?php 
                            foreach ($estados as $item){
                        ?>
                            <option value="<?=$item->getId()?>"><?=$item->getEstado()?></option>
                        <?php 
                            }
                        ?>
                        </select>
                    </div>
                </fieldset>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Enviar</button>
                    <a href="view_clientes.php" class="btn btn-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include "../footer.php"; ?>