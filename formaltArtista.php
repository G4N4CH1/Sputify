<?php 
session_start();
require "autenticacao.php";
if(!autenticado()){
  redireciona();
  die();
}
$id= filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
if(empty($id)){
        $_SESSION["result"]=false;
        $_SESSION["msg_erro"]="NÃO FOI";
        $_SESSION["erro"]="Nenhum ID encontrado"; 
        redireciona("listagem.php");
    exit;
}

$titulo_pagina= "Formulario de Alteração de Artistas";
require 'cabecalho.php';



require 'conexao.php';

$sql = "SELECT nome_art, genero_musica, qtd_membros, pais_origem FROM artista WHERE id_art =?";
$stmt=$conn->prepare($sql);
$result=$stmt->execute([$id]);

$rowArtista = $stmt->fetch();



?>
  <form action="alterarArtista.php" method="post">
    <input type="hidden" name="id" id="id" value="<?=$id?>">
    <div class="row">
      <div class="col-8">
        <div class="row">
          <div class="col-8 mb-3">
              <label for="nome" class="form-label">Nome:</label>
              <input type="text" class="form-control" id="nome" name="nome" required value="<?=$rowArtista['nome_art']?>">
            </div>
        </div>
        <div class="row">
          <div class="col-8 mb-3">
              <label for="genero" class="form-label">Gênero de Música:</label>
              <input type="text" class="form-control" id="genero" name="genero" required value="<?=$rowArtista['genero_musica']?>">
            </div>
            <div class="col-4 mb-3">
              <label for="qtdmembros" class="form-label">Quantidade de Membros:</label>
              <input type="number" class="form-control" id="qtdmembros" name="qtdmembros" required value="<?=$rowArtista['qtd_membros']?>">
            </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
              <label for="pais" class="form-label">País de Origem:</label>
              <input type="text" class="form-control" id="pais" name="pais" required value="<?=$rowArtista['pais_origem']?>">
            </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-7">
            
            <div class="text-center">
              <button type='submit' class="btn btn-success">Gravar</button>
              <a href="listagemart.php" class="btn btn-warning">Cancelar</a>
            </div>
        </div>
        
    </div>
  </form>
<?php 
require 'rodape.php';
?>