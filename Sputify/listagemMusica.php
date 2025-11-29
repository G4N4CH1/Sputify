<?php 
session_start();
require "autenticacao.php";
$titulo_pagina="Listagem de Artistas";
require 'cabecalho.php';
require 'conexao.php';

$exibir_busca=false;
$sql_busca="";
$busca="";
$tipo_busca="";
$ordem="nome_art";



if(!empty($_POST["busca"])){
   
    $busca = filter_input(INPUT_POST,"busca",FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_busca= filter_input(INPUT_POST,"tipo_busca",FILTER_SANITIZE_SPECIAL_CHARS);
    $exibir_busca= true;
    switch ($tipo_busca) {
        case 'id':
            $idbusca= intval($busca);
            $sql_busca=" WHERE id_art = '$idbusca'  ";
            break;
            
        case 'qtd':
            $qtdbusca= intval($busca);
            $sql_busca=" WHERE qtd_memebros = '$qtdbusca'   ";
            break;
            
        case 'nome':
            $sql_busca=" WHERE nome_art like '%$busca%'  ";
            break;
        case 'genero':
            $sql_busca=" WHERE genero_musica like '%$busca%'   ";
            break;
        case 'pais':
            $sql_busca=" WHERE pais_origem like '%$busca%'   ";
            break;
  
        
        default:
            $idbusca= intval($busca);
            $qtdbusca= intval($busca);
            $sql_busca=" WHERE (id_art = '$idbusca' or qtd_membros = '$qtdbusca' or nome_art like '%$busca%' or genero_musica like '%$busca%' or pais_origem like '%$busca%') ";
            break;
    }
    
}

if(!empty($_GET["ordem"])){ 
    $valid_orders = ["id", "id desc", "nome","nome desc" , "qtd", "qtd desc"]; 
    $ordem = "nome";  
    if (isset($_GET["ordem"]) && in_array($_GET["ordem"], $valid_orders)) { 
        $ordem = $_GET["ordem"]; 
    } 
}


$sql = "SELECT id_art, nome_art, genero_musica, qtd_membros, pais_origem FROM artista  ORDER BY $ordem";
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
                <option value="nome"<?=($tipo_busca == "nome") ? "selected":""?>>Nome</option>
                <option value="genero"<?=($tipo_busca == "genero") ? "selected":""?>>Gênero</option>
                <option value="qtd"<?=($tipo_busca == "qtd") ? "selected":""?>>Quantidade de Membros</option>
                <option value="pais"<?=($tipo_busca == "pais") ? "selected":""?>>País de Origem</option>
            </select>
        </div>
        <div class="col-sm-6">
            <input type="search" name="busca" id="busca" value= "<?=$busca?>" placeholder="Digite um termo"> 
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
    <a href="listagemart.php?ordem=<?=$ordem?>">limpar</a>
    
</div>
<?php    
}
if($stmt->rowCount() == 0){
?>
    <div class="alert alert-warning mt-3">
        Nenhum Resultado 
    </div>
<?php
} else {

    if (isset($_SESSION["result"])) {

        if ($_SESSION["result"] == true && isset($_SESSION["msg_sucesso"])) {
?>
            <div class="row mt-3">
                <div class="col-8 offset-2">
                    <div class="alert alert-success" role="alert">
                        <h4><?= $_SESSION["msg_sucesso"] ?></h4>
                    </div>
                    <div style="text-align: center;">
                        <img src="https://img.freepik.com/vetores-premium/emoticon-feminino-com-o-polegar-para-cima_1303870-63.jpg?semt=ais_hybrid&w=740&q=80" alt="">
                    </div>
                </div>
            </div>
<?php
            unset($_SESSION["msg_sucesso"]);
        }

        if ($_SESSION["result"] == false && isset($_SESSION["msg_erro"])) {
?>
            <div class="row mt-3">
                <div class="col-8 offset-2">
                    <div class="alert alert-danger" role="alert">
                        <h4><?= $_SESSION["msg_erro"] ?></h4>
                        <p><?= $_SESSION["erro"] ?? "" ?></p>
                    </div>
                    <div style="text-align: center;">
                        <img src="https://www.shutterstock.com/image-illustration/3d-illustration-angry-emoticon-260nw-53719288.jpg" alt="">
                    </div>
                </div>
            </div>
<?php
            unset($_SESSION["msg_erro"]);
            unset($_SESSION["erro"]);
        }

        unset($_SESSION["result"]);
    }
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
                    <?php if ($ordem == "nome") echo"⬇️"; ?>
                    <?php if ($ordem =="nome desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 30%;">Gênero</th>
                <th scope="col" style="widht: 5%;"><a href="?ordem=<?=($ordem =="qtd")?"qtd desc":"qtd";?>">Quantidade de Membros
                    <?php if ($ordem == "qnt") echo"⬇️"; ?>
                    <?php if ($ordem =="qnt desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 30%;">Páis de Origem</th>
                <?php
                if(autenticado()){?><th scope="col" style="widht: 25%;" colspan="2"></th><?php }?>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row=$stmt->fetch()){
            ?>
            <tr>
                <td><?=$row["id_art"]?></td>
                <td><?=$row["nome_art"]?></td>
                <td><?=$row["genero_musica"]?></td>
                <td><?=$row["qtd_membros"]?></td>
                <td><?=$row["pais_origem"]?></td>
        </tbody>
    </table>
</div> 
<?php 
}
require 'rodape.php';
?>