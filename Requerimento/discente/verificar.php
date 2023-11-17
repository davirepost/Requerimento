<?php
    include('../login/conexao.php');
    extract($_POST);

    if (isset($verificar)) {
        if (empty($codigo) || empty($senha) || empty($senha2)) {
            echo "Código ou senhas não definidos! Certifique-se de preencher todos os campos.<br>";
        } elseif ($senha == $senha2) {
            if (strlen($senha) >= 11 && strlen($senha) <= 20) {
                $consulta = "SELECT * FROM discente WHERE identificador = '$codigo'";
                $resultado = banco($server, $user, $password, $db, $consulta);

                if (mysqli_num_rows($resultado) == 1) {
                    $matricula = $_GET['matricula'];
                    $numero = 3;
                    $identificador = bin2hex(random_bytes($numero));
                    $nova_senha = password_hash($senha, PASSWORD_DEFAULT);
                    $consulta = "UPDATE discente SET senha='$nova_senha', identificador = '$identificador' WHERE matricula ='$matricula'";
                    banco($server, $user, $password, $db, $consulta);
                    echo 'Cadastro realizado com sucesso! ' ;
                    header('location: ../login/index.php');
                    exit;
                } else {
                    echo "Identificador não encontrado, verifique se foi digitado corretamente";
                }
            } else {
                echo "Quantidade inválida de caracteres na senha. Deve ser maior que 10 e menor que 21.";
            }
        } else {
            echo "Você digitou as senhas de forma diferente, tente novamente!";
        }
    }

    if(isset($voltar)){
        header('location: login/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Email</title>
</head>
<body>
    <h1>Verificar Email</h1>
    <form action="" method="post">
        <label>Insira o código de verificação enviado pelo email institucional:</label><br>
        <input type="text" name="codigo"><br>

        <label for="">Digite sua senha: </label> 
        <input type="password" name="senha"><br>
        <label for="">Confirme sua senha: </label> 
        <input type="password" name="senha2"><br>

        <input type="submit" name="verificar" value="Verificar">
    </form>
</body>
</html>