<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>Cadastro de Gastos</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<script src="js/bootstrap.js"></script>

		<style>
			.left { float:left;}
		</style>
		</head>
		<body style="padding:50px 5px; ">
	   		<p><a href="index.php"> Voltar</a></p>
<?php

require_once "conn.php";


$sql = "SELECT * FROM pedidos ORDER BY pedidos.dataModificacao";

$result = $conn->query($sql);

if ($result->num_rows > 0) {


    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo  "Remover - " .$row["descricao"] . "<br />";
    }
}

$conn->close();


unset( $_POST );
?>



  </body>
</html>
