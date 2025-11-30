<?php 
session_start();
require "autenticacao.php";
if(autenticado()){
  redireciona();
  die();
}

$titulo_pagina= "Formulario de Login";
require 'cabecalho.php';
?>
  <div class="row">
    <div class="col-4 offset-4">
      <form action="login.php" method="post">
        <br><br>
        <h1 class="h3 mb-3 fw-normal">Identifique-se</h1> 
        <div class="form-floating mb-3"> 
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required> 
          <label for="floatingInput">Email </label> 
        </div> 
        <div class="form-floating mb-3"> 
          <input type="password" name= "senha" class="form-control" id="floatingPassword" placeholder="Senha" required> 
          <label for="floatingPassword">Senha</label> 
        </div>

      <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button> 
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-8 offset-4">
      <?php
      if (isset($_SESSION["msg_erro"])) {
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
       
        unset($_SESSION["msg_erro"]);
        # code...
      }
      ?>
    </div>
  </div>
<?php
require 'rodape.php';
?>