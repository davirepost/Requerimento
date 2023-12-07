<?php
    include('../login/conexao.php');
    extract($_POST);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($salvar)) {
        if(strlen(strval($mat))){
        $email = $mat    . "@ifba.edu.br";
        $numero = 3;
        $identificador = bin2hex(random_bytes($numero));
        $endereco = $end . ', ' . $bairro . ', ' . $cidade . ' - ' . $uf;

        $para = $email;
        $assunto = "Verifique seu Email";
        $mensagem = "Seu código de verificação é: $identificador";
        $headers = "From: seu-email@example.com";

            if (mail($para, $assunto, $mensagem, $headers)) {
                $consulta = "INSERT INTO discente(matricula, email, nome_aluno, endereco, curso, identificador) VALUES ('$mat','$email','$nome','$endereco', '$curso', '$identificador')";
                banco($server, $user, $password, $db, $consulta);
                $matricula = $mat; 
                header('Location: verificar.php/?&matricula=' . $matricula);
                exit;
            }
        }else{
            echo "Número de matricula deve ser igual a 12, verifique se foi digitado corretamente";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css">
    <script src="../js/funcoes.js"></script>
    <title>Cadastro</title>
   

</head>
<body>

        <form action ="" method="post">

            <h1>Cadastre-se</h1>

            <label> Nome: </label> <br>
            <input type="text" name='nome' required><br>

            <label> Matrícula: </label> <br>
            <input type="text" name='mat' required><br>

            <label> CEP: </label> <br>
            <input type="text" name="cep" id="cep" onchange="buscarEndereco()"> <br>

            <label>Endereço: </label> <br>
            <input type="text" name="end" id="end" required> <br>

            <label>Bairro:</label> <br>
            <input type="text" name="bairro" id="bairro" required> <br>

            <label>Cidade:</label> <br>
            <input type="text" name="cidade" id="cidade" required> <br>

            <label> UF: </label> <br>
            <input type="text" name="uf" id="uf" required> <br>

            <label for=""> Escolha o seu curso:</label><br>
            <select name="curso">
            <option value="Informática"> Informática </option>
            <option value="Meio Ambiente"> Meio Ambiente </option>
            <option value="Edificações"> Edificações </option>
            </select> <br> <br>

            <input type="submit" name='salvar' value='Salvar Cadastro'> <br>
            
            <a href="../login/index.php"> Voltar a página de login</a>

        </form> 

</body>
</html>
