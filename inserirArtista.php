<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }


require 'conexao.php';
  
$nome= filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$genero= filter_input(INPUT_POST,"genero",FILTER_SANITIZE_SPECIAL_CHARS);
$qtdmembros= filter_input(INPUT_POST,"qtdmembros");
$pais= filter_input(INPUT_POST,"pais",FILTER_SANITIZE_SPECIAL_CHARS);

echo"<p><b>Nome:</b>$nome</p>";
echo"<p><b>Gênero:</b>$genero</p>";
echo"<p><b>Quantidade de Membros:</b>$qtdmembros</p>";
echo"<p><b>País de Origem:</b>$pais</p>";

$sql = "INSERT INTO artista (nome_art, genero_musica, qtd_membros, pais_origem) VALUES (?, ?, ?, ?)";

try {
    $stmt=$conn->prepare($sql);
    $result=$stmt->execute([$nome, $genero,$qtdmembros,$pais]);
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
redireciona("formArtista.php");


?>