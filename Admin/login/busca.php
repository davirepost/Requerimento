<?php

    include("conexao.php");

    if (isset($_GET['email']) ){
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <form action="" method="GET">
        <p>
        <label for="">Digite seu email para busca: </label> 
        <input type="text" name="email"><br>
        </p>
        <input type="submit" name="buscar" value="Fazer a busca">
    </form>
</body>
</html>