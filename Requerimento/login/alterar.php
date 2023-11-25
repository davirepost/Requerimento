<!-- Essa pagina tem como o objetivo permitir que o administrador altere a sua senha caso o mesmo tenha esquecido -->
<?php 

    include('conexao.php');
    extract($_POST);

    if (isset($alterar)){
        $consulta = "SELECT * FROM coordenacao WHERE id = '$codigo'";
        $resultado =  banco($server, $user, $password, $db, $consulta);

        while($consulta = mysqli_fetch_assoc($resultado)){
            if ($senha == $confirma_senha){
                $numero = 7;
                $identificador = bin2hex(random_bytes($numero));
                $consulta = "UPDATE coordenacao SET senha = '$confirma_senha', id = '$identificador'";
                $resultado =  banco($server, $user, $password, $db, $consulta);
                
                
                header('Location: login.php');
                echo 'Senha alterada com sucesso!';
                exit;
            }
        }
    }

    if(isset($voltar)){
        header('Location: login.php');
    }


?>


?>

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
    <form action="" method="post" autocomplete="off">
        <label for="">Codigo enviado por email::</label> <br>
        <input type="text" name="codigo"><br>
        <label for="">Nova senha:</label> <br>
        <input type="password" name="senha"><br>
        <label for="">Confirme a nova senha:</label><br>
        <input type="password" name="confirma_senha"><br>
        <input type="submit" name='alterar' value='Alterar'> <br>
        <input type="submit" name='voltar' value='Voltar a página de login'> <br>
    </form>
</body>
</html>
