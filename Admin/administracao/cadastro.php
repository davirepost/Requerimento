<!-- Cadastrará o usuario no código sua conta -->

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
<form action="" method="post">
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
    <option value="Coordenação de Registro (CORES) ">Coordenação de Registro (CORES) </option>
    <option value="Coordenação de Curso de Meio Ambiente">Coordenação de Curso de Meio Ambiente</option>
    <option value="Coordenação de Curso de Informática">Coordenação de Curso de Informática</option>
    <option value="Coordenação de Curso de Edificações">Coordenação de Curso de Edificações</option>
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

    <input type="submit" name='botao' value='Voltar a página anterior'> <br>
    <input type="submit" name='cadastro' value='Efetuar cadastro'> <br>
    <?php //Guilherme
        // Inclui o arquivo de conexão com o banco de dados
        include('../login/conexao.php');
        // Extrai as variáveis enviadas pelo formulário usando o método POST
        extract($_POST);

        // Verifica se o botão 'cadastro' foi pressionado
        if (isset($cadastro)){
            
            if (empty($nome) || empty($siape) || empty($coordenacao) || empty($senha) || empty($senha2)) {
                echo 'Preencha todos os campos!';
            }if ($senha == $senha2 and $senha != null){
                    if(strlen($siape) == 7){
                        $email = $siape."@ifba.edu.br";
                        // Monta a consulta SQL para inserir os dados na tabela 'coordenação'
                        $sql_code = "INSERT INTO coordenacao(nome, cod_siape, email, coordenacao, senha)
                                    VALUES('$nome', '$siape', '$email', '$coordenacao', '$senha')";
                        banco($server, $user, $password, $db, $sql_code);
                        exit; 
                        echo "Cadastrado com sucesso!"; 
                    }else{
                        echo "Codigo siape indefinido(numero excedeu o seu limite ou não foi encontrado)!";
                    }
            }if($senha != $senha2){
                echo "Opa! Suas senhas não coincidem, tente novamente.";
            }
    }
    if (isset($botao)) {
        header("location: pagina_adm.php");
    }
    ?>
    </form>
    </body>
    </html>