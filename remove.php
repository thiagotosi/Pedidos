<?php

require_once "conn.php";
//require_once "login.php";

/*if ($_SESSION['cliente_logado'] != null && time() > $_SESSION['cliente_logado']){
	unset($_SESSION['cliente_logado']);
	session_destroy();
	return 0;
	header("Location: index.php");
}*/

$id = $_POST['id'];

$dado_descricao = $_POST['campo_descricao'];

$sql = "UPDATE u925420712_pedidos_grao.pedidos SET pedidos.ativo=0, pedidos.dataModificacao = NOW() WHERE pedidos.id=$id";

if ($conn->query($sql) === TRUE) {
    //$conn->close();
return 1;
} else {
    return 0;
}
header("Location: index.php");
