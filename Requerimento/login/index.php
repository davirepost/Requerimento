<?php 
    include("conexao.php");
    extract($_POST); 
    if (isset($entrar)){

        if(strlen($acesso) == 11){

            $consulta = "SELECT * FROM adm WHERE cod_adm = $acesso AND senha = '$senha'";
            $resultado = banco($server, $user, $password, $db, $consulta); 
                
            $quantidade = $resultado->num_rows;
                
            if($quantidade == 1){
                
                $projeto = $resultado->fetch_assoc();
                            
                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['id'] = $projeto['id'];

                header ('Location: ../administracao/pagina_adm.php');
                exit;
                            
            }
        } elseif(strlen($acesso) == 12){

            $consulta = "SELECT * FROM discente  WHERE  matricula = $acesso AND senha = '$senha'";
            $resultado = banco($server, $user, $password, $db, $consulta); 
                
            $quantidade = $resultado->num_rows;
                
            if($quantidade == 1){
                
                $projeto = $resultado->fetch_assoc();   
                            
                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['id'] = $projeto['id'];
                $_SESSION['nome'] = $projeto['nome'];

                header ('Location: ../discente/pagina_inicial.php/?&id=' . $_SESSION['id'] );
                exit;
                            
            }
        } elseif(strlen($acesso) == 7){
            $cores = "Coordenação de Registro (CORES)";
            $ed = "Coordenação de Curso de Edificações"; 
            $ema = "Coordenação de Curso de Meio Ambiente";
            $ei = "Coordenação de Curso de Informática";

            $consulta = "SELECT * FROM coordenacao WHERE cod_siape = '$acesso' AND senha = '$senha'";
            $resultado = banco($server, $user, $password, $db, $consulta); 
                
            $quantidade = $resultado->num_rows;
                
            if($quantidade == 1){

                $projeto = $resultado->fetch_assoc();
                                
                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['id'] = $projeto['id'];
                $_SESSION['nome'] = $projeto['nome'];
                $coordenacao = $projeto['coordenacao'];

                if($coordenacao == $cores){
                    header ('Location: ../coordenacao/cores.php');
                    exit;
                }
                if($coordenacao  == $ei){
                    header ('Location: ../coordenacao/informatica.php');
                    exit;
                }
                            
            }
        } else {
            echo "Falha ao logar! Não existe alguém cadastrado com esses dados";
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
                Usuário: <input type="text" name="acesso" required><br>
                Senha: <input type="password" name="senha" required><br><br>
                <input type="submit" name="entrar" value="Entrar">
                <a href="busca.php" target> Esqueceu a senha? </a>
                <a href="suporte.php" target> Suporte </a>
                <a href="../discente/cadastro.php" target> Cadastre-se aluno </a>

    </form>
</body>
</html>