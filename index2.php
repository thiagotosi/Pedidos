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

    <?php
    if(isset($_COOKIE["gnloja"])){
      $loja_ok = 1;
      echo $_COOKIE["gnloja"];
    }
    else{
      $loja_ok = 0;
      //setcookie("gnloja", "Benjamin");
    } ;

    //die;
    ?>


    <h2 style="border-bottom: solid 2px #000;">Pedidos</h2>

<?php
  require_once "conn.php";
?>



<form action="" method="post">
  <table>
    <tr height="70">
      <td><label for="campo_loja">Selecione a Loja: </label></td>
      <td>
        <select name="campo_loja" id="campo_loja" class="campo_loja"  >
          <option value="benjamin">Benjamin</option>
          <option value="felipe camarao">Felipe Camarão</option>
        </select>
      </td>
    </tr>

    <?php
    $montaLista = [];
    $sql = "SELECT * FROM pedidos WHERE pedidos.descricao LIKE '%Nutrata%' ORDER BY pedidos.dataModificacao";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          //print_r($row[dataModificacao]);die;
          $montaLista[date_format(date_create($row[dataModificacao]), 'd/m/Y')][] = $row;
              
          echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$row["id"]."'></span> " .$row["descricao"] . "<br />";
        }
    } 
print_r($result->num_rows);

    ?>



    <tr height="70">
      <td><label for="campo_descricao">Produto: </label></td>
      <td><input style="height:50px; width:150px;" type="text" name="campo_descricao" id="campo_descricao" class="campo_descrição"  placeholder="Descrição"></td>
      <td>
        <button type="submit" class="btn cadastraBtn" data-toggle="modal" data-target="#exampleModal">Cadastrar</button>
      </td>
    </tr>
  </table>
</form>


<br><br>

<p>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    ÚLTIMOS PRODUTOS REMOVIDOS
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <div class="alert alert-danger" role="alert" style="width: 30%;">
<?php

  $montaListaRemovidos = [];
  $sql = "SELECT * FROM pedidos WHERE pedidos.ativo=0 ORDER BY pedidos.dataModificacao DESC LIMIT 20";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        //print_r($row[dataModificacao]);die;
        $montaListaRemovidos[date_format(date_create($row[dataModificacao]), 'd/m/Y')][] = $row;
            
        //echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$row["id"]."'></span> " .$row["descricao"] . "<br />";
      }
  } else {
    echo "SEM PEDIDOS NO MOMENTO!!";
  }
  foreach ($montaListaRemovidos as $key => $value) {
    echo "REMOVIDO EM <strong>" . $key . "</strong><br>";
    foreach ($value as $key1 => $value1) {
        echo $value1["descricao"] . "<br />";
        
    }
  }
  ?>
   </div>
   </div>
</div>
<?php


  $montaLista = [];
  $sql = "SELECT * FROM pedidos WHERE pedidos.ativo=1 ORDER BY pedidos.dataModificacao";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        //print_r($row[dataModificacao]);die;
        $montaLista[date_format(date_create($row[dataModificacao]), 'd/m/Y')][] = $row;
            
        //echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$row["id"]."'></span> " .$row["descricao"] . "<br />";
      }
  } else {
    echo "SEM PEDIDOS NO MOMENTO!!";
  }
  foreach ($montaLista as $key => $value) {
    echo "<strong>" . $key . "</strong><br>";
    foreach ($value as $key1 => $value1) {
        echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$value1["id"]."'></span> " .$value1["descricao"] . "<br />";
        
    }
  }
  
  $conn->close();
  unset( $_POST );

?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    <script>
      $( document ).ready(function() {
        var x = document.cookie;
        alert( x);
      });

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
      
    </script>
   </body>
</html>
