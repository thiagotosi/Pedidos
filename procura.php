<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
       <title>Pedidos </title>
       <link href="css/bootstrap.min.css" rel="stylesheet">
       <style>
    
    
  .hidden{ display: none;}
       </style>
   </head>
   <body style="padding:10px 15px;">
    <div>Você está na Grão Natural loja MATRIZ </div>
    <h2 style="border-bottom: solid 2px #000;">Pedidos</h2>

<?php
  require_once "conn.php";
?>
<div><a href="/pedidos">Cadastra Pedido </a>| Busca Removidos | </div>
<form name="form" action="" method="post">
  <table>
    <tr height="70">
      <td><label for="buscaField">Produto: </label></td>
      <td><input style="height:50px; width:150px;" type="text" name="buscaField" id="buscaField" class="buscaField"  placeholder="Busca"></td>
      <td><button type="submit" class="btn buscaBtn">Buscar</button></td>
    </tr>
  </table>
</form>

<br><br>

<?php

  $busca = $_POST["buscaField"];

  $montaListaRemovidos = [];
  $sql = "SELECT * FROM pedidos WHERE status = 1 AND descricao LIKE '%".$busca."%' ORDER BY pedidos.dataModificacao DESC LIMIT 20";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        //print_r($row[dataModificacao]);die;
        $listaSQL[date_format(date_create($row["dataModificacao"]), 'd/m/Y')][] = $row;
            
        //echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$row["id"]."'></span> " .$row["descricao"] . "<br />";
      }
  } else {
    echo "SEM PEDIDOS NO MOMENTO!!";
  }
  foreach ($listaSQL as $key => $value) {
    echo "REMOVIDO EM <strong>" . $key . "</strong> - Cadastrado em ".$value1["dataCriacao"]."<br>";
    foreach ($value as $key1 => $value1) {
        echo $value1["descricao"] . "<br />";
        
    }
  }
  ?>
<?php

  
  $conn->close();

?>
    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    <script>
      $(".removeBtn").click(function(){
        $.post( "remove.php", {id: $(this).attr('name')})
          .done(function() {
            location.reload();
          })
          /*.fail(function() {
            alert( "error" );
          })*/
      });
      $(".cadastraBtn").click(function(){
        $.post( "cadastra.php", {descricao: $(".campo_descrição").val()}, function(data,status){})
        });
      
      document.form.buscaField.focus();
    </script>
   </body>
</html>
