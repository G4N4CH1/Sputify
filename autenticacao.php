<?php 
function autenticado(){ // retorna valores
     if(isset($_SESSION["email"])){
        return true;

     }else{
        return false;
     }
}
function nome_usu(){
    return $_SESSION["nome"];
}
function email_usu(){
    return $_SESSION["email"];
}
function id_usu(){
    return $_SESSION["id_usu"];
}

function redireciona($pagina=null){
    if(empty($pagina)){
        $pagina="index.php";
    }
    header("Location: $pagina");
}
function usu(){
    if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="USU"){
        return true;

     }else{
        return false;
     }
}
function fun(){
    if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="FUN"){
        return true;

     }else{
        return false;
     }
}
?>