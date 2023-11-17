<?php
include ('../login/protecao.php');
extract($_POST);

if (isset($cadastro)) {
    header("location: cadastro.php");
}
if (isset($lista)) {
    header("location: lista.php");
}
if (isset($sair)){
    session_destroy();
    header('location: ../login/index.php');
}
?>
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
    <input type="submit" name='sair' value='Sair'>
    </form>

</body>
</html>