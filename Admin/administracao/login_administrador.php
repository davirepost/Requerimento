<?php
include('../login/conexao.php');

// Extrai as variáveis enviadas pelo formulário usando o método POST
extract($_POST);

if (isset($entrar)) {
    if (empty($cod_adm) || empty($senha)) {
        echo 'Preencha todos os campos! <br>';
    }
    if (strlen($cod_adm) == 11) {

        $consulta = "SELECT * FROM adm WHERE cod_adm = $cod_adm AND senha = '$senha'";
        $resultado = banco($server, $user, $password, $db, $consulta);

        $quantidade = $resultado->num_rows;

        if ($quantidade == 1) {

            $projeto = $resultado->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $projeto['id'];

            header('Location: pagina_adm.php');
            exit;
        } else {
            echo "Falha ao logar! Não existe alguém cadastrado com esses dados";
        }
    } else {
        echo "Cadastro do administrador não compatível! Verifique o usuário!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_administrador</title>
    <link rel="stylesheet" href="login_administrador.css">
</head>

<body>

    <form action="login_administrador.php" method='post' autocomplete="off">
        Usuário: <input type="text" name='cod_adm'><br>
        Senha:
        <div class="password-container">
            <input type="password" name="senha" id="passwordInput">
            <span class="toggle-password-icon" onclick="togglePasswordVisibility()">
                &#x1F512; <!-- Ícone de cadeado -->
            </span>
        </div>
        <input type="submit" name='entrar' value='Entrar'><br>
        <a href="busca.php" target> Esqueceu a senha?</a>
        <a href="suporte.php" target> Suporte </a>
    </form>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var icon = document.querySelector(".toggle-password-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.textContent = "🔓"; // Ícone de olho fechado
            } else {
                passwordInput.type = "password";
                icon.textContent = "🔒"; // Ícone de olho aberto
            }
        }
    </script>
</body>

</html>
