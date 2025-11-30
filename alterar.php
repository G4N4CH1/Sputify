<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }

require 'conexao.php';

$id= filter_input(INPUT_POST,"id",FILTER_SANITIZE_NUMBER_INT);
$titulo= filter_input(INPUT_POST,"titulo",FILTER_SANITIZE_SPECIAL_CHARS);
$genero= filter_input(INPUT_POST,"genero",FILTER_SANITIZE_SPECIAL_CHARS);
$poster= filter_input(INPUT_POST,"poster");
$ano= filter_input(INPUT_POST,"ano",FILTER_SANITIZE_NUMBER_INT);
$stream= filter_input(INPUT_POST,"stream",FILTER_SANITIZE_NUMBER_INT);

echo"<p><b>ID:</b>$id</p>";
echo"<p><b>Título:</b>$titulo</p>";
echo"<p><b>Gênero:</b>$genero</p>";
echo"<p><b>Poster:</b>$poster</p>";
echo"<p><b>Ano:</b>$ano</p>";
echo"<p><b>Ano:</b>$stream</p>";

if(!empty($stream)){
$sql = " UPDATE midias SET titulo=?, genero=?, poster=?, ano=?, id_streaming=? WHERE id=?";
}else{
    $sql = " UPDATE midias SET titulo=?, genero=?, poster=?, ano=? WHERE id=?";
}

try {
    $stmt=$conn->prepare($sql);
    if(!empty($stream)){
    $result=$stmt->execute([$titulo, $genero,$poster,$ano,$stream,$id]);
    }else{
   $result=$stmt->execute([$titulo, $genero,$poster,$ano,$id]);
    }
} catch (Exception $e) {
    $result=false;
    $error = $e->getMessage();
}

$count = $stmt->rowCount();
$_SESSION["result"]=$result;

if($result==true  && $count == 0){
        $_SESSION["result"]=false;
        $_SESSION["msg_erro"]="NÃO FOI";
        $_SESSION["erro"]="Nenhum Filme Foi Alterado";
}elseif($result== true){
       $_SESSION["msg_sucesso"]="FOI";
    
}else{
    //não deu
    $_SESSION["msg_erro"]="NÃO FOI";
    $_SESSION["erro"]="$error";

}
redireciona("listagem.php");
?>