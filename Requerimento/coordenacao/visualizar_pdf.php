<?php
    include('../login/conexao.php');

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $consulta = "SELECT anexos FROM requerimento WHERE idrequerimento = $id";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if ($resultado->num_rows > 0) {
        $arquivo = $resultado->fetch_assoc();
        extract($arquivo);

        // Configurando o Content-Type como application/pdf para um PDF, você pode ajustar conforme necessário
        header("Content-Type: application/pdf");

        // Adicionando a declaração de Content-Disposition para exibir na URL
        header("Content-Disposition: inline; filename=\"$anexos\"");

        // Enviando o conteúdo do arquivo
        echo $anexos;
    } else {
        echo "Arquivo não encontrado.";
    }
?>
