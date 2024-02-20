<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <title>Pedidos</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <style> 
        .hidden{ display: none;}
      </style>
    </head>
    <body style="padding:10px 15px;">
      <?php
      require_once "conn.php";
      //require_once "login.php";
      ?>
      <div><a href="logout.php">Sair</a></div>
      <h2 style="border-bottom: solid 2px #000;">Pedidos</h2>
      <div>Cadastra Pedido | <a href="procura.php">.</a> </div>
      <?php 
      //VERIFICA SE O USUARIO ESTÁ LOGADO NO SISTEMA
      //if($_SESSION['cliente_logado'] != null){
      if(1){  ?>
        <form name="formCadastraProd" >
          <table>
            <tr>
              <td><label for="campo_descricao">Produto: </label></td>
            </tr>
            <tr height="70">
              <td><input style="height:50px; width:150px;" type="text" name="campo_descricao" id="campo_descricao" class="campo_descricão"  placeholder="Descrição"></td>
              <td>&nbsp</td>
              <td><button style="height:50px; width:150px;" class="btn btn-secondary cadastraBtn">Cadastrar</button></td>
            </tr>
            <tr>
              <td><label for="">Tipo de Produto: </label>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTipo" aria-expanded="false" aria-controls="collapseTipo">
                  Mais
  </button></td>
            </tr>
            <tr class="collapse" id="collapseTipo">
              <td><input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked disabled>
                <label class="form-check-label" for="exampleRadios1">
                  Para Venda
                </label>
              </td>
              <td><input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" disabled>
                <label class="form-check-label" for="exampleRadios1">
                  Limpeza
                </label>
              </td>
            </tr>
          </table>
        </form>
      <?php } else { ?>

      <form name="formLogin" action="" method="post">
        <table>
          <tr>
            Para cadastrar ou remover produtos faça LOGIN no sistema!
          </tr>
          <tr height="70">
            <td><input style="height:50px; width:150px;" type="text" name="usuario_login" id="usuario_login" class="usuario_login" placeholder="USUÁRIO" autocomplete="off"></td>
            <td>&nbsp</td>
            <td><input style="height:50px; width:150px;" type="password" name="senha_login" id="senha_login" class="senha_login" placeholder="SENHA"></td>
            <td>&nbsp</td>
            <td><button style="height:50px; width:150px;" type="submit" class="btn btn-danger loginBtn">Login</button></td>
          </tr>
        </table>
      </form>
        <?php } ?>
      <br><br>

      <p>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ÚLTIMOS PRODUTOS REMOVIDOS</button>
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
                $montaListaRemovidos[date_format(date_create($row['dataModificacao']), 'd/m/Y')][] = $row;
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
        //print_r($row['dataModificacao']);die;
        $montaLista[date_format(date_create($row['dataModificacao']), 'd/m/Y')][] = $row;
            
        //echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$row["id"]."'></span> " .$row["descricao"] . "<br />";
      }
  } else {
    echo "SEM PEDIDOS NO MOMENTO!!";
  }
  foreach ($montaLista as $key => $value) {
    echo "<strong>" . $key . "</strong><br>";
    foreach ($value as $key1 => $value1) {
      echo "<div id='prod".$value1["id"]."'>";
      //if($_SESSION['cliente_logado'] != null){ 
      if(1){
      echo  "<span class='removeBtn glyphicon glyphicon-remove-sign' aria-hidden='true' name='" .$value1["id"]."'></span> " .$value1["descricao"] . "<br />";
      } else {
        echo  $value1["descricao"] . "<br />";
      }
      echo "</div>";
    } 
  }
  
  $conn->close();

?>
    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    <script>
      $(".removeBtn").click(function(){
        nome = $(this).parent().attr('id');
        $.post( "remove.php", {id: $(this).attr('name')}, function(
          data,status){
         })
          .done(function() {
           $('#' + nome).remove();
          })
          /*.fail(function() {
            alert( "error" );
          })*/
      });
      $(".cadastraBtn").click(function(){
        $.post( "cadastra.php", {descricao: $(".campo_descricão").val()}, function(data,status){
    //alert(data);
        })
          .done(function() {
            location.reload();
          })
        });

      if ($("#usuario_login").length) {
        
        document.formLogin.usuario_login.focus();
      }
      if ($("#campo_descricao").length) {
        document.formCadastraProd.campo_descricao.focus();
      }
    </script>
    <div id="rodape"></div>
   </body>
</html>
