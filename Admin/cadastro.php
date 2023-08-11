<?php //Guilherme
    include('login/conexao.php');
    extract($_POST);

    if(isset($nome) || isset($sobrenome) || isset($siape) || isset($email) || isset($coordenacao) || isset($usuario) || isset($senha)){
        
        //Verificando se o usuario digitou o seu nome. 
        if(strlen($nome) == 0){
            echo 'Digite o seu nome!';
        }
        //Verificando se o usuario digitou o seu sobrenome. 
        else if(strlen($sobrenome) == 0){
            echo 'Digite o seu sobrenome!';
        }
        //Verificando se o usuario digitou o seu siape. 
        if(strlen($siape) == 0){
            echo 'Digite o seu siape!';
        }
        //Verificando se o usuario digitou o seu email. 
        else if(strlen($email) == 0){
            echo 'Digite o seu e-mail!';
        }
        //Verificando se o usuario digitou a sua coordenação. 
        if(strlen($coordenacao) == 0){
            echo 'Digite a sua coordenação!';
        }
        //Verificando se o usuario digitou o seu usuario. 
        else if(strlen($usuario) == 0){
            echo 'Digite o seu usuario!';
        }
        //Verificando se o usuario digitou a sua senha.
        if(strlen($senha) == 0){
            echo 'Digite a sua senha!';
        }else{

            $nome = $mysqli -> real_escape_string($nome);
            $sobrenome =  $mysqli -> real_escape_string($sobrenome);
            $siape = $mysqli -> real_escape_string($siape);
            $email =  $mysqli -> real_escape_string($email);
            $coordenacao = $mysqli -> real_escape_string($coordenacao);
            $usuario =  $mysqli -> real_escape_string($usuario);
            $senha = $mysqli -> real_escape_string($senha);

            $sql_code = "INSERT INTO cadastro(nome, sobrenome, siape, email, coordenacao, usuario, senha)
            Values('$nome', '$sobrenome', '$siape', '$email', '$coordenacao' ,'$usuario', '$senha')";
            $sql_query = mysqli_query($mysqli,$sql_code) or die('Falha na execução: ' . $mysqli->error);
            
            if ($sql_query) {
                echo "Cadastrado com sucesso!";
                header("location: login/login.php");
            }else{
                echo "Usuario não cadastrado! Tente novamente!";
            }
            
            mysqli_free_result($sql_query);
            mysqli_close($mysqli);
        }

    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<H1>Login</H1>
    <form action="" method="post">
        <p>
        <label for="">Digite seu nome: </label> 
        <input type="text" name="nome"><br>
        </p>

        <p>
        <label for="">Digite seu sobrenome: </label>
        <input type="text" name="sobrenome"><br>
        </p>

        <p>
        <label for="">Digite seu SIAPE: </label>
        <input type="text" name="siape"><br>
        </p>

        <p>
        <label for="">Digite seu e-mail: </label> 
        <input type="text" name="email"><br>
        </p>

        <p>
        <label for="">Digite sua cordernação: </label> 
        <input type="text" name="coordenacao"><br>
        </p>

        <p>
        <label for="">Digite o seu nome de usuario: </label>
        <input type="text" name='usuario'>
        </p>

        <p>
        <label for="">Digite sua senha: </label> 
        <input type="password" name="senha"><br>
        </p>

        <input type="submit" name='botao' value='Já tenho uma conta'> <br>
        <input type="submit" name='cadastro' value='Cadastre-se'> <br>
        

    </form>
    <?php
    extract($_POST);
    if (isset($botao)){
        header("location: login/login.php");
    }
    ?>
</body>
</html>
