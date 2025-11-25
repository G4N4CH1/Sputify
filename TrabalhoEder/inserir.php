<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }


require 'conexao.php';

$titulo= filter_input(INPUT_POST,"titulo",FILTER_SANITIZE_SPECIAL_CHARS);
$genero= filter_input(INPUT_POST,"genero",FILTER_SANITIZE_SPECIAL_CHARS);
$poster= filter_input(INPUT_POST,"poster");
$ano= filter_input(INPUT_POST,"ano",FILTER_SANITIZE_NUMBER_INT);
$stream= filter_input(INPUT_POST,"stream",FILTER_SANITIZE_NUMBER_INT);

echo"<p><b>Título:</b>$titulo</p>";
echo"<p><b>Gênero:</b>$genero</p>";
echo"<p><b>Poster:</b>$poster</p>";
echo"<p><b>Ano:</b>$ano</p>";
echo"<p><b>Ano:</b>$stream</p>";

$sql = "INSERT INTO midias (titulo, genero, poster, ano, id_streaming) VALUES (?, ?, ?, ?,?)";

try {
    $stmt=$conn->prepare($sql);
    $result=$stmt->execute([$titulo, $genero,$poster,$ano,$stream]);
} catch (Exception $e) {
    $result=false;
    $error = $e->getMessage();
}

$_SESSION["result"]=$result;


if($result==true){
    $_SESSION["msg_sucesso"]="FOI";
}else{
    //não deu
    $_SESSION["msg_erro"]="NÃO FOI";
    $_SESSION["erro"]="$error";

}
redireciona("formulario.php");


?>