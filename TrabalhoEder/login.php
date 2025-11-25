<?php 
session_start();
require "autenticacao.php";
if(autenticado()){
    redireciona();
    die();
  }

require 'conexao.php';


$email= filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
$senha= filter_input(INPUT_POST,"senha",FILTER_SANITIZE_SPECIAL_CHARS);

$sql= "SELECT id, nome, senha FROM funcionario where email =?";
try {
    $stmt=$conn->prepare($sql);
    $stmt->execute([$email]);
} catch (Exception $e) {
    $result=false;
    $error = $e->getMessage();
}

$row = $stmt->fetch();

if(password_verify($senha, $row['senha'])){
    //foi
    $_SESSION["id_usu"]=$row["id"];
    $_SESSION["email"] = $email;
    $_SESSION["nome"] = $row['nome'];
    redireciona();
}else{
    //N foi 
    unset($_SESSION["id_usu"]);
    unset($_SESSION["email"]);
    unset($_SESSION["nome"]);
    $_SESSION["msg_erro"]="NÃO FOI";
    $_SESSION["erro"]="Usuário ou Senha errado<br>.$erro";
    redireciona("formlogin.php");

}



?>