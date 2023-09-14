
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <title>Pagiá Adm</title>
</head>
<body>


    <form action="" method="post">
    <input type="submit" name='cadastro' value='Cadastrar Usuários'>
    <input type="submit" name='lista' value='Abrir Lista de Usuários'>
    </form>
    

    <?php

        extract($_POST);

        if (isset($cadastro)) {
            header("location: cadastro.php");
        }
        if (isset($lista)) {
            header("location: lista.php");
        }
        ?>

</body>
</html>