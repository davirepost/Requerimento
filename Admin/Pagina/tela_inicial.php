<?php 
    include('../login/protecao.php');
    include('../login/conexao.php');

    extract($_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <a href="../login/sair.php">Sair</a>

    <h2>Objetivo: </h2>
    <input type="checkbox" name="falta" > Justificativa de falta <br>
    <input type="checkbox" name="falta" > Segunda chamada

    <h2>Nome: </h2>
    <input type="text" name="nome">

    <h2>Docentes envolvidos:</h2>.

    <h2>Observações: </h2>
    <textarea name="observacao" id="" cols="30" rows="10"></textarea>
    
    </form>




</body>
</html>