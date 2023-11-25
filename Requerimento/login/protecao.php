<?php 
    if(!isset($_SESSION)){
        session_start();
    }   

    if (!isset($_SESSION['id'])){
        die("Você não pode acessar está página, primeiro faça o seu login! <p> <a href= ../login/index.php> Voltar para a página de login </a> </p>");
    }
?>