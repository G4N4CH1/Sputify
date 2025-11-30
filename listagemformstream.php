?php 
session_start();
require "autenticacao.php";
$titulo_pagina="Streamings";
require 'cabecalho.php';
require 'conexao.php';

$exibir_busca=false;
$ordem="id";





if(!empty($_GET["ordem"])){ 
    $valid_orders = ["id", "id desc", "nome","nome desc"]; 
    $ordem = "titulo";  
    if (isset($_GET["ordem"]) && in_array($_GET["ordem"], $valid_orders)) { 
        $ordem = $_GET["ordem"]; 
    } 
}





$sqlstream = "SELECT id, nome, site_oficial FROM streamings ORDER BY $ordem";
$stmtstream = $conn->query($sqlstream);


?>
<div class="row mb-3">
    <form action="inserirstream.php" method="post">
    <div class="row">
        <div class="col-7">
            <div class="mb-3">
              <label for="titulo" class="form-label">Nome:</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
              <label for="poster" class="form-label">URL do Site:</label>
              <input type="url" class="form-control" id="site" name="site" aria-describedby="urlfotoHelp" required>
              <div id="urlfotoHelp" class="form-text">
                Endereço http do site
              </div>
            </div>
            </div>
            <div class="text-center">
              <button type='submit' class="btn btn-success">Gravar</button>
              <button type='reset' class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
  </form>
   
</div>
<?php
if($exibir_busca){
?>
<div class="alert alert-secondary">
    Resultados para: <b><?=$busca?></b>
    - <a href="listagemstream.php?ordem=<?=$ordem?>">limpar</a>
    
</div>
<?php    
}
if($stmtstream->rowCount()==0){
?>
    <div class="alert alert-warning mt3">
        Nenhum Resultado 
    </div>
<?php
}else{
    if (isset($_SESSION["result"])) {
  
        if ($_SESSION["result"]==true) {
    /*Deu CERTO */
   
    ?>
      <div class="row mt-3">
        <div class="col-8 offset-2">
          <div class="alert alert-success" role="alert">
            <h4><?=$_SESSION["msg_sucesso"]?></h4>
          </div>
          <div style="text-align: center; offset-2">
            <img src="https://img.freepik.com/vetores-premium/emoticon-feminino-com-o-polegar-para-cima_1303870-63.jpg?semt=ais_hybrid&w=740&q=80" alt="">
          </div>
        </div>
      </div>
    <?php
     unset( $_SESSION["msg_sucesso"]);
  }else {
    /*Deu erro na operação */

    ?>
      <div class="row mt-3">
        <div class="col-8 offset-2">
          <div class="alert alert-danger" role="alert">
            <h4><?=$_SESSION["msg_erro"]?></h4>
            <p><?=$_SESSION["erro"]?></p>
          </div>
          <div style="text-align: center; offset-2">
             <img src="https://www.shutterstock.com/image-illustration/3d-illustration-angry-emoticon-260nw-53719288.jpg" alt="">
          </div>
        </div>
      </div>
    <?php
     unset( $_SESSION["msg_erro"]);
     unset( $_SESSION["erro"]);
  }
  
  unset($_SESSION["result"]);
  # code...
}
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="widht: 5%;"><a href="?ordem=<?=($ordem =="id")?"id desc":"id";?>">ID
                    <?php if ($ordem == "id") echo"⬇️"; ?>
                    <?php if ($ordem =="id desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 30%;"><a href="?ordem=<?=($ordem =="nome")?"nome desc":"nome";?>">Nome
                    <?php if ($ordem == "titulo") echo"⬇️"; ?>
                    <?php if ($ordem =="titulo desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 5%;">Site Oficial</th>
                
                <?php
                if(autenticado()){?><th scope="col" style="widht: 25%;" colspan="2"></th><?php }?>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowstream=$stmtstream->fetch()){
            ?>
            <tr>
                <td><?=$rowstream["id"]?></td>
                <td><?=$rowstream["nome"]?></td>
                <td>
                    <a target="_blank" href="<?=$rowstream["site_oficial"]?>">Clique Aqui</a>
                </td>
                <?php if(autenticado()){  
                     ?><td>
                        <a href="formaltstream.php?id=<?=$rowstream["id"]?>" class="btm btn-sm btn-warning">
                            <span data-feather="edit"></span>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a href="excluirstream.php?id=<?=$rowstream["id"]?>" class="btm btn-sm btn-danger" onclick="if(!confirm('Certezas ?')) return false;">
                            <span data-feather="trash-2"></span>
                            Excluir
                        </a>
                    </td>
                <?php 
                }}
            ?>
        </tbody>
    </table>
</div> 
<?php 
}
require 'rodape.php';
?>