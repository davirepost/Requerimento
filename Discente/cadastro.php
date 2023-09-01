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

        <label for="curso">Curso:</label>
    <select id="" name="Curso">
        <option value="informatica">Informática</option>
        <option value="meioambiente">Meio Ambiente</option>
        <option value="edificacoes">Edificações</option>
    
    </select>

    <label for="turma">Turma:</label>
    <select id="" name="turma">
        <option value="ei-11">Ei-11</option>
        <option value="ei-12">Ei-12</option>
        <option value="ei-21">Ei-21</option>
        <option value="ei-22">Ei-22</option>
        <option value="ei-31">Ei-31</option>
        <option value="ei-32">Ei-32</option>
        <option value="ei-41">Ei-41</option> 
        <option value="ed-11">Ed-11</option>
        <option value="ed-12">Ed-12</option>
        <option value="ed-21">Ed-21</option>
        <option value="ed-22">Ed-22</option>
        <option value="ed-31">Ed-31</option>
        <option value="ed-32">Ei-32</option>
        <option value="ed-41">Ed-41</option>
        <option value="ema-11">Ema-11</option>
        <option value="ema-11">Ema-12</option>
        <option value="ema-21">Ema-21</option>
        <option value="ema-22">Ema-22</option>
        <option value="ema-31">Ema-31</option>
        <option value="ema-32">Ema-32</option>
        <option value="ema-41">Ema-41</option>

        
    
    </select>
        

        Telefone:<input type="text" name='telefone'><br>
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
       
            $consulta= "INSERT INTO `discente`(`matricula`, `email`, `senha`, `nome_aluno`, `endereco`, `telefone`) VALUES ($mat,'$matricula','$senha','$nome','$end','$telefone')";
            banco($server, $user, $password, $db, $consulta);
            header ('Location: permitido.php');
            exit;

      

        }

        ?>




    
</body>
</html>
