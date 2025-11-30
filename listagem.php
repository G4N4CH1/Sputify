<?php 
session_start();
require "autenticacao.php";
$titulo_pagina="Listagem de Filmes";
require 'cabecalho.php';
require 'conexao.php';

$exibir_busca=false;
$sql_busca="";
$busca="";
$tipo_busca="";
$ordem="titulo";
$Anomin = filter_input(INPUT_POST, 'Anomin', FILTER_SANITIZE_NUMBER_INT);
$Anomax = filter_input(INPUT_POST, 'Anomax', FILTER_SANITIZE_NUMBER_INT);


if(!empty($_POST["busca"])){
   
    $busca = filter_input(INPUT_POST,"busca",FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_busca=filter_input(INPUT_POST,"tipo_busca",FILTER_SANITIZE_SPECIAL_CHARS);
    $exibir_busca=true;
    switch ($tipo_busca) {
        case 'id':
            $idbusca= intval($busca);
            $sql_busca=" WHERE m.id = '$idbusca'  ";
            break;
            
        case 'ano':
            $anobusca= intval($busca);
            $sql_busca=" WHERE ano = '$anobusca'   ";
            break;
            
        case 'titulo':
            $sql_busca=" WHERE titulo like '%$busca%'  ";
            break;
        case 'genero':
            $sql_busca=" WHERE genero like '%$busca%'   ";
            break;
  
        
        default:
            $idbusca= intval($busca);
            $anobusca= intval($busca);
            $sql_busca=" WHERE (m.id = '$idbusca' or ano = '$anobusca' or titulo like '%$busca%' or genero like '%$busca%') ";
            break;
    }
    
}

if(!empty($_GET["ordem"])){ 
    $valid_orders = ["id", "id desc", "titulo","titulo desc" , "ano", "ano desc"]; 
    $ordem = "titulo";  
    if (isset($_GET["ordem"]) && in_array($_GET["ordem"], $valid_orders)) { 
        $ordem = $_GET["ordem"]; 
    } 
}
if(!empty($Anomin) && !empty($Anomax)){
    if(strpos($sql_busca, 'WHERE') !== false){
        $sql_busca .= " AND ano BETWEEN '$Anomin' AND '$Anomax'";
    } else {
        $sql_busca = " WHERE ano BETWEEN '$Anomin' AND '$Anomax'";
    }
}




$sql = "SELECT m.id, titulo, ano, genero, poster, s.nome as streaming FROm midias m
left join streamings s on s.id = m.id_streaming $sql_busca ORDER BY $ordem";
$stmt = $conn->query($sql);


?>
<div class="row mb-3">
    <form action="" method="POST" class="row">
        <label class="col-sm-2 col-form-label text-end">
        Buscar por:
        </label>
        <div class="col-sm-2">
            <select name="tipo_busca" id="tipo_busca" class="form-select">
                <option value=""<?=($tipo_busca == "") ? "selected":""?>>Todos</option>
                <option value="id"<?=($tipo_busca == "id") ? "selected":""?>>ID</option>
                <option value="titulo"<?=($tipo_busca == "titulo") ? "selected":""?>>Título</option>
                <option value="genero"<?=($tipo_busca == "genero") ? "selected":""?>>Gênero</option>
                <option value="ano"<?=($tipo_busca == "ano") ? "selected":""?>>Ano</option>
            </select>
        </div>
        <div class="col-sm-6">
            <input type="search" name="busca" id="busca" value= "<?=$busca?>" placeholder="Digite um termo"> 
            <div>
            
                Min: <input type="number"  id="Anomin" name="Anomin" value= "<?=$Anomin?>" min="1888" max="2024">
                Max: <input type="number"  id="Anomax" name="Anomax" value= "<?=$Anomax?>"  min="1889" max="2025">
            </div>
        </div>
          
        <div class="col-sm-2">
            <button class="btn btn-primary">
                <i data-feather="search"></i>Pesquisar
            </button>
        </div>
    </form>
   
</div>
<?php
if($exibir_busca){
?>
<div class="alert alert-secondary">
    Resultados para: <b><?=$busca?></b>
    - <a href="listagem.php?ordem=<?=$ordem?>">limpar</a>
    
</div>
<?php    
}
if($stmt->rowCount()==0){
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
                <th scope="col" style="widht: 30%;"><a href="?ordem=<?=($ordem =="titulo")?"titulo desc":"titulo";?>">Titulo
                    <?php if ($ordem == "titulo") echo"⬇️"; ?>
                    <?php if ($ordem =="titulo desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 5%;"><a href="?ordem=<?=($ordem =="ano")?"ano desc":"ano";?>">Ano
                    <?php if ($ordem == "ano") echo"⬇️"; ?>
                    <?php if ($ordem =="ano desc") echo "⬆️";?>
                </a></th>
                 <th scope="col" style="widht: 30%;">Streaming</th>
                <th scope="col" style="widht: 30%;">Gênero</th>
                <th scope="col" style="widht: 30%;">Poster</th>
                <?php
                if(autenticado()){?><th scope="col" style="widht: 25%;" colspan="2"></th><?php }?>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row=$stmt->fetch()){
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["titulo"]?></td>
                <td><?=$row["ano"]?></td>
                <td><?=$row["streaming"]?></td>
                <td><?=$row["genero"]?></td>
                <td>
                    <a target="_blank" href="<?=$row["poster"]?>">Poster</a>
                </td>
                <?php if(autenticado()){  
                     ?><td>
                        <a href="formalt.php?id=<?=$row["id"]?>" class="btm btn-sm btn-warning">
                            <span data-feather="edit"></span>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a href="excluir.php?id=<?=$row["id"]?>" class="btm btn-sm btn-danger" onclick="if(!confirm('Certezas ?')) return false;">
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