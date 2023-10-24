<?php 
        include "conexao.php";
        extract($_POST); 
        if (isset($entrar)){
            if(strlen($siape) == 7){

                //Verificar se o usuario fez o seu login.
                    $consulta = "SELECT * FROM coordenacao WHERE cod_siape = $siape AND senha = '$senha'";
                    $resultado = banco($server, $user, $password, $db, $consulta); 
                
                    $quantidade = $resultado -> num_rows;
                
                    if($quantidade == 1){
                
                        $projeto = $resultado -> fetch_assoc();
                            
                        if(!isset($_SESSION)){
                            session_start();
                        }

                        $_SESSION['id'] = $projeto['id'];
                        $_SESSION['nome'] = $projeto['nome'];

                        header ('Location: ../Pagina/tela_inicial.php');
                        exit;
                            
                    }else{
                        echo "Falha ao logar! Não existe alguém cadastrado com esses dados";
                    }

            }if($siape!=7){
                echo "Codigo siape indefinido!";
            }    
        }        
            
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <!-- Guilherme -->
</head>
<body>

     <form action="" method ="post" autocomplete="off">
                Usuário: <input type="text" name="siape" required><br>
                Senha: <input type="password" name="senha" required><br><br>
                <input type="submit" name="entrar" value="Entrar">
                <a href="busca.php" target> Esqueceu a senha? </a>
                <a href="suporte.php" target> Suporte </a>

    </form>
</body>
</html>