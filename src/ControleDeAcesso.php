<?php
namespace Microblog;

final class ControleDeAcesso{

    public function __construct(){
        //Se não existir a sessão "em andamento"
        if (!isset($_SESSION)){ 
            // Então inicialize a sessão
            session_start();
        }
    }

    
    public function verificarAcesso():void{
        if (!isset($_SESSION['id'])){ 
            session_destroy();
            header("location:../login.php");
            die();
        }

    }
}