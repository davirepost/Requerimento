<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="permitido.css">
    <title>Document</title>
     <!-- Jennifer -->
     <!-- Esse código vai para uma página de cadastrado com sucesso-->
</head>
<body>

  <form action="permitido.php" method="post">
        Seu cadastro foi feito com sucesso.
        <input type="submit" name='voltar' value='Voltar'>

    </form>



<?php

extract($_POST);

if(isset($voltar)){
 
        header ('Location: login.php');
        exit; 


    }


?>
</body>
</html>
