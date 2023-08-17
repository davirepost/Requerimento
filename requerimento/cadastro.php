<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
     <!-- Jennifer -->
</head>
<body>

<form  action ="cadastro.php" method="post"><br>
        Nome: <input type="text" name='nome'><br>
        E-mail: <input type="text" name='email'><br>
        Turma: <input type="text" name='turma'><br>
        Matrícula:<input type="int" name='mat'><br>
        Senha:<input type="text" name='senha'><br>

        <input type="submit" name='salvar' value='Salvar'>
    

        </form> 


        <?php 
        include "dll.php";
        include "constantes.php";
        




        extract($_POST); 
        if (isset($salvar)){

       
            $consulta= "INSERT INTO `discente`(`matricula`, `email`, `senha`, `nome_aluno`, `turma`) VALUES ($mat,'$email','$senha','$nome','$turma')";
            banco($server, $user, $password, $db, $consulta);
            header ('Location: permitido.php');
            exit;

      

        }

        ?>




    
</body>
</html>