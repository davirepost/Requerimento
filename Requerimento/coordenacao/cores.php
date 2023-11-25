<?php
include("../login/protecao.php");
include("../login/conexao.php");

if (!empty($buscar)) {
    $pesquisar = $buscar;
    $consulta = "SELECT r.*, c.nome_curso 
                 FROM requerimento r 
                 INNER JOIN curso c ON r.idcurso = c.idcurso 
                 WHERE r.discente_matricula LIKE ? 
                 ORDER BY r.idrequerimento DESC";

    $stmt = $mysqli->prepare($consulta);
    $stmt->bind_param("s", $pesquisar);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $consulta = "SELECT r.*, c.nome_curso 
                 FROM requerimento r 
                 INNER JOIN curso c ON r.idcurso = c.idcurso 
                 ORDER BY r.discente_matricula DESC";
    $resultado = banco($server, $user, $password, $db, $consulta);
}

if (isset($sair)) {
    session_destroy();
    header('location: ../login/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="buscar" placeholder="Pesquisar por matricula" id="pesquisar">
        <button type='submit'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    <table border="1">
    <tr>
        <th> ID:</th>
        <th> NOME:</th>
        <th> CURSO:</th>
        <th> MATRICULA:</th>
        <th> ANEXO:</th>
        <th> ARQUIVO:</th>
    </tr>
        <?php
        
        while ($requerimento = mysqli_fetch_assoc($resultado)) {
            $matricula = $requerimento['discente_matricula'];
            $consulta_nome = "SELECT nome_aluno FROM discente WHERE matricula = '$matricula'";
            $resultado_nome = banco($server, $user, $password, $db, $consulta_nome);
            $nome = mysqli_fetch_assoc($resultado_nome)['nome_aluno'];
            echo '<tr>';
            echo '<td>ID: ' . $requerimento['idrequerimento'] . '</td>';
            echo '<td>Nome: ' . $nome . '</td>'; // Substitua pelo nome correto da coluna na tabela discente
            echo '<td>Curso: ' . $requerimento['nome_curso'] . '</td>';
            echo '<td>Matricula: ' . $requerimento['discente_matricula'] . '</td>';
            echo '<td>Anexo: ' . $requerimento['anexos'] . '</td>';
            echo " <td>
            <a href='cores_arquivo.php?idrequerimento=$requerimento[idrequerimento]' target>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-archive' viewBox='0 0 16 16'>
            <path d='M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z'/>
            </svg>
            </td>";
            echo '</tr>';
        }
        ?>
    </table>
    </form>
</body>
</html>
