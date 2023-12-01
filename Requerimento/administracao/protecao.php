<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Página</title>
    <link rel="stylesheet" href="protecao_adm.css">
</head>

<body>
    <?php 
        if(!isset($_SESSION)){
            session_start();
        }   

        if (!isset($_SESSION['id'])){
            echo '<div class="error-message-container">';
            echo '<div class="error-message">';
            echo 'Você não pode acessar esta página, primeiro faça o seu login!';
            echo '<img src="https://i.imgur.com/92iNc1a.png" alt="Background Image" class="background-image">';
            echo '<p><a href="login_administrador.php">Voltar para a página de login</a></p>';
            echo '</div>';
            echo '</div>';
            die();
        }
    ?>
</body>

</html>