<!DOCTYPE html>
<html lang="pt-br">
   <head>
       
       <link href="css/bootstrap.min.css" rel="stylesheet">
       <style>
    
    <script>
document.getElementById("demo").innerHTML = "My First JavaScript";
</script>
  .hidden{ display: none;}
       </style>
   </head>
   <body style="padding:10px 15px;">
    <h2 style="border-bottom: solid 2px #000;">Pedidos</h2>

<?php require_once "conn.php"; 
  if(isset($_COOKIE["gnloja"])){
  die("1auhiauhiauhiau");
  //$loja_ok = 1;
  //echo $_COOKIE["gnloja"];
}
else{
  $loja_ok = 0;
  //setcookie("gnloja", "Benjamin");
} ;

//die;
?>

<table>
  <tr height="70">
    <?php if(isset($_COOKIE["gnloja"])){ ?>
    <td><label for="mySelect">Estou na loja: </label></td>
    <td><button>Trocar loja</button></td>
    <?php } else {?>
    <td>

      <select id="mySelect" onchange="myFunction()">
        <option value="null">Selecione a loja que você está
        <option value="Matriz: Benjamin Constant">Matriz: Benjamin Constant
        <option value="Filial: Felipe Camarão">Filial: Felipe Camarão
        <option value="Filial: Em Breve...">Filial: Em Breve...
      </select>
    </td>
  <?php }?></tr>
</table>
   <p id="idLoja"></p>

    <script>
      function myFunction() {
          var x = document.getElementById("mySelect").value;
          document.cookie = "gnstore=" + x;
          document.getElementById("idLoja").innerHTML = "You selected: " + x;
      }
    </script>

    <script>
      $( document ).ready(function() {
        var x = document.cookie;
        alert(x);
      });


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

   </body>
</html>
