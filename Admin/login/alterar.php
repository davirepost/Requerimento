<!-- Essa pagina tem como o objetivo permitir que o administrador altere a sua senha caso o mesmo tenha esquecido -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="alteraradm.css">
    <title>Alterar Senha do Administrador</title>
</head>
<body>  <!-- Guilherme -->
<H1>Altere a sua senha!</H1>
    <form action="" method="post">
 
        <label for="">Digite uma nova senha:</label> <br>
        <input type="text" name="usuario"><br>
        <label for="">Confirme a nova senha:</label><br>
        <input type="password" name="senha"><br>
        <input type="submit" name='alt' value='Alterar'> <br>
        <input type="submit" name='voltar' value='Voltar a página de login'> <br>
    </form>
    <?php
    extract($_POST);
    if (isset($voltar)){
        header("location: login/login.php");
    }
    ?>
</body>
</html>
