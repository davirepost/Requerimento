<?php

     include('../login/conexao.php');
     // Extrai as variáveis enviadas pelo formulário usando o método POST
     extract($_POST);

    if (isset($entrar)){
            if(empty($cod_adm) || empty($senha)){
                echo 'Preencha todos os campos! <br>'; 
            } if(strlen($cod_adm) == 9){

                $banco =  new mysqli($server, $user, $password, $db);
            //Evitar que o usuário mal intencionado acesse o meu banco de dados.
                $cod_adm = $banco -> real_escape_string($cod_adm);
                $senha =  $banco -> real_escape_string($senha);
            
            //Verificar se o usuario fez o seu login.
                $sql_code = "SELECT * FROM adm WHERE cod_adm = $cod_adm AND senha = '$senha'";
                $sql_query = $banco->query($sql_code) or die('Falha na execução: ' . $banco->error);
        
                $quantidade = $sql_query -> num_rows;
        
                if($quantidade == 1){
        
                    $login= $sql_query -> fetch_assoc();
                    
                    session_start();

                    header ('Location: pagina_adm.php');
                    exit;
                    
                }else{
                    echo "Falha ao logar! Cadastro do administrador não encontrado!";
                }
        }else{
            echo "Cadastro do administrador não compativel! Verifique o usuario!";
        }
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_administrador</title>
</head>
<body>
    
<form action="login_administrador.php" method ='post'>
                Usuário: <input type="text" name='cod_adm'><br>
                Senha: <input type="text" name='senha'><br><br>
                <input type="checkbox" name="sessao"> Salvar informações de login
                <input type="submit" name='entrar' value='Entrar'>
                <a href="busca.php" target> Esqueceu a senha? </a>
                <a href="suporte.php" target> Suporte </a>
    </form>

</body>
</html>