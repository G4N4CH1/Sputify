<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
  }

require 'conexao.php';

$id= filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);


echo"<p><b>ID:</b>$id</p>";

if(id_usu()!=$id){
    $_SESSION["result"] = false;
    $_SESSION["erro"]="Você está tentando excluir o excluir um usuário que não é o seu.";
    $_SESSION["msg_erro"] = "Operação não permitida";
    redireciona("listagemusu.php");
    die();
}

$sql = "DELETE FROM funcionario WHERE id =?";
try {
    
    $stmt=$conn->prepare($sql);
    $result=$stmt->execute([$id]);
} catch (Exception $e) {
    $result=false;
    $error = $e->getMessage();
}

$count = $stmt->rowCount();
$_SESSION["result"]=$result;

if($result==true  && $count == 0){
        $_SESSION["result"]=false;
        $_SESSION["msg_erro"]="NÃO FOI";
        $_SESSION["erro"]="N Achou o ID";
}elseif($result== true){
      redireciona("sair.php");
      exit;
    
}else{
    //não deu
    $_SESSION["msg_erro"]="NÃO FOI";
    $_SESSION["erro"]="$error";

}
redireciona("listagemusu.php");

?>