<?php 
    if(!isset($_SESSION)){
        session_start();
    }   

    if (!isset($_SESSION['id'])){
        die("Você não pode acessar está página, primeiro faça o seu login! <p> <a href= ../login/index.php> Voltar para a página de login </a> </p>");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/protecao_login.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>