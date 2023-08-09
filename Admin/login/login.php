<?php

include("conexao.php");
extract($_POST);
//Verificando se existe ou não.
if (isset($botao)){

    $siap = strval($siap);
    $senha = strval($senha);

    //Verificando se o usuario digitou o seu identificador.
    if(strlen($siap) == 0){
        echo 'Digite o seu login';
    }else if(strlen($senha) == 0){
        echo 'Digite o sua senha';
    }else{
    //Evitar que o usuário mal intencionado acesse o meu banco de dados.
        $siap = $mysqli -> real_escape_string($siap);
        $senha =  $mysqli -> real_escape_string($senha);

    //Verificar se o usuario fez o seu login.
        $sql_code = "SELECT * FROM cadastro WHERE siape = '$siap' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die('Falha na execução: ' . $mysqli->error);

        $quantidade = $sql_query -> num_rows;

        if($quantidade == 1){

            $siap = $sql_query -> fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['identificador'] = $siap['identificador'];

            header("location: ../alterar.php");


        }else{
            echo "Falha ao logar! Não existe alguém cadastrado com esses dados";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
     <!-- Introduzindo o metodo-->
    <form action="" method="POST">
       
        <p>
        <label for="">Usuário:</label> <br>
        <input type="text" name="siap"><br>
        </p>

        <p>
        <label for="">Senha:</label><br>
        <input type="password" name="senha"><br>
        </p>

        <p>
        <input type="submit" name='botao' value='Entrar'> <br>
        <a href="busca.php" target> Esqueceu a senha? <br>
        <input type="submit" name='cadastro' value='Criar uma nova conta'> <br>
        </p>


    </form>
    <?php
    extract($_POST);
    if (isset($cadastro)){
        header("location: ../cadastro.php");
    }
    if (isset($altera_senha)){
        header("location: busca.php");
    }
    ?>
</body>
</html>
