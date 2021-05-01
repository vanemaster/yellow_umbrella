<?php
include_once "fachada.php";
?>

<!DOCTYPE HTML>

<html lang=pt-br>

<head>
	<meta charset="UTF-8">

	<style>
			table, th, td {
  				border: 1px solid black;
			}
			table.center {
  				margin-left: auto;
  				margin-right: auto;
			}
	</style>

	<title>Lista de usuários</title>
</head>

<body>

<h1>Lista de usuários</h1>

<?php

echo "<section>";

// procura usuários

$dao = $factory->getUsuarioDao();
$usuarios = $dao->buscaTodos();


// mostra os usuários, se tiver
if($usuarios) {
 
	echo "<table>";
	echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Login</th>";
		echo "<th>Nome</th>";
		echo "<th>Excluir</th>";
	echo "</tr>";

	//while ($row = $usuarios->fetch(PDO::FETCH_ASSOC)){
	//	extract($row);

	foreach ($usuarios as $umUsuario) {

		echo "<tr>";
			echo "<td>";
			// link para editar um usuário
	   		echo "<a href='editaUsuario.php?id={$umUsuario->getId()}'>{$umUsuario->getId()}</a>";
	   		echo "</td>";
			echo "<td>{$umUsuario->getLogin()}</td>";
			echo "<td>{$umUsuario->getNome()}</td>";
			echo "<td>";
 			// link para excluir um usuário
			echo "<a href='excluiUsuario.php?id={$umUsuario->getId()}' onclick=\"return confirm('Quer mesmo excluir?');\">X</a>";
			echo "</td>";
 
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "<p>Não foram encontrados registros";
}
 
echo "</section>";


?>
<section>
<h1>Informações do banco de dados:</h1>
Driver : <?=$dao->getDriver()?><br>
Versão do servidor  : <?=$dao->getServerVersion()?><br>
Versão da lib  : <?=$dao->getClientVersion()?><br>
AutoCommit? : <?=$dao->getAutoCommitMode()?><br>
</section>

<br>
<a href="editaUsuario.php">Novo</a>

</body>
</html>