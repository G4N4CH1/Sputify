<?php 
session_start();
require'autenticacao.php';
$titulo_pagina= "Início";
require 'cabecalho.php';
if(!autenticado()){?>
    <div class="text-center"><p class="display-6">Seja bem vindo. </p>
        <p>Faça o Login ou Cadastre-se</p>
    </div>
<?php

}else{?>
   
    <p class="display-4 text-center">
        Olá, <strong>"<?=$_SESSION["nome"]?>"</strong>.<br>
    </p>
    <p class="text-center"> Tipo de Usuário:<strong>"<?=$_SESSION["tipo"]?>"</strong></p>
    
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