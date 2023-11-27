<?php 
    include('../login/conexao.php');
    include('../login/protecao.php');

    $id = $_GET['id'];

    $consulta = "SELECT * FROM discente WHERE id=$id";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($resultado->num_rows > 0){
        while($user_data = mysqli_fetch_assoc($resultado))
        {
            $matricula = $user_data['matricula']; 
        }
    }

    $consulta = "SELECT `data/hora_regis`, `status`, idrequerimento, objeto FROM requerimento WHERE discente_matricula = $matricula";
    $resultado = banco($server, $user, $password, $db, $consulta);

    while($user = mysqli_fetch_assoc($resultado)){
        echo '    <p>ID: ' . $user['idrequerimento'] . '</p>';
        echo '    <p>Data Do Pedido: ' . $user['data/hora_regis'] . '</p>';
        echo '    <p>Status: ' . $user['status'] . '</p>';
        echo '    <p>Objetivo: ' . $user['objeto'] . '</p>';

    }
    
    if(isset($_POST['voltar'])){
        header('Location: pagina_inicial.php');
        exit(); 
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="voltar" value="Voltar">
    </form>
</body>
</html>
