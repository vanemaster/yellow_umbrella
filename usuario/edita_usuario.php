<?php
include_once "../fachada.php";
include_once "../header.php";

$id = @$_GET["id"];

$dao = $factory->getUsuarioDao();
$usuario = $dao->buscaPorId($id);
if($usuario==null) {
    $usuario = new Usuario(null,null, null, null);
}
?>

<html>

	<head>
		<title>Cadastro de usuário</title>
	</head>
	<body>
	
		<h1>Edita o Cadastro de usuário</h1>

        <form action="salvaUsuario.php" method=post>
            <label for="id">Id:</label>
            <input type= "text" value="<?=$usuario->getId()?>" name="id"/>
            <br>
            <label for="email">e-mail:</label>
            <input type= "text" value="<?=$usuario->getEmail()?>" name="email"/>
            <br>
            <label for="senha">Senha:</label>
            <input type= "password" value="<?=$usuario->getSenha()?>" name="senha"/>
            <br>
            <label for="nome">Nome:</label>
            <input type= "text" value="<?=$usuario->getNome()?>" name="nome"/>
            <br>
            <input type= "submit" value="Salvar"/>
        </form>
        <br>
        <a href="usuarios.php">Voltar</a>
		  
    </body>
    <?php include_once "../footer.php";?>
</html>