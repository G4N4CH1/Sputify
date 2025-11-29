<?php 
session_start();
require "autenticacao.php";
$titulo_pagina="Listagem de Series";
require 'cabecalho.php';
require 'conexao.php';

$ordem="titulo";
if(!empty($_GET["ordem"])){ 
    $valid_orders = ["id", "id desc", "titulo","titulo desc" , "ano", "ano desc","temporadas desc", "temporadas"]; 
    $ordem = "titulo";  
    if (isset($_GET["ordem"]) && in_array($_GET["ordem"], $valid_orders)) { 
        $ordem = $_GET["ordem"]; 
    } 
}
$sql = "SELECT s.id, titulo, ano, genero, poster, temporadas, p.nome as streaming FROm series s
left join streamings p on p.id = s.id_streaming  order by $ordem";
$stmt = $conn->query($sql);
?>
        <div class="d-flex justify-content-end me-4 my-3 ordenacao align-items-center">
        <span class="me-2 fw-semibold">Ordenar por:</span>
        <a href="?ordem=<?=($ordem =="id")?"id desc":"id";?>" class="btn btn-outline-primary btn-sm mx-1 active">
            ID
            <?php if ($ordem == "id") echo"⬇"; ?>
            <?php if ($ordem =="id desc") echo "⬆";?>
        </a>
        <a href="?ordem=<?=($ordem =="titulo")?"titulo desc":"titulo";?>" class="btn btn-outline-primary btn-sm mx-1 active">
            Título
            <?php if ($ordem == "titulo") echo"⬇️"; ?>
            <?php if ($ordem =="titulo desc") echo "⬆️";?>
        </a>

        <a href="?ordem=<?=($ordem =="ano")?"ano desc":"ano";?>" class="btn btn-outline-primary btn-sm mx-1 active ">
            Ano
             <?php if ($ordem == "ano") echo"⬇️"; ?>
            <?php if ($ordem =="ano desc") echo "⬆️";?>
        </a>
        <a href="?ordem=<?=($ordem =="temporadas")?"temporadas desc":"temporadas";?>" class="btn btn-outline-primary btn-sm mx-1 active ">
            Temporadas
             <?php if ($ordem == "temporadas") echo"⬇️"; ?>
            <?php if ($ordem =="temporadas desc") echo "⬆️";?>
        </a>
    </div>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
            <?php
                while($row=$stmt->fetch()){
            ?>
            
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="<?= $row['poster'] ?>" alt="<?= $row['poster'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['titulo'] ?></h5>
                            <p class="card-text mb-2"><?= $row['genero'] ?></p>
                            <hr class="mt-0 mb-2">
                            <p class="card-text text-end">Ano: <b> <?= $row['ano'] ?></b></p>
                            <p class="card-text text-end">Temporadas: <b> <?= $row['temporadas'] ?></b></p>
                            <p class="card-text text-end"><?= $row['streaming'] ?></p>
                        </div>
                    </div>
                </div>
            <?php 
                }
            ?>
            </div>
        </div>
    </div>
<?php 

require 'rodape.php';
?>