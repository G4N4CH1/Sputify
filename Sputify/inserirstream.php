<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }


require 'conexao.php';

$nome= filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$site= filter_input(INPUT_POST,"site",FILTER_SANITIZE_SPECIAL_CHARS);

echo"<p><b>Título:</b>$nome</p>";
echo"<p><b>Gênero:</b>$sote</p>";

$sql = "INSERT INTO streamings (nome, site_oficial) VALUES (?, ?)";

try {
    $stmt=$conn->prepare($sql);
    $result=$stmt->execute([$nome, $site]);
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
redireciona("listagemformstream.php");


?>