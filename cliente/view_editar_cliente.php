<?php
    session_start();
    include "../fachada.php";
    include "../header.php";
    include "../login/verifica.php";

    $id = @$_GET["id"];
    
    $dao_cliente = $factory->getClienteDao();
    $cliente = $dao_cliente->buscaPorId($id);

    if($cliente==null) {
        $cliente = new Cliente(null,null,null,null);
    }
    
    $dao_endereco = $factory->getEnderecoDao();
    $endereco = $dao_endereco->buscaPorId($cliente->getEnderecoID());

    if($endereco==null) {
        $endereco = new Endereco(null,null,null,null,null,null);
    }

    $dao_estados = $factory->getEstadoDao();
    $estados = $dao_estados->buscaTodos();

?>

<main role="main" class="container">
    <h3 class="mb-3">Alterar Cliente</h3>
    <div class="row">
        <div class="col-lg-6 col-sm-12">  
            <form action="cadastro_cliente.php" method="post">
                <input type="hidden" name="id" value="<?=$cliente->getId()?>"/>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" value="<?=$cliente->getNome()?>" class="form-control" name="nome" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="inputCartao">Cartão Crédito</label>
                    <input type="text" value="<?=$cliente->getCartaoCredito()?>" class="form-control" name="cartao_credito" id="inputCartao">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Email</label>
                    <input type="email" class="form-control" name="email" value="<?=$cliente->getEmail()?>" id="exampleFormControlInput2">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Telefone</label>
                    <input type="text" class="form-control telefone" name="telefone" value="<?=$cliente->getTelefone()?>" id="exampleFormControlInput3">
                </div>
                <fieldset class="fieldset-forms">
                    <legend class="legend-fieldset-forms">Endereço</legend>
                    <div class="form-group">
                        <label for="inputRua">Rua</label>
                        <input type="text" class="form-control" name="rua" value="<?=$endereco->getRua()?>" id="inputRua" required>
                    </div>
                    <div class="form-group">
                        <label for="inputNumero">Numero</label>
                        <input type="number" min="0" max="1000000" class="form-control" name="numero" value="<?=$endereco->getNumero()?>" id="inputNumero" required>
                    </div>
                    <div class="form-group">
                        <label for="inputComplemento">Complemento</label>
                        <input type="text" class="form-control" name="complemento" value="<?=$endereco->getComplemento()?>" id="inputComplemento" required>
                    </div>
                    <div class="form-group">
                        <label for="inputCidade">Cidade</label>
                        <input type="text" class="form-control" name="cidade" value="<?=$endereco->getCidade()?>" id="inputCidade" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado_id" id="estado" class="form-control">
                        <?php 
                            foreach ($estados as $item){
                                echo $item->getID();
                        ?>
                            <option value="<?=$item->getID()?>" <?php if($item->getID() == $endereco->getEstadoID()){echo "selected='selected'";}?>><?=$item->getEstado()?></option>
                        <?php 
                            }
                        ?>
                        </select>
                    </div>
                </fieldset>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Enviar</button>
                    <a href="view_clientees.php" class="btn btn-light">Cancelar</a>
                </div>
            </form>
        </div> 
    </div>
</main>

<?php include "../footer.php"; ?>