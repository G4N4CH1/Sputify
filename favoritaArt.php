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

$id= filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
$favorito= filter_input(INPUT_GET,"favorito",FILTER_SANITIZE_NUMBER_INT);
$pagina="listagemart.php";
if(isset($_GET["pagina"])){
  $pagina=filter_input(INPUT_GET,"pagina",FILTER_SANITIZE_SPECIAL_CHARS);
}

if(empty($favorito)){
    $sql="INSERT into artistafav (id_art,id_usu) values(?,?)";
}else{
  $sql="DELETE from artistafav where id_af=?";
}
try {
   $stmt=$conn->prepare($sql);
    if(empty($favorito)){
      $result=$stmt->execute([$id,id_usu()]);
    }else{
       $result=$stmt->execute([$favorito]);
    }
} catch (Exception $e) {
    $result=false;
    $error = $e->getMessage();
}
redireciona("$pagina");