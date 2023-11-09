<?php
    if (!empty($_GET['id'])) {
    include('../login/conexao.php');

    // Validar o ID
    $id = intval($_GET['id']); // Converte para um número inteiro

    if ($id > 0) {
        $sqlSelect = "SELECT * FROM coordenacao WHERE id = $id";
        $result = banco($server, $user, $password, $db, $sqlSelect);

        if ($result->num_rows > 0) {
            $sqlDelete = "DELETE FROM coordenacao WHERE id = $id";

            // Executar a consulta de exclusão
            $resultDelete = banco($server, $user, $password, $db, $sqlDelete);

            if ($resultDelete) {
                // Registro excluído com sucesso
                header('Location: lista.php');
                exit;
            } else {
                // Tratamento de erro - a exclusão falhou
                echo "Erro ao excluir o registro.";
            }
        } else {
            // O registro com o ID especificado não existe
            echo "Registro não encontrado.";
        }
    } else {
        // ID inválido
        echo "ID inválido.";
    }
} else {
    // ID não foi fornecido na URL
    echo "ID não especificado.";
}
?>
