<?php
session_start();
require "autenticacao.php";

if(!autenticado()){
    $_SESSION["restrito"]=true;
    redireciona();
    die();
}
$titulo_pagina= "Formulario de Cadastro de Músicas";
require 'cabecalho.php';
require 'conexao.php';

$sqlartista = "SELECT id_art, nome_art, genero_musica, qtd_membros, pais_origem FROM artista ORDER BY nome_art";
$stmtartista = $conn->query($sqlartista);


?>
  <form action="inserirMusica.php" method="post">
    <div class="row">
        <div class="col-7">
            <div class="mb-3">
              <label for="titulo" class="form-label">Título:</label>
              <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
              <label for="artista" class="form-label">Artista:</label>
               <select class="form-select" name="artista" id="artista">
                <option value="">Escolha uma Opção</option>
                 <?php
                while($rowartista=$stmtartista->fetch()){
                  ?>
                  
                  <option value="<?=$rowartista["id_art"]?>"><?=$rowartista["nome_art"]?></option>
                  
                  <?php
                }
                ?>
               </select>
            </div>
            <div class="mb-3">
              <label for="album" class="form-label">URL de uma foto do álbum dessa música:</label>
              <input type="url" class="form-control" id="album" name="album" aria-describedby="urlfotoHelp" required>
              <div id="urlfotoHelp" class="form-text">
                Endereço http de uma imagem da internet
              </div>
            </div>
            <div class="mb-3">
              <label for="duracao" class="form-label">Duração:</label>
              <input type="text" class="form-control" id="duracao" name="duracao"></input>
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