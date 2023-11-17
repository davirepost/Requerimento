<?php 
    include('../login/protecao.php');
    include('../login/conexao.php');    

    extract($_POST);

    $nome_arquivo = '';
    
    $id = $_GET['id'];

    $consulta = "SELECT * FROM discente WHERE id = '$id'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    if($resultado->num_rows > 0){
        while($user_data = mysqli_fetch_assoc($resultado))
        {
            $nome1 = $user_data['nome_aluno'];
            $matricula1 = $user_data['matricula'];
            $email1 = $user_data['email'];  
        }
    }

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
        $endereco = $end . ', ' . $bairro . ', ' . $cidade . ' - ' . $uf; 
        $consulta = "SELECT endereco FROM discente WHERE matricula = '$matricula'";
        $resultado = banco($server, $user, $password, $db, $consulta);
        if ($resultado != $endereco){
            $consulta = "UPDATE discente SET endereco = '$endereco' WHERE matricula = '$matricula'";
            $resultado = banco($server, $user, $password, $db, $consulta);
        }
        date_default_timezone_set("America/Sao_Paulo");
        $data_registro = date('y/m/d G:i:s');

        $status = 'Em Verificação';

        $consulta = "INSERT INTO requerimento(objeto, data_inicial, `data/hora_regis`, obs, anexos, `status`, turma, discente_matricula, idcurso, email) VALUES ('$objeto','$data_inicial','$data_registro','$obs','$nome_arquivo','$status','$turma','$matricula','$curso','$email')";

        banco($server, $user, $password, $db, $consulta);   
        echo '<script>';
        echo 'if(confirm("Deseja fazer um novo requerimento?")) {';
        echo '   window.location.href = window.location.href;';
        echo '} else {';
        echo '   window.location.href = "../visualizar.php";'; // Substitua pela página inicial desejada
        echo '}';
        echo '</script>';
        echo 'confirmacao()';
        echo '<a href="visualizar.php?id=' . $id . '">Visualizar Dados</a>';
    }
?>


</html>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Documento</title>
        <script>

            function confirmacao() {
            var resposta = confirm("Deseja fazer um novo requerimento?");
            if (resposta) {
                // Usuário escolheu "Sim"
                window.location.href = window.location.href; // Recarrega a página
            } else {
                // Usuário escolheu "Não"
                window.location.href = '../pagina-inicial.php'; // Substitua pela página inicial desejada
            }
        }
            function buscarEndereco() {
                var cep = document.getElementById('cep').value;
                var url = 'https://viacep.com.br/ws/' + cep + '/json/';

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('end').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('uf').value = data.uf;
                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            }

        </script>
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
        <h1> Requerimento</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Nome Completo:</label>
            <input type="text" name="nome" value=<?php echo $nome1;?>>

            <label> CEP (opcional): </label> 
            <input type="text" name="cep" id="cep" onchange="buscarEndereco()">

            <label>Endereço: </label>
            <input type="text" name="end" id="end" required>

            <label>Bairro:</label>
            <input type="text" name="bairro" id="bairro" required>

            <label>Cidade:</label>
            <input type="text" name="cidade" id="cidade" required>

            <label> UF: </label>
            <input type="text" name="uf" id="uf" required> 

            <label>Email:</label>
            <input type="text" name="email" value=<?php echo $email1;?>>

            <label>Docentes envolvidos:</label>
            <input type="text" name="docentes" required>
            

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
            <input type="text" name="matricula" value=<?php echo $matricula1;?> required>
            
            <label>Data Inicial:</label>
            <input type="date" name = data_inicial required>

            <label>Data Final:</label>
            <input type="date" name = data_final required>

            <label>Objetivo:</label>
            <select name="objeto">
                <option value="Justificativa de Falta"> Justificativa de Falta</option>
                <option value="2° segunda chamada"> 2° segunda chamada</option>
                <option value="2° segunda chamada e Justificativa de Falta"> 2° segunda chamada e Justificativa de Falta</option>
            </select>

            <label>Observação:</label>
            <textarea name="obs" rows="5"></textarea>
            <input type= "file" name="file"/> 
            <input type="submit" value="enviar" name='acao' >
            <a href="pagina_inicial.php" >Voltar</a>
        </form>

</body>
</html>