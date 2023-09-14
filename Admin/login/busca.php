<!-- Essa página tem como objetivo levar fazer verificar por email a exitência do usuário e caso exista o email mandará ao email pessoal o link da página para alterar.php afim de que sua senha seja alterada -->

<?php //Guilherme

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
    <title>Busca do ADM</title>
</head>
<body>
    <form action="" method="get">

    </form>
    <form action="" method="post">
        <input type="submit" name="buscar" value="Fazer a busca"><br>
        <a href="suporte.php" target>Não consegue redifinir a sua senha?'</a> <br>
        <input type="submit" name="voltar" value="Voltar a tela de login">
    </form>

    <?php
        extract($_POST);
        if (isset($voltar)){
            header("location: login.php");
        }
    ?>
</body>
</html>
