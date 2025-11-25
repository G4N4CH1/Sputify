<?php 
session_start();
require'autenticacao.php';
$titulo_pagina= "Inicio";
require 'cabecalho.php';
?>
    <p class="display-4">
        Seja bem vindo a <strong>"GANACHIFLIX"</strong>.<br>
        Está é a Página Principal
        <div style="text-align: center;">
            <img src="https://img.myloview.com.br/posters/bem-vindo-emoji-isolado-no-fundo-branco-saudacao-emoticon-renderizacao-3d-400-109756541.jpg" alt="">
            

        </div>
    
    
    
<?php 
if(isset($_SESSION['restrito']) && $_SESSION['restrito']){
    ?>
     <div class="alert alert-danger" role="alert">
        <h4>Você Não Está Logado</h4>
        <p>Usuário ou Senha errado</p>
    </div>
     <div style="text-align: center;">
      <img src="https://www.shutterstock.com/image-illustration/3d-illustration-angry-emoticon-260nw-53719288.jpg" alt="">
    </div>

    <?php
    unset($_SESSION['restrito']);

}
require 'rodape.php';
?>