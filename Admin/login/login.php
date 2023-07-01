<?php
include("conexao.php");

//Verificando se existe ou não.
if (isset($_POST['siap']) || isset($_POST['senha'])){

    //Verificando se o usuario digitou o seu identificador.
    if(strlen($_POST['siap']) == 0){
        echo 'Digite o seu login';
    }
    //Verificando se o usuario digitou a sua senha. 
    else if(strlen($_POST['senha']) == 0){
        echo 'Digite o sua senha';
    }else{

    //Evitar que o usuário mal intencionado acesse o meu banco de dados.
        $siap = $mysqli -> real_escape_string($_POST['siap']);
        $senha =  $mysqli -> real_escape_string($_POST['senha']);

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
    <H1>Efetue o seu login</H1>
     <!-- Introduzindo o metodo-->
    <form action="" method="post">
       
        <p>
        <label for="">Digite seu id(SIAP):</label> <br>
        <input type="text" name="siap"><br>
        </p>

        <p>
        <label for="">Digite a sua senha:</label><br>
        <input type="password" name="senha"><br>
        </p>

        <p>
        <input type="submit" name='botao' value='Fazer login'> <br>
        <input type="submit" name='cadastro' value='Criar uma nova conta'> <br>
        <input type="submit" name='altera_senha' value='Esqueceu a sua conta?'> <br>
        </p>


    </form>
    <?php
    extract($_POST);
    if (isset($cadastro)){
        header("location: busca.php");
    }
    if (isset($altera_senha)){
        header("location: ../alterar.php");
    }
    ?>
</body>
</html>