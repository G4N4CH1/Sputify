<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }


require 'conexao.php';

$id= filter_input(INPUT_POST,"id",FILTER_SANITIZE_NUMBER_INT);
$nome= filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$site= filter_input(INPUT_POST,"site",FILTER_SANITIZE_SPECIAL_CHARS);


echo"<p><b>ID:</b>$id</p>";
echo"<p><b>Título:</b>$nome</p>";


$sql = " UPDATE streamings SET nome=?, site_oficial=? WHERE id=?";
try {
    
    $stmt=$conn->prepare($sql);
    $result=$stmt->execute([$nome, $site,$id]);
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
redireciona("listagemformstream.php");
?>