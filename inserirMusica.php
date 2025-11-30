<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }


require 'conexao.php';

$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_SPECIAL_CHARS);
$album = filter_input(INPUT_POST, "album");
$duracao = filter_input(INPUT_POST, "duracao", FILTER_SANITIZE_SPECIAL_CHARS);

    
echo "<p><b>titulo: </b>$titulo</p> ";
echo "<p><b>album: </b>$album</p> ";
echo "<p><b>duracao: </b>$duracao</p> ";


$sql = "INSERT INTO musica (titulo,artista, album, duracao) VALUES (?, ?, ?)";

try{ 
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$titulo,$artista,$album,$duracao]);
}catch (\Exception $e){
    $result= false;
    $error= $e->getMessage();
}

$_SESSION["result"]=$result;



if($result == true){
 	$_SESSION["msg_sucesso"]="Dados gravados com sucesso!";

} else{
    $_SESSION["msg_erro"]= "Falha ao efetuar gravação.";
    $_SESSION["erro"]=$error;
    
}
redireciona("formMusica.php")
?>