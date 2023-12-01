
<?php
   include('../login/conexao.php');
   include('../login/protecao.php');

   extract($_POST);
   
    if (!empty($_GET['id'])){

        $id = $_GET['id'];
    
        $consulta = "SELECT * FROM coordenacao WHERE id=$id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        if($resultado -> num_rows > 0){
            while($user_data = mysqli_fetch_assoc($resultado))
            {
                $nome = $user_data['nome'];
                $siap = $user_data['cod_siape'];
                $coordenacao = $user_data['coordenacao'];
                $senha = $user_data['senha'];

            }
        }


    }
    if (isset($voltar)){
        header('location: lista.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <form action="salvaredit.php" method="post">

    <p>
        <label for="">Digite seu nome: </label> 
        <input type="text" name="nome" value='<?php echo $nome;?>'><br>
    </p>

    <p>
        <label for="">Digite seu SIAPE: </label>
        <input type="number" name="siap" value=<?php echo $siap;?>><br>
    </p>

    <p>
    <label for="">Digite a sua Coodernação: </label>
    <select name="coordenacao" value=<?php echo $coordenacao;?>>
    <option value="Coordenação de Registro (CORES) ">Coordenação de Registro (CORES) </option>
    <option value="Coordenação de Curso de Meio Ambiente">Coordenação de Curso de Meio Ambiente</option>
    <option value="Coordenação de Curso de Informática">Coordenação de Curso de Informática</option>
    <option value="Coordenação de Curso de Edificações">Coordenação de Curso de Edificações</option>
    </select>
    </p>

    <p>
        <label for="">Digite sua senha: </label> 
        <input type="password" name="senha" value=<?php echo $senha;?>><br>
    </p>

    <input type="submit" name="alterar" value="Efetuar alteração">
    <input type="submit" name="voltar" value="Voltar a página anterior">
    <input type="hidden" name="id" value=<?php echo $id;?>>
    </form>
</body>
</html>
