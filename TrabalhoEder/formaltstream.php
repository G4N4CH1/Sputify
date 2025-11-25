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

$titulo_pagina= "Formulario de Alteração de Streamings";
require 'cabecalho.php';



require 'conexao.php';

$sql = "SELECT nome, site_oficial FROM streamings WHERE id =?";
$stmt=$conn->prepare($sql);
$result=$stmt->execute([$id]);

$rowFilme = $stmt->fetch();


?>
  <form action="alterarstream.php" method="post">
    <input type="hidden" name="id" id="id" value="<?=$id?>">
    <div class="row">
        <div class="col-7">
            <div class="mb-3">
              <label for="nome" class="form-label">Título:</label>
              <input type="text" class="form-control" id="nome" name="nome" required value="<?=$rowFilme['nome']?>">
            </div>
            <div class="mb-3">
              <label for="site" class="form-label">URL do Site:</label>
              <input type="url" class="form-control" id="site" name="site" aria-describedby="urlfotoHelp" required value="<?=$rowFilme['site_oficial']?>">
              <div id="urlfotoHelp" class="form-text">
                Endereço http do site
              </div>
            </div>
            <div class="text-center">
              <button type='submit' class="btn btn-success">Gravar</button>
              <a href="listagemformstream.php" class="btn btn-warning">Cancelar</a>
            </div>
        </div>
        
    </div>
  </form>
<?php 
require 'rodape.php';
?>