<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <!-- Guilherme -->
</head>
<body>

     <form action="login.php" method ='post'>
                Usuário: <input type="text" name='siape'><br>
                Senha: <input type="text" name='senha'><br><br>
                <input type="checkbox" name="sessao"> Salvar informações de login
                <input type="submit" name='entrar' value='Entrar'>
                <a href="busca.php" target> Esqueceu a senha? </a>
                <a href="suporte.php" target> Suporte </a>

    </form>
    
    
     <?php 
        include "conexao.php";
        
        extract($_POST); 

            if (isset($entrar)){
                if(empty($siape) || empty($senha)){
                    echo 'Preencha todos os campos! <br>';
        
                }if(strlen($siape) == 7){

                        $banco =  new mysqli($server, $user, $password, $db);
                    //Evitar que o usuário mal intencionado acesse o meu banco de dados.
                        $siape = $banco -> real_escape_string($siape);
                        $senha =  $banco -> real_escape_string($senha);
                    
                    //Verificar se o usuario fez o seu login.
                        $sql_code = "SELECT * FROM departamento WHERE cod_siape = $siape AND senha = '$senha'";
                        $sql_query = $banco->query($sql_code) or die('Falha na execução: ' . $banco->error);
                
                        $quantidade = $sql_query -> num_rows;
                
                        if($quantidade == 1){
                
                            $login= $sql_query -> fetch_assoc();
                
                            
                            header ('Location: ../Pagina/tela_inicial.php');
                            exit;
                            
                        }else{
                            echo "Falha ao logar! Não existe alguém cadastrado com esses dados";
                        }
                }else{
                    echo "Codigo siape indefinido(numero excedeu o seu limite ou não foi encontrado)!";
                }
            }
         ?>
</body>
</html>