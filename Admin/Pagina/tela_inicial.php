<?php 
    include('../login/protecao.php');
    include('../login/conexao.php');
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
    <a href="../login/sair.php">Sair</a> <br>

    <label>Nome: </label> <br>
    <input type="text" name="nome"> <br>


    <label for="">Objetivo:</label><br>
    <select name="objeto" multiple>
    <option value="1">Justificativa de Falta</option>
    <option value="2">2° segunda chamada</option>
    </select> <br>

    <label>Docentes envolvidos: </label> <br>
    <input type="text" name="docentes"> <br>

    <label>Observações: </label> <br> 
    <textarea name="observacao" id="" cols="30" rows="10"></textarea>
    
    </form>

    <?php 
    
    extract($_POST);
    
    $consulta =  "INSERT INTO requerimento(`objeto`, `data_inicial`, `data_final`, `data/hora_regis`, `obs`, `anexos`, `status`, `turma`, `discente_matricula`, `idcurso`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]')";
    
    ?>



</body>
</html>