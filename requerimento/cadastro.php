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
        Matrícula:<input type="int" name='mat'><br>
        <!-- Retirar o Email -->
        E-mail: <input type="text" name='email'><br>  <!-- Retirar - Concatenar de forma automatica com @ifba.edu.br e enviar um amail para validar a conta -->
        Turma: <input type="text" name='turma'><br>
        Senha:<input type="text" name='senha'><br>
        <!-- Aba para Confirmar senha -->
        <!-- A senha digitada deve ser a mesma de senha -->

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
