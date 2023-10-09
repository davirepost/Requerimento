<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="cadastrodis.css">
    <title>Cadastro</title>
     <!-- Jennifer -->
    <!-- Esse código faz o cadastro de discentes -->
</head>
<body>

<form  action ="cadastro.php" method="post"><br>
     
        Nome: <input type="text" name='nome'><br>
        Matrícula:<input type="int" name='mat'><br>
        Endereço: <input type="text" name='end'><br>
        Senha:<input type="text" name='senha'><br>
        Confirme sua senha:<input type="text" name='senha2'><br>
        
        

        <input type="submit" name='salvar' value='Salvar'>
    

        </form> 


        <?php 
        include "dll.php";
        include "constantes.php";
        




        extract($_POST); 
        if (isset($salvar)){

            if(strlen($mat) > 12){
                echo 'Matricula invalida.';
            }

            if ($senha!=$senha2){

                echo 'As senhas estão diferentes. Digite novamente!';
            }
             
            $matricula= $mat;
            $matricula.= "@ifba.edu.br";
       
            $consulta= "INSERT INTO `discente`(`matricula`, `email`, `senha`, `nome_aluno`, `endereco`) VALUES ($mat,'$matricula','$senha','$nome','$end')";
            banco($server, $user, $password, $db, $consulta);
            header ('Location: permitido.php');
            exit;

      

        }

        ?>




    
</body>
</html>
