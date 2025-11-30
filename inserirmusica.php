<?php 
   

require 'conexao.php';
$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_SPECIAL_CHARS);
$album = filter_input(INPUT_POST, "album", FILTER_SANITIZE_URL);
$duracao = filter_input(INPUT_POST, "duracao", FILTER_SANITIZE_SPECIAL_CHARS);


if($confi["debug"]== "true"){
    
echo "<p><b>titulo: </b>$titulo</p> ";
echo "<p><b>album: </b>$album</p> ";
echo "<p><b>duracao: </b>$duracao</p> ";

}

$sql = "INSERT INTO `musicas`(`titulo`, `album`, `duracao`) VALUES (?, ?, ?)";

try{ 
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$titulo,$album,$duracao]);
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
redireciona("formulariomusica.php")
?>