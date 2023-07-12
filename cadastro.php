<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

<form  action ="cadastro.php" method="post"><br>
        Nome: <input type="text" name='nome'><br>
        E-mail: <input type="text" name='email'><br>
        Turma: <input type="text" name='turma'><br>
        Curso: <input type="text" name='curso'><br>
        Matrícula:<input type="int" name='mat'><br>
        Telefone:<input type="int" name='tel'><br>
        Usuário:<input type="int" name='us'><br>
        Senha:<input type="text" name='senha'><br>

        <input type="submit" name='salvar' value='Salvar'>
    

        </form> 


        <?php 
        include "dll.php";
        include "constantes.php";
        




        extract($_POST); 
        if (isset($salvar)){

       
            $consulta= "INSERT INTO `cadastro`(`Nome`, `E-mail`, `Turma`, `Curso`, `Matricula`, `Telefone`, `Usuario`, `Senha`) VALUES ('$nome','$email','$turma','$curso',$mat,$tel,$us,'$senha')";
            banco($server, $user, $password, $db, $consulta);
            header ('Location: permitido.php');
            exit;

      

        }

        ?>




    
</body>
</html>