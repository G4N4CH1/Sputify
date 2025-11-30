<?php 

$id=filter_input(INPUT_GET, "id_mus", FILTER_SANITIZE_NUMBER_INT);

if(empty($id_mus)){
    
    $_SESSION["result"]= false;
    $_SESSION["msg_erro"]= "Falha ao abrir formulário para edição.";
    $_SESSION["erro"]="ID da música está vazia.";
    redireciona("listagemMusica.php");
        exit;
}
 
	$titulo_pagina= "Formulario de alteração de músicas";
require'cabecalho.php';






require 'conexao.php';

$sql = "SELECT titulo, album, duracao  FROM  musicas WHERE id_mus = ?";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id_mus]);

$rowMusica= $stmt->fetch();



?>
 <form action="alterarMusica.php" method="POST">
  <input type="hidden" name="id_mus" id="id_mus" value="<?= $id_mus ?>">
  <div class="row">
    <div class="col-8">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required
             value="<?= $rowMusica['titulo'] ?>"> 
      </div>
      <div class="mb-3">
        <label for="urlfoto" class="form-label">URL de uma foto do álbum dessa música:</label>
        <input type="url" class="form-control" id="urlfoto" name="urlfoto" 
               aria-describedby="urlfotoHelp" required
               value="<?= $rowMusica['album'] ?>">
        <div id="urlfotoHelp" class="form-text">
          Endereço http de uma imagem da internet
        </div>
      </div>
      <div class="mb-3">
        <label for="duracao" class="form-label">Duração:</label>
        <textarea class="form-control" id="duracao" name="duracao"><?= $rowMusica['duracao']?></textarea>
      </div>
 
      <div class="text-center">
        <button type="submit" class="btn btn-success">Gravar</button>
          <a href="listagem.php" class="btn btn-warning">Cancelar </a>
      </div>
      <div class="col=3">
        <img src="<?= $rowMusica['album'] ?>" alt="<?= $rowMusica['album'] ?>" class="img-thumbnail" id="image-preview">
      </div>
    </div>
  </div>
</form>
<?php 
require'rodape.php';
?>