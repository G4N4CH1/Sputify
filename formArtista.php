<?php 
session_start();
require "autenticacao.php";

if(!autenticado()){
    $_SESSION["restrito"]=true;
    redireciona();
    die();
}

$titulo_pagina= "Formulario de Cadastro de Artistas";
require 'conexao.php';
require 'cabecalho.php';
$sqlstream = "SELECT id_art, nome_art, genero_musica, qtd_membros, pais_origem FROM artista ORDER BY nome_art";
$stmtstream = $conn->query($sqlstream);


?>
  <form action="inserirArtista.php" method="post">
    <div class="row">
        <div class="col-7">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome:</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
              <label for="genero" class="form-label">Gênero de música:</label>
              <input type="text" class="form-control" id="genero" name="genero" required>
            </div>
            <div class="mb-3">
              <label for="qtdmembros" class="form-label">Quantidade de Membros:</label>
               <input type="number" class="form-control" name="qtdmembros" id="qtdmembros">
            </div>
            <div class="mb-3">
              <label for="pais" class="form-label">País de Origem:</label>
              <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="text-center">
              <button type='submit' class="btn btn-success">Gravar</button>
              <button type='reset' class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
  </form>
<?php 
if (isset($_SESSION["result"])) {
  
  if ($_SESSION["result"]==true) {
    /*Deu CERTO */
   
    ?>
      <div class="row mt-3">
        <div class="col-8 offset-2">
          <div class="alert alert-success" role="alert">
            <h4><?=$_SESSION["msg_sucesso"]?></h4>
          </div>
          <div style="text-align: center;">
            <img src="https://img.freepik.com/vetores-premium/emoticon-feminino-com-o-polegar-para-cima_1303870-63.jpg?semt=ais_hybrid&w=740&q=80" alt="">
          </div>
        </div>
      </div>
    <?php
     unset( $_SESSION["msg_sucesso"]);
  }else {
    /*Deu erro na operação */

    ?>
      <div class="row mt-3">
        <div class="col-8 offset-2">
          <div class="alert alert-danger" role="alert">
            <h4><?=$_SESSION["msg_erro"]?></h4>
            <p><?=$_SESSION["erro"]?></p>
          </div>
          <div style="text-align: center;">
             <img src="https://www.shutterstock.com/image-illustration/3d-illustration-angry-emoticon-260nw-53719288.jpg" alt="">
          </div>
        </div>
      </div>
    <?php
     unset( $_SESSION["msg_erro"]);
     unset( $_SESSION["erro"]);
  }
  
  unset($_SESSION["result"]);
  # code...
}
 
require 'rodape.php';
?>