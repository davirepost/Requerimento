<!-- Essa pagina tem como o objetivo permitir que o administrador altere a sua senha caso o mesmo tenha esquecido -->
<?php 

    include("conexao.php");
    extract($_POST);
    if (isset($voltar)) {
        header("location: login.php");
    } else if (isset($alterar)) {
        if ($senha == $confirma_senha and strlen($senha) == 12) {
            // Consulta SQL corrigida: especifique uma condição para a atualização
            $consulta = "UPDATE coordenacao SET senha = '$confirma_senha' WHERE id = 1"; // Atualize o id conforme necessário

            // Execute a consulta usando sua função banco()
            $resultado = banco($server, $user, $password, $db, $consulta);

            if ($resultado) {
                echo "Senha alterada com sucesso!";
            } else {
                echo "Erro ao alterar a senha. Por favor, tente novamente.";
            }
        } else if ($senha != $confirma_senha) {
            echo "A sua nova senha não coincide! Por favor, verifique a sua senha e tente novamente.";
        } else if (strlen($senha) != 12) {
            echo "O número de dígitos deve ser igual a 12";
        }
    }
?>


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="alteraradm.css">
    <title>Alterar Senha do Administrador</title>
</head>
<body>  <!-- Guilherme -->
<H1>Altere a sua senha!</H1>
    <form action="" method="post" autocomplete="off">
 
        <label for="">Digite uma nova senha:</label> <br>
        <input type="password" name="senha"><br>
        <label for="">Confirme a nova senha:</label><br>
        <input type="password" name="confirma_senha"><br>
        <input type="submit" name='alterar' value='Alterar'> <br>
        <input type="submit" name='voltar' value='Voltar a página de login'> <br>
    </form>
</body>
</html>
