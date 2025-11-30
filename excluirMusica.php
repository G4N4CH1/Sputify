<?php 


    
require 'conexao.php';

$id_mus = filter_input(INPUT_GET, "id_mus", FILTER_SANITIZE_NUMBER_INT);

echo "<p><b>ID: </b>$id_mus</p> ";



$sql = "DELETE FROM  musicas WHERE id_mus = ?";

try{ 
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id_mus]);
    
}catch (Exception $e){
    $result= false;
    $error= $e->getMessage();
}

$count=$stmt->rowCount();
$_SESSION["result"]= $result;



if($result == true & $count==0){
 	    $_SESSION["result"]=false;
    $_SESSION["msg_erro"]= "Falha ao efetuar exclusão.";
    $_SESSION["erro"]="Não foi encontrado nenhum registro com o ID ($id_mus).";

}elseif($result == true){
	$_SESSION["msg_sucesso"] = "Dados excluídos com sucesso!";
    
} else{
    $_SESSION["msg_erro"]= "Falha ao efetuar exclusão.";
    $_SESSION["erro"]=$error;
    
}
redireciona("listagemmusica.php");

?>