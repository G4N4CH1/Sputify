<?php 
session_start();
require "autenticacao.php";
$titulo_pagina="Listagem de Funcionários";
require 'cabecalho.php';
require 'conexao.php';
$sql= "SELECT id, nome, email FROM funcionario order by id";
$stmt = $conn->query($sql);
if (isset($_SESSION["result"])) {
  
  if ($_SESSION["result"]==true) {
    /*Deu CERTO */
   
    ?>
      <div class="row mt-3">
        <div class="col-8 offset-2">
          <div class="alert alert-success" role="alert">
            <h4><?=$_SESSION["msg_sucesso"]?></h4>
          </div>
          <div style="text-align: center;">
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
          <div style="text-align: center;">
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
}?>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="widht: 10%;">ID</th>
                <th scope="col" style="widht: 25%;">Nome</th>
                <th scope="col" style="widht: 15%;">Email</th>
                <?php
                if(autenticado()){?><th scope="col" style="widht: 25%;" colspan="1"></th><?php }?>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row=$stmt->fetch()){
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["email"]?></td>
                
                    <?php
                    if(autenticado()){
                        ?>
                        <td>
                            <?php
                            if(id_usu()==$row['id']){
                                ?>
                                        <a href="excluirusu.php?id=<?=$row["id"]?>" class="btm btn-sm btn-danger" onclick="if(!confirm('Certezas ?')) return false;">
                                    <span data-feather="trash-2"></span>
                                    Excluir
                                </a>
                                <?php
                            }
                            ?>
                           
                        
                        </td>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<?php 

require 'rodape.php';
?>