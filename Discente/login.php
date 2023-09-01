<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="logindis.css">
    <title>Login Discente</title>
     <!-- Jennifer -->
     <!-- Esse código faz o login dos discentes -->
</head>
<link rel="stylesheet" type="text/css" href="login.css">
<body>
     <form action="login.php" method ='post'>
                Matricula: <input type="text" name='login'><br>
                Senha: <input type="password" name='senha'><br><br>
                <input type="submit" name='entrar' value='Entrar'>
                <input type="submit" name='cadastro' value='Cadastro'>
                <input type="submit" name='esqueceu' value='Esqueceu a senha?'>

    </form>
    
    
     <?php 
        include "dll.php";
        include "constantes.php";
        
        extract($_POST); 
            if (isset($esqueceu)){

                header ('Location: mudar_senha.php');
                exit;
            }
            if (isset($cadastro)){

                header ('Location: cadastro.php');
                exit;
            }
            if (isset($login) || isset($senha)){

                //Verificando se o usuario digitou o seu identificador.
                if(strlen($login) == 0){
                    echo 'Digite o seu login';
                }
                //Verificando se o usuario digitou a sua senha. 
                else if(strlen($senha) == 0){
                    echo 'Digite o sua senha';
                }else{
                    $banco =  new mysqli($server, $user, $password, $db);
                //Evitar que o usuário mal intencionado acesse o meu banco de dados.
                    $login = $banco -> real_escape_string($login);
                    $senha =  $banco -> real_escape_string($senha);
            
                //Verificar se o usuario fez o seu login.
                    $sql_code = "SELECT * FROM discente  WHERE  matricula = $login AND senha = '$senha'";
                    $sql_query = $banco->query($sql_code) or die('Falha na execução: ' . $banco->error);
            
                    $quantidade = $sql_query -> num_rows;
                    header ('Location: permitido_login.php');
                    exit;
            
                    if($quantidade == 1){
            
                        $login= $sql_query -> fetch_assoc();
            
                       
                    }else{
                        echo "Falha ao logar! Não existe alguém cadastrado com esses dados";
                    }
                }
            }
         ?>
</body>
</html>
