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

$titulo_pagina= "Formulario de Alteração de Filmes";
require 'cabecalho.php';



require 'conexao.php';

$sql = "SELECT titulo, ano, genero, poster, id_streaming FROM midias WHERE id =?";
$stmt=$conn->prepare($sql);
$result=$stmt->execute([$id]);

$rowFilme = $stmt->fetch();

$sqlstream = "SELECT id, nome, site_oficial FROM streamings ORDER BY nome";
$stmtstream = $conn->query($sqlstream);


?>
  <form action="alterar.php" method="post">
    <input type="hidden" name="id" id="id" value="<?=$id?>">
    <div class="row">
      <div class="col-8">
        <div class="row">
          <div class="col-8 mb-3">
              <label for="titulo" class="form-label">Título:</label>
              <input type="text" class="form-control" id="titulo" name="titulo" required value="<?=$rowFilme['titulo']?>">
            </div>
            <div class="col-4 mb-3">
              <label for="stream" class="form-label">Streaming:</label>
              <select class="form-select" name="stream" id="stream">
                <option value="">Escolha uma Opção</option>
                 <?php
                while($rowstream=$stmtstream->fetch()){
                  ?>
                  
                  <option value="<?=$rowstream["id"]?>"<?=($rowFilme['id_streaming']==$rowstream['id']) ? "selected": "" ?>><?=$rowstream['nome']?></option>
                  
                  <?php
                }
                ?>
               </select>
            </div>
        </div>
        <div class="row">
          <div class="col-8 mb-3">
              <label for="genero" class="form-label">Gênero:</label>
              <input type="text" class="form-control" id="genero" name="genero" required value="<?=$rowFilme['genero']?>">
            </div>
            <div class="col-4 mb-3">
              <label for="ano" class="form-label">Ano:</label>
              <input type="number" class="form-control" id="ano" name="ano" required min="1888" max="2100" value="<?=$rowFilme['ano']?>">
            </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
              <label for="poster" class="form-label">URL da foto do Poster:</label>
              <input type="url" class="form-control" id="poster" name="poster" aria-describedby="urlfotoHelp" required value="<?=$rowFilme['poster']?>">
              <div id="urlfotoHelp" class="form-text">
                Endereço http de uma imagem da internet
              </div>
            </div>
        </div>
      </div>
      <div class="col-4">
            <img src="<?=$rowFilme['poster']?>" alt="<?=$rowFilme['titulo']?>" class="img-thumbnail" id="img-preview">
      </div>
    </div>
    <div class="row">
        <div class="col-7">
            
            <div class="text-center">
              <button type='submit' class="btn btn-success">Gravar</button>
              <a href="listagem.php" class="btn btn-warning">Cancelar</a>
            </div>
        </div>
        
    </div>
  </form>
<?php 
require 'rodape.php';
?>