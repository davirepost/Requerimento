<?php
    include ('../login/conexao.php');

    if (isset($alterar)) {
        $cod_siape = $cod_siape;
        $nome = $nome;
        $email = $email;
        $senha = $senha;
        $coordenacao = $coordenacao;
        // Atualize os valores no banco de dados
        $consulta = "UPDATE coordenacao SET cod_siape='$cod_siape', nome='$nome', email='$email', senha='$senha', coordenacao='$coordenacao' WHERE id = $id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        
    }
    header('Location: lista.php');
?>