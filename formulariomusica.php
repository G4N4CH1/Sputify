  <?php
  
  $titulo_pagina= "Formulario de Cadastro de Músicas";
	require'cabecalho.php';


?>
  <form action="inserir-musica.php" method="post">
    <div class="row">
        <div class="col-7">
            <div class="mb-3">
              <label for="titulo" class="form-label">Título:</label>
              <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
              <label for="album" class="form-label">URL de uma foto do álbum dessa música:</label>
              <input type="url" class="form-control" id="album" name="album" aria-describedby="urlfotoHelp" required>
              <div id="urlfotoHelp" class="form-text">
                Endereço http de uma imagem da internet
              </div>
            </div>
            <div class="mb-3">
              <label for="genero" class="form-label">Duração:</label>
              <textarea class="form-control" id="duracao" name="duracao"></textarea>
            </div>

            <div class="text-center">
              <button type='submit' class="btn btn-success">Gravar</button>
              <button type='reset' class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
  </form>
<?php 

if (isset($_SESSION["result"])) {
    
    if($_SESSION["result"]==true) {
        /**deu certo*/
        ?>         
			<div class="row mt-3">
        <div class="col-8">
            <div class="alert alert-success " role="alert">
                <h4><?= $_SESSION["msg_sucesso"] ?></h4>             
            </div>
     	</div>
  </div>
<?php
 
        unset($_SESSION["msg_sucesso"]);
              
    }else{
        /**deu erro na operacao*/
        
        ?>
			<div class="row mt-3">
        <div class="col-8">
            <div class="alert alert-danger " role="alert">
                <h4><?=$_SESSION["msg_erro"]?></h4>
                <p><?=$_SESSION["erro"]?></p>
            </div>
     	</div>
  </div>
<?php        
    
    unset ($_SESSION["msg_erro"]);   
    unset ($_SESSION["erro"]);

}

      unset ($_SESSION["result"]);
}
  


require'rodape.php';
?>