<?php 

$titulo_pagina="Músicas";
require 'cabecalho.php';
require 'conexao.php';

$ordem="titulo";
if(!empty($_GET["ordem"])){ 
    $valid_orders = ["id_mus", "id_mus desc", "titulo","titulo desc" , "duracao", "duracao desc"]; 
    $ordem = "titulo";  
    if (isset($_GET["ordem"]) && in_array($_GET["ordem"], $valid_orders)) { 
        $ordem = $_GET["ordem"]; 
    } 
}

$sql= "SELECT id_mus, titulo, duracao, album FROM musicas order by $ordem";
$stmt = $conn->query($sql);
?>
        <div class="d-flex justify-content-end me-4 my-3 ordenacao align-items-center">
        <span class="me-2 fw-semibold">Ordenar por:</span>
        <a href="?ordem=<?=($ordem =="id_mus")?"id_mus desc":"id_mus";?>" class="btn btn-outline-primary btn-sm mx-1 active">
            ID
            <?php if ($ordem == "id_mus") echo"⬇"; ?>
            <?php if ($ordem =="id_mus desc") echo "⬆";?>
        </a>
        <a href="?ordem=<?=($ordem =="titulo")?"titulo desc":"titulo";?>" class="btn btn-outline-primary btn-sm mx-1 active">
            Título
            <?php if ($ordem == "titulo") echo"⬇️"; ?>
            <?php if ($ordem =="titulo desc") echo "⬆️";?>
        </a>

        <a href="?ordem=<?=($ordem =="duracao")?"duracao desc":"duracao";?>" class="btn btn-outline-primary btn-sm mx-1 active ">
            Duração
             <?php if ($ordem == "duracao") echo"⬇️"; ?>
            <?php if ($ordem =="duracao desc") echo "⬆️";?>
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
                        <img src="<?= $row['album'] ?>" alt="<?= $row['album'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['titulo'] ?></h5>
                            <p class="card-text mb-2"><?= $row['duracao'] ?></p>
                            <hr class="mt-0 mb-2">
                          
                            
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