<!-- Essa pagina tem como o objetivo alterar a senha do adminiastrador caso tenha esquecido, sendo direcionado a mesma quando for verificado em duas etapas -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
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
