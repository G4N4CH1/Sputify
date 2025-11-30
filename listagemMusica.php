<?php 
session_start();
require 'autenticacao.php';   
$titulo_pagina="Listagem de Músicas";
require 'cabecalho.php';
require 'conexao.php';

$exibir_busca=false;
$sql_busca="";
$busca="";
$tipo_busca="";
$ordem="titulo";
//busca  
	if(!empty($_POST["busca"])){   
       $busca=filter_input(INPUT_POST, "busca", FILTER_SANITIZE_SPECIAL_CHARS);
       $tipo_busca= filter_input(INPUT_POST, "tipo_busca", FILTER_SANITIZE_SPECIAL_CHARS);
       
        $exibir_busca=true;
        
        switch( $tipo_busca){
            case 'id_mus': 
                $idBusca= intval($busca);
                $sql_busca="WHERE id_mus ='$idBusca' ";
                break;
            
            case 'titulo': 
                $sql_busca="WHERE titulo like '%$busca%' ";
                break;
                
            case 'duracao': 
                $sql_busca="WHERE duracao like '%$busca%' ";
                break;
                
            default:
                $idBusca= intval($busca);
                $sql_busca=" WHERE id_mus ='$idBusca' OR titulo like '%$busca%' OR  duracao like '%$busca%' ";
                break;
        }
    }
//ordenação
      if(!empty($_GET["ordem"])){
        //white list
         
        $valid_orders= ["id_mus", "id_mus desc", "titulo", "titulo desc",  "duracao", "duracao desc"];
      
          if(isset($_GET["ordem"]) && in_array($_GET["ordem"],$valid_orders )){
              $ordem=filter_input(INPUT_GET, "ordem", FILTER_SANITIZE_SPECIAL_CHARS);
          }else{
            $ordem="titulo";  
          }
    }


$sql = "SELECT id_mus, titulo, duracao, album FROM musica $sql_busca order by $ordem";
$stmt = $conn->query($sql);

echo "<p>Driver: <b>". $conf["driver"] . "</b> </p>";
?>
<div class="row mb-3">
    
    <form action="" method="POST" class="row">
    <label class="col-sm-2 col-form-label text-end">
        Buscar por
        </label>
        <div class="col-sm-2 ">
        <select name="tipo_busca" id="tipo_busca" class="form-select" >
            <option value=""<?= ($tipo_busca== "") ? "selected" : "" ?> >Todos os campos</option>
            <option value="id" <?= ($tipo_busca=="id_mus") ? "selected" : ""?>>ID</option>
            <option value="titulo" <?= ($tipo_busca== "titulo") ? "selected" : ""?> >Título</option>
            <option value="genero"<?= ($tipo_busca=="duracao") ? "selected" : ""?>>Duração</option>
            </select>
        </div>
        <div class="col-sm-6 ">
        	<input type="search" name="busca" id="busca" placeholder="Digite um termo"
                   class="form-control"value="<?=$busca?>">
        </div>
        <div class="col-sm-2 ">
        <button class="btn btn-primary">
            <i data-feather="search"></i> Pesquisar
            </button>
       	</div>    
    </form>
</div>

<?php 

if($exibir_busca){
?>
	<div class="alert alert-secondary">
        Resultados para:<b><?= $busca ?></b>     
        
        <a href="listagemMusica.php?ordem=<?=$ordem?>">-Limpar</a>
     
</div>
<?php    
}


if($stmt->rowCount()==0){
 ?>   
		<div class="alert alert-warning mt-3">
            Nenhum resultado encontrado!
		</div>
<?php    
}else{
    
if (isset($_SESSION["result"])) {
    
    if($_SESSION["result"]==true) {
        /**deu certo*/
        ?>         
			<div class="row mt-3">
        <div class="col-8 offset-2">
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
        <div class="col-8 offset-2">
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
    

?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col" style="widht: 10%;">
                    <a href= "?ordem=<?=($ordem=="id_mus") ? "id_mus desc" : "id_mus";?>"> ID</a>
                    <?php if ($ordem == "id_mus") echo "▼";?>
					<?php if ($ordem == "id_mus desc") echo "▲";?>

                </th>
                <th scope="col" style="widht: 25%;">
                    <a href= "?ordem=<?=($ordem=="titulo") ? "titulo desc" : "titulo";?>"> Título</a>
                    <?php if ($ordem == "titulo") echo "▼";?>
					<?php if ($ordem == "titulo desc") echo "▲";?>
                    
                </th>
              
                <th scope="col" style="widht: 10%;">
                    <a href= "?ordem=<?=($ordem=="duracao") ? "duracao desc" : "duracao";?>">Duração</a>
                    <?php if ($ordem == "duracao") echo "▼";?>
					<?php if ($ordem == "duracao desc") echo "▲";?>
                </th>
            </th>
               
        <th scope="col" style="widht: 15%;"> Duração </th>
        <th scope="col" style="widht: 25%;">Álbum</th>
                

                
                
                
                <?php
                	if(autenticado()){          
                ?>
                <th scope="col" style="widht: 25%;" colspan="2"></th>
				<?php
                    }          
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmt->fetch()){

                
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["titulo"]?></td>
                <td><?=$row["duracao"]?></td>
                
                <td><a target="_blank" href="<?=$row["album"]?>">Link do álbum</a></td>
                
                
                <?php
                if(autenticado()){          
                ?>
                
                <td>
                    <a class="btn btn-sm btn-warning" 
                    href="formaltMusica.php?id=<?= $row['id_mus'] ?>">
                        <span data-feather="edit"></span>
                        Editar
                    </a>
                </td>
                <td>
                    <a class="btn btn-sm btn-danger" href="excluirMusica.php?id=<?=$row["id_mus"]?>"
                        onclick="if(!confirm('Tem CERTEZA que deseja EXCLUIR?'))return false;">
                        <span data-feather="trash-2"></span>
                        Excluir
                    </a>
                </td>
                <?php
                }
                ?>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php 
}
require'rodape.php';
?>