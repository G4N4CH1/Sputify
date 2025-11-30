<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }
if(fun()){
    redireciona();
    die();
  }

require 'conexao.php';

$id= filter_input(INPUT_POST,"id",FILTER_SANITIZE_NUMBER_INT);
$favorito= filter_input(INPUT_POST,"favorito",FILTER_SANITIZE_NUMBER_INT);