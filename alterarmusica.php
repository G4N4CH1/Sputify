 <?php 

require 'conexao.php';


$id_mus = filter_input(INPUT_POST, "id_mus", FILTER_SANITIZE_NUMBER_INT);
$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_SPECIAL_CHARS);
$album = filter_input(INPUT_POST, "urlfoto", FILTER_SANITIZE_URL);
$duracao = filter_input(INPUT_POST, "duracao", FILTER_SANITIZE_SPECIAL_CHARS);




echo "<p><b>ID : </b>$id_mus</p> ";
echo "<p><b>titulo: </b>$titulo</p> ";
echo "<p><b>album: </b>$album</p> ";
echo "<p><b>duracao: </b>$duracao</p> ";


$sql ="UPDATE musicas SET titulo=?, duracao=? ,album=? WHERE id_mus=?"  ; 
try{ 
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$titulo,$duracao,$album,$id_mus]);
}catch (\Exception $e){
    $result= false;
    $error= $e->getMessage();
}

$count=$stmt->rowCount();
$_SESSION["result"]=$result;

if($result == true && $count==0 ){
    $_SESSION["result"]= false;
    $_SESSION["msg_erro"]= "Nenhum dado foi alterado.";
    $_SESSION["erro"]="Nenhuma alteração foi registrada.";

}elseif($result == true){
 	$_SESSION["msg_sucesso"]="Dados alterados com sucesso!";

} else{
    $_SESSION["msg_erro"]= "Falha ao efetuar alterção.";
    $_SESSION["erro"]=$error;
    
}
redireciona("listagemmusica.php");
?>





    




