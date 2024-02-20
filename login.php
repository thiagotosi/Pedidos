<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
	$_SESSION["newsession"]='lalal';
	print_r($_SESSION);
	die('aqui');
}
$time_session = 120;
//echo time() . "<br>";
//echo $_SESSION['cliente_logado'];
// ????
if ($_SESSION['cliente_logado'] != null && time() > $_SESSION['cliente_logado']){
	unset($_SESSION['cliente_logado']);
	session_destroy();
}
elseif ($_SESSION['cliente_logado'] != null) {
	$_SESSION['cliente_logado'] = strtotime("+ 120 seconds");
}elseif( isset($_POST["usuario_login"]) && isset($_POST["senha_login"])){
	$_SESSION['nome_usuario'] = $_POST["usuario_login"];
	$_SESSION['nome_pass'] = $_POST["senha_login"];
	$tempoatual = time();
	$_SESSION['cliente_logado'] = strtotime("+ 120 seconds");
	header("Location: index.php");
} else {
	unset($_SESSION['cliente_logado']);
	session_destroy();
}

/**if (!isset($_SESSION['cliente_logado'])){ ?>
	<form name="login" action="" method="post">
	  <table>
	    <tr height="70">
	      <td><input style="height:50px; width:150px;" type="text" name="usuario_login" id="usuario_login" class="usuario_login"  placeholder="LOGIN"></td>
	      <td><input style="height:50px; width:150px;" type="text" name="senha_login" id="senha_login" class="senha_login"  placeholder="SENHA"></td>
	      <td><button type="submit" class="btn loginBtn">Login</button></td>
	    </tr>
	  </table>
	</form>

<?php */
//	die('CLIENTE DESLOGADO');
 //} 

//die('CLIENTE LOGADO');
?>



