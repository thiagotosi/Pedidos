<?php
require_once "conn.php";
//require_once "login.php";
//if ($_SESSION['cliente_logado'] != null && time() > $_SESSION['cliente_logado']){
/*if (is_null($_SESSION['cliente_logado']) || time() > $_SESSION['cliente_logado']){
	unset($_SESSION['cliente_logado']);
	session_destroy();
	return 0;
	header("Location: index.php");
}*/
$descricao = $_POST['descricao'];
//echo $descricao;die;

$sql = "INSERT INTO u925420712_pedidos_grao.pedidos(descricao, status, ativo, dataCriacao, dataModificacao)
	VALUES ('$descricao', 1, 1, NOW(), NOW())";

if ($conn->query($sql) === TRUE) {
    //$conn->close();
	return 1;
} else {
    return 0;
}
header("Location: index.php");
