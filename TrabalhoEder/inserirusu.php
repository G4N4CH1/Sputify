<?php 
session_start();
require "autenticacao.php";


require 'conexao.php';

$nome= filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$email= filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
$senha= filter_input(INPUT_POST,"senha");

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);


echo"<p><b>Nome:</b>$nome</p>";
echo"<p><b>Email:</b>$email</p>";




$sql = "INSERT INTO funcionario ( nome, email, senha) VALUES ( ?, ?, ?)";
try {
    $stmt=$conn->prepare($sql);
    $result=$stmt->execute([$nome, $email, $senha_hash]);
} catch (Exception $e) {
    $result=false;
    $error = $e->getMessage();
}
$_SESSION["result"]=$result;
if($result==true){
    $_SESSION["msg_sucesso"]="FOI";
}else{
    /**SQLSTATE[23505]: Unique violation: 7 ERRO: duplicar valor da chave 
     * viola a restrição de unicidade "funcionario_email_key" */
    //não deu
    if(stripos($error,'duplicar valor')!=false){
        $error="O e-mail<b>\'$email'\</b> já esta registrado";
    }
    $_SESSION["msg_erro"]="NÃO FOI";
    $_SESSION["erro"]="$error";

}
redireciona("formusu.php");

?>