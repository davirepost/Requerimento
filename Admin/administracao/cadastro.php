<!-- Cadastrará o usuario no código sua conta -->
<?php //Guilherme
        include ("protecao.php");
        // Inclui o arquivo de conexão com o banco de dados
        include('../login/conexao.php');
        // Extrai as variáveis enviadas pelo formulário usando o método POST
        extract($_POST);

        // Verifica se o botão 'cadastro' foi pressionado
        if (isset($cadastro)){
            
            if ($senha == $senha2 and $senha != null){

                    if(strlen($siape) == 7){
                        $cod = $siape;
                        $email = $cod."@ifba.edu.br";
                        $senha = password_hash($senha, PASSWORD_DEFAULT);
                        // Monta a consulta SQL para inserir os dados na tabela 'coordenação'
                        $consulta = "INSERT INTO coordenacao(nome, cod_siape, email, coordenacao, senha)
                                    VALUES('$nome', '$siape', '$email', '$coordenacao', '$senha')";
                        $resultado = banco($server, $user, $password, $db, $consulta);
                        exit; 

                        echo "Cadastrado com sucesso!"; 
                    }else{
                        echo "Codigo siape indefinido(numero excedeu o seu limite ou não foi encontrado)!";
                    }
            }if($senha != $senha2){
                echo "Opa! Suas senhas não coincidem, tente novamente.";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro</title>
</head>
<body>
<H1>Cadastre-se</H1>
<form action="" method="post" autocomplete="off">
    <!-- Formulário de cadastro -->
    <p>
        <label for="">Digite seu nome: </label> 
        <input type="text" name="nome" required><br>
    </p>

    <p>
        <label for="">Digite seu SIAPE: </label>
        <input type="number" name="siape" required><br>
    </p>

    <p>
    <label for="">Digite a sua Coodernação: </label>
    <select name="coordenacao" required>
    <option value="Coordenação de Registro (CORES) ">Coordenação de Registro (CORES) </option>
    <option value="Coordenação de Curso de Meio Ambiente">Coordenação de Curso de Meio Ambiente</option>
    <option value="Coordenação de Curso de Informática">Coordenação de Curso de Informática</option>
    <option value="Coordenação de Curso de Edificações">Coordenação de Curso de Edificações</option>
  </select>
    </p>

    <p>
        <label for="">Digite sua senha: </label> 
        <input type="password" name="senha" required><br>
    </p>

    <p>
        <label for="">Confirme sua senha: </label> 
        <input type="password" name="senha2" required><br>
    </p>

    <a href="pagina_adm.php">Voltar a página anterior</a> <br>
    <input type="submit" name='cadastro' value='Efetuar cadastro'> <br>
    </form>
    </body>
    </html>