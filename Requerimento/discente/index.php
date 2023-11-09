<?php 

    include('../login/conexao.php');

    extract($_POST);

    $nome_arquivo = '';
        
    if(isset($acao)){


        if (!file_exists('anexos')) {
            mkdir('anexos', 0777, true);
        
         // Verifica se o arquivo foi enviado corretamente
         if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
            $arquivo = $_FILES['file'];

            // Verifica a extensão do arquivo
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            if($extensao != 'pdf'){
                die('Não é possível fazer upload desse formato de arquivo');
            }

            // Move o arquivo para o local desejado
            $nome_arquivo = 'anexos/' . $arquivo['name'];
            move_uploaded_file($arquivo['tmp_name'], $nome_arquivo);
        } else {
            // Não foi enviado um arquivo, defina $nome_arquivo como vazio ou null, dependendo do seu banco de dados
            $nome_arquivo = ''; // Ou null, dependendo do seu banco de dados
        }
        }
        date_default_timezone_set("America/Sao_Paulo");
        $data_inicial = date('d / m / y g:i:s');

        $data_registro = $data_inicial;

        $status = 'Em Verificação';

        $consulta = "INSERT INTO requerimento(objeto, data_inicial, `data/hora_regis`, obs, anexos, status, turma, discente_matricula, idcurso, campus, email) VALUES ('$objeto','$data_inicial','$data_registro','$obs','$nome_arquivo','$status','$turma','$matricula','$curso','$campus','$email')";

        banco($server, $user, $password, $db, $consulta);
        header('location: index.php');
        echo "Cadastrado com sucesso";
        exit; 

    }if (isset($sair)){
        session_destroy();
        header('location: ../login/index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 20mm;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        #docentes-container {
            margin-top: 10px;
        }

        #docentes-container input {
            width: 50%;
            display: inline-block;
        }

        button {
            margin-top: 10px;
        }

        select {
            width: 100%;
        }

        textarea {
            width: 100%;
        }
    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Nome Completo:</label>
        <input type="text" name="nome">

        <label>Endereço (Rua, Praça, Avenida):</label>
        <input type="text" name="endereco">

        <label>Número:</label>
        <input type="text" name="number">

        <label>Bairro:</label>
        <input type="text" name="bairro">

        <label>Email:</label>
        <input type="text" name="email">

        <div id="docentes-container">
            <label>Docentes envolvidos:</label>
            <input type="text" name="docentes[]">
        </div>
        <button type="button" onclick="adicionarCampo()">Adicionar Docente</button>

        <label>Curso:</label>
        <?php
            
            $consulta = "SELECT idcurso, nome_curso FROM curso"; // Alteração do nome do campo
            $resultado = banco("localhost", "root", "", "projeto", $consulta);

            echo "<select name='curso'>";
            while ($linha = $resultado->fetch_assoc()) {
                echo "<option value=" . $linha["idcurso"] . ">" . $linha["nome_curso"] . "</option>"; // Alteração do nome do campo
            }
            echo "</select>";

        ?>

        <label>Turma:</label>
       <input type="text" name='turma'>

        <label>Matrícula:</label>
        <input type="text" name="matricula">

        <label>Campus:</label>
        <input type="text" name="campus">

        <label>Objetivo:</label>
        <select name="objeto">
            <option value="Justificativa de Falta"> Justificativa de Falta</option>
            <option value="2° segunda chamada"> 2° segunda chamada</option>
        </select>

        <label>Observação:</label>
        <textarea name="obs" rows="5"></textarea>
        <input type= "file" name="file"/> 
        <input type="submit" value="enviar" name='acao'>
        <input type="submit" name='sair' value='Sair'>
    </form>

    <script>
        function adicionarCampo() {
            var container = document.getElementById("docentes-container");
            var input = document.createElement("input");
            input.type = "text";
            input.name = "docentes[]";
            container.appendChild(document.createElement("br"));
            container.appendChild(input);
        }
    </script>
</body>
</html>