<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

  <form action="permitido.php" method="post">
        Seu cadastro foi feito com sucesso
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