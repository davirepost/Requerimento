<?php

    include('../login/conexao.php');
    include('../login/protecao.php');
    extract($_POST);

    if(!empty($buscar))
    {
        $pesquisar = $buscar;
        $consulta = "SELECT * FROM coordenacao WHERE nome LIKE '%$pesquisar%' ORDER BY id DESC";
        $resultado = banco($server, $user, $password, $db, $consulta);
    }
    else
    {
        $consulta = "SELECT * FROM coordenacao ORDER BY cod_siape DESC";
        $resultado = banco($server, $user, $password, $db, $consulta);
    }
    if (isset($voltar)){
        header('location: pagina_adm.php');
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>

    <form action="" method="post">

    <input type="text" name="buscar" placeholder="Pesquisar por nome" id="pesquisar">
        <button type = 'submit'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>

    <br><br>

    <table border="1">
        <tr>
            <th colspan = "8"> Lista de Usuários </th>
        </tr>

        <tr>
        <th> ID:</th>
        <th> CODIGO SIAP:</th>
        <th> NOME:</th>
        <th> EMAIL:</th>
        <th> SENHA:</th>
        <th> COORDENAÇÃO:</th>
        <th> Alterar</th>
        <th> Apagar</th>
        </tr>
        <?php
            while($user_data = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>".$user_data['id']."</td>";
                echo "<td>".$user_data['cod_siape']."</td>";
                echo "<td>".$user_data['nome']."</td>";
                echo "<td>".$user_data['email']."</td>";
                echo "<td>".$user_data['senha']."</td>";
                echo "<td>".$user_data['coordenacao']."</td>";
                echo "<td> 
                <a href='editar.php?id=$user_data[id]' target>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-fill' viewBox='0 0 16 16'>
                <path d='M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z'/>
                </svg>
                </a>
                </td>";
                echo "<td> 
                <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]' title='Deletar'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                </svg>
                </a>
                </td>";
                echo "<tr>";
                }
        ?>
    </table><br>
    <input type="submit" name="voltar" value="Voltar a página anterior">
    </form>
    <br>

</body>
</html>