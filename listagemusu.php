<?php 
session_start();
require "autenticacao.php";
$titulo_pagina="Listagem de Usuários";
require 'cabecalho.php';
require 'conexao.php';

$sql= "SELECT id_usu, nome_usu, email, tipo FROM usuario order by id_usu";
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
                <th scope="col" style="widht: 15%;">Tipo</th>
              
               
                <?php
                if(autenticado()){?><th scope="col" style="widht: 25%;" colspan="1"></th><?php }?>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row=$stmt->fetch()){
            ?>
            <tr>
                <td><?=$row["id_usu"]?></td>
                <td><?=$row["nome_usu"]?></td>
                <td><?=$row["email"]?></td>
                <td><?=$row["tipo"]?></td>
                
                    <?php
                  if (autenticado()) {
    if (fun()) {
        // Funcionário: pode excluir qualquer usuário
        ?>
        <td>
            <a href="excluirusu.php?id_usu=<?=$row["id_usu"]?>" onclick="return confirm('Certeza?')">
                <span data-feather="trash-2"></span> Excluir
            </a>
        </td>
        <?php
    } elseif (id_usu() == $row['id_usu']) {
        // Usuário comum: só pode excluir a própria conta
        ?>
        <td>
            <a href="excluirusu.php?id_usu=<?=$row["id_usu"]?>" onclick="return confirm('Certeza?')">
                <span data-feather="trash-2"></span> Excluir
            </a>
        </td>
        <?php
    }
}
                    }
            ?>
        </tbody>
    </table>
</div>
<?php 

require 'rodape.php';
?>