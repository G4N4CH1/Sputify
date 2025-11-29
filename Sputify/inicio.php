<?php 
session_start();
require'autenticacao.php';
$titulo_pagina= "Inicio";
require 'cabecalho.php';
if(!autenticado()){?>
    <p class="display-4">Seja bem vindo. </p>
    <p>Faça o Login ou Cadastre-se</p>
<?php

}else{?>
   
    <p class="display-4">
        Olá, <strong>"<?=$_SESSION["nome"]?>"</strong>.<br>
    </p>
    <p> Tipo:<strong>"<?=$_SESSION["tipo"]?>"</strong></p>
    
<?php
}

if(isset($_SESSION['restrito']) && $_SESSION['restrito']){
    ?>
     <div class="alert alert-danger" role="alert">
        <h4>Você Não Está Logado</h4>
        <p>Usuário ou Senha errado</p>
    </div>
    

    <?php
    unset($_SESSION['restrito']);

}
require 'rodape.php';
?>