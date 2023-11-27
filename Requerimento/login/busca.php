<?php
include("conexao.php");
extract($_POST);

if (!empty($buscar)) {
    $pesquisar = trim($buscar); // Evita injeção de SQL
    $consulta = "SELECT * FROM coordenacao WHERE email = '$pesquisar'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    
    if (mysqli_num_rows($resultado) > 0) {
        // Se um caso idêntico foi encontrado no banco de dados
        $resultado = mysqli_fetch_assoc($resultado);
        echo "Email enviado para: " . $resultado['email'];
        
        // Obtenha o identificador da consulta anterior
        $identificador = $resultado['identificador'];

        $to      = "$pesquisar";
        $subject = "Testando verificação em duas etapas";
        $message = "Olá, segue o link para alterar a senha: ";
        $message .= "http://localhost/admin/login/alterar.php?";
        $message .= "identificador=$identificador"; 
        $headers = "From: webmaster@example.com" . "\r\n" .
        "Reply-To: webmaster@example.com";

        mail($to, $subject, $message, $headers);
    } else {
        echo "Nenhum email encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca do ADM</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">

    <input type="text" name="buscar" placeholder="Insira o seu email" id="pesquisar">
        <button type = 'submit'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>

    <br><br>

        <a href="suporte.php" target>Não consegue redifinir a sua senha?'</a> <br>
        <input type="submit" name="voltar" value="Voltar a tela de login">
    </form>

    <?php
        extract($_POST);
        if (isset($voltar)){
            header("location: index.php");
        }
    ?>
</body>
</html>