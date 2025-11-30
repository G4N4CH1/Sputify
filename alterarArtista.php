<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
    redireciona();
    die();
}

require 'conexao.php';

$id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_SPECIAL_CHARS);
$genero = filter_input(INPUT_POST,"genero",FILTER_SANITIZE_SPECIAL_CHARS);
$qtdmembros = filter_input(INPUT_POST,"qtdmembros", FILTER_SANITIZE_NUMBER_INT);
$pais = filter_input(INPUT_POST,"pais",FILTER_SANITIZE_SPECIAL_CHARS);

echo "<p><b>ID:</b>$id</p>";
echo "<p><b>Nome:</b>$nome</p>";
echo "<p><b>Gênero:</b>$genero</p>";
echo "<p><b>Quantidade de Membros:</b>$qtdmembros</p>";
echo "<p><b>País de Origem:</b>$pais</p>";

// Correção: não atualizar id_art e usar WHERE id_art
$sql = "UPDATE artista SET nome_art=?, genero_musica=?, qtd_membros=?, pais_origem=? WHERE id_art=?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $genero, $qtdmembros, $pais, $id]);
    $count = $stmt->rowCount();
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$_SESSION["result"] = $result;

if($result == true && $count == 0){
    $_SESSION["result"] = false;
    $_SESSION["msg_erro"] = "NÃO FOI";
    $_SESSION["erro"] = "Nenhum Artista Foi Alterado";
} elseif($result == true){
    $_SESSION["msg_sucesso"] = "FOI";
} else {
    $_SESSION["msg_erro"] = "NÃO FOI";
    $_SESSION["erro"] = $error ?? "Erro desconhecido";
}

redireciona("listagemart.php");
?>
