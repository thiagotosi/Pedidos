<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
	unset($_SESSION['cliente_logado']);
	session_destroy();

	header("Location: index.php");

?>