<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="mudsenha.css">
    <title>Alterar Senha</title>
     <!-- Esse código faz a alteração da senha-->
</head>
<body>  <!-- Jennifer -->
<H1>Altere a sua senha!</H1>
    <form action="mudar_senha.php" method="post">
 
        <label for="">Digite uma nova senha:</label> <br>
        <input type="text" name="usuario"><br><br>
        <label for="">Confirme a nova senha:</label><br>
        <input type="password" name="senha"><br><br>
        <input type="submit" name='alt' value='Alterar'>
        <input type="submit" name='voltar' value='Voltar a página de login'> <br>
    </form>
    <?php
    extract($_POST);
    if (isset($voltar)){
        header("location: login.php");
    }
    ?>
</body>
</html>
