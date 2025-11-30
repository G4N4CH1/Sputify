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
            $sql_busca=" WHERE a.id_art = '$idbusca'  ";
            break;
            
        case 'qtd':
            $qtdbusca= intval($busca);
            $sql_busca=" WHERE qtd_membros = '$qtdbusca'   ";
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
    $valid_orders = ["id_art", "id_art desc", "nome_art","nome_art desc" , "qtd_membros", "qtd_membros desc"]; 
    $ordem = "nome_art";  
    if (isset($_GET["ordem"]) && in_array($_GET["ordem"], $valid_orders)) { 
        $ordem = $_GET["ordem"]; 
    } 
}
if(autenticado()&&usu()){
    $id_usu=id_usu();
    $sql = "SELECT a.id_art, nome_art, genero_musica, qtd_membros, pais_origem, af.id_af as artistafav FROM artista a 
            left join artistafav af on af.id_art = a.id_art and af.id_usu=$id_usu 
            $sql_busca order by $ordem";
$stmt = $conn->query($sql);
}else{
$sql=" SELECT id_art, nome_art, genero_musica, qtd_membros, pais_origem FROM artista $sql_busca order by $ordem";
$stmt = $conn->query($sql);
}



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
<div class="table-responsive corpo">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="widht: 5%;"><a href="?ordem=<?=($ordem =="id_art")?"id_art desc":"id_art";?>">ID
                    <?php if ($ordem == "id_art") echo"⬇️"; ?>
                    <?php if ($ordem =="id_art desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 30%;"><a href="?ordem=<?=($ordem =="nome")?"nome_art desc":"nome_art";?>">Nome
                    <?php if ($ordem == "nome_art") echo"⬇️"; ?>
                    <?php if ($ordem =="nome_art desc") echo "⬆️";?>
                </a></th>
                <th scope="col" style="widht: 30%;">Gênero</th>
                <th scope="col" style="widht: 5%;"><a href="?ordem=<?=($ordem =="qtd")?"_membros desc":"qtd_membros";?>">Quantidade de Membros
                    <?php if ($ordem == "qtd_membros") echo"⬇️"; ?>
                    <?php if ($ordem =="qtd_membros desc") echo "⬆️";?>
                </a></th>
                
                <th scope="col" style="widht: 30%;">País de Origem</th>
                <th scope="col" style="widht: 30%;"></th>
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
                <td>
                    <?php
                    if(autenticado() && usu()){
                        if(!empty($row["artistafav"])){
                        ?>
                            <a href="favoritaArt.php?id=<?=$row['id_art']?>&favorito=<?=$row['artistafav']?>&pagina=listagemart.php" class="link-warning">
                            <span data-feather="star" style="color: gold; fill: gold; stroke:gold;"></span>
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="favoritaArt.php?id=<?=$row['id_art']?>&favorito=&pagina=listagemart.php" class="link-warning">
                            <span data-feather="star"></span>
                            </a>
                        <?php
                        }
                    }
                    ?>
                </td>

                <?php if(autenticado()&&fun()){  ?>
                <td>
                    <a href="formaltArtista.php?id=<?=$row["id_art"]?>" class="btm btn-sm btn-warning">
                        <span data-feather="edit"></span>
                        Editar
                    </a>
                </td>
                <td>
                    <a href="excluirArtista.php?id=<?=$row["id_art"]?>" class="btm btn-sm btn-danger" onclick="if(!confirm('Certezas ?')) return false;">
                        <span data-feather="trash-2"></span>
                        Excluir
                    </a>
                </td>
            </tr>
            <?php
             }}
            ?>
        </tbody>
    </table>
</div> 
<?php 
require 'rodape.php';
?>