<?php
    include ('../login/conexao.php');
    extract($_POST);
    if (isset($alterar)) {
       
        
        $nome = $nome;
        $senha = $senha;
        $coordenacao = $coordenacao;
        // Atualize os valores no banco de dados
        $consulta = "UPDATE coordenacao SET  nome='$nome', senha='$senha', coordenacao='$coordenacao' WHERE id = $id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        
    }
    header('Location: lista.php');
?>
