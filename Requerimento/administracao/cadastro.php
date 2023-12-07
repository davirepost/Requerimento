<!-- Cadastrará o usuario no código sua conta -->
<?php include('../login/protecao.php'); ?>
<?php //Guilherme
        // Inclui o arquivo de conexão com o banco de dados
        include('../login/conexao.php');
        // Extrai as variáveis enviadas pelo formulário usando o método POST

        extract($_POST);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($cadastro)){

            if(empty(trim($nome)) || empty($siape) || empty($senha) || empty($senha2)){
                echo "Alguns campos não foram preenchidos! Por favor, verifique. <br>";
            }   
            if ($senha == $senha2 && $senha != null && $senha2 != null){
                    if(strlen($siape) == 7){
                        $senha = password_hash($senha, PASSWORD_DEFAULT); 
                        $numero = 3;
                        $identificador = bin2hex(random_bytes($numero));
                        $email = $siape."@ifba.edu.br";
                        // Monta a consulta SQL para inserir os dados na tabela 'coordenação'
                        $sql_code = "INSERT INTO coordenacao(nome, cod_siape, email, coordenacao, senha, identificador)
                                    VALUES('$nome', '$siape', '$email', '$coordenacao', '$senha', '$identificador')";
                        banco($server, $user, $password, $db, $sql_code);
                        echo "Cadastro realizado com sucesso!";

                    }else{
                        echo "Codigo siap invalido! Digite os 7 números corretamente. <br>";
                    } 
            }else{
                echo "Opa! As senhas não coincidem! Por favor, digite uma senha valida. <br>";
            }
            
        }
        if(isset($voltar)){
            header("Location: pagina_adm.php"); 
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="cadastroadm.css">
<title>Cadastro</title>
</head>
<body>
<H1>Cadastre-se</H1>
<form action="" method="post" autocomplete="off">
    <!-- Formulário de cadastro -->
    <p>
        <label for="">Digite seu nome: </label> 
        <input type="text" name="nome"><br>
    </p>

    <p>
        <label for="">Digite seu SIAPE: </label>
        <input type="number" name="siape"><br>
    </p>

    <p>
    <label for="">Digite a sua Coodernação: </label>
    <select name="coordenacao">
    <option value="0">Coordenação de Registro (CORES) </option>
    <option value="1">Coordenação de Curso de Meio Ambiente</option>
    <option value="2">Coordenação de Curso de Informática</option>
    <option value="3">Coordenação de Curso de Edificações</option>
    </select>
    </p>

    <p>
        <label for="">Digite sua senha: </label> 
        <input type="password" name="senha"><br>
    </p>

    <p>
        <label for="">Confirme sua senha: </label> 
        <input type="password" name="senha2"><br>
    </p>

    <input type="submit" name='cadastro' value='Efetuar cadastro'> <br>
    <input type="submit" name='voltar' value='Voltar a página anterior'> <br>

    </form>
    </body>
    </html>