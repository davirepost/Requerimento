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
    $path = '';
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($acao)){

            if(isset($_FILES['file'])){
                $arquivo = $_FILES['file'];

                if($arquivo['size'] > 4194304){
                    die("Tamanho do arquivo não suportado! Tamanho max: 4MB");
                }

                $pasta = 'anexos/';
                $nomearquivo=  $arquivo['name'];
                $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

                if($extensao != 'pdf'){
                    die('Tipo de arquivo não aceito! Só é aceito arquivo pdf.');
                }

                $path = $pasta . $nomearquivo . "." . $extensao;

                $enviado = move_uploaded_file($arquivo['tmp_name'], $path);

                if($enviado){
                    echo "Arquivo enviado com sucesso! Para acessar <a href = 'anexos/$nomearquivo.$extensao'> </a>";
                }else{
                    echo "Falha ao enviar arquivo";
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
        $status = 'Em análise';

        $consulta_requerimento = "INSERT INTO requerimento(objeto, data_inicial, data_final, `data/hora_regis`, obs, anexos, `status`, turma, discente_matricula, idcurso, email) 
                     VALUES ('$objeto','$data_inicial','$data_final','$data_registro','$obs','$path','$status','$turma','$matricula','$curso','$email')";
        banco($server, $user, $password, $db, $consulta_requerimento);

        $id_requerimento = "SELECT MAX(idrequerimento) FROM requerimento";
        $resultado_id = banco($server, $user, $password, $db, $id_requerimento);
        $row = mysqli_fetch_assoc($resultado_id);
        $ultimo_id = $row['MAX(idrequerimento)'];
        
        $dnt = $docente_nome . "," . $docentes_nomes;
        $det = $docente_email . "," . $docentes_emails;

        $consulta_docente = "INSERT INTO `docente`(`email`, `nome`, `idrequerimento`) VALUES ( '$dnt', '$det', '$ultimo_id')";
        banco($server, $user, $password, $db, $consulta_docente,);

        echo "Requerimento enviado com sucesso!";
            
    }
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/requerimento.css">
        <script src="../js/funcoes.js"></script>
        <title>Documento</title>

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

            <label>Curso:</label>
            <?php

                $consultaCurso = "SELECT idcurso, nome_curso FROM curso";
                $resultadoCurso = banco("localhost", "root", "", "projeto", $consultaCurso);

                echo "<select name='curso'>";
                while ($linhaCurso = $resultadoCurso->fetch_assoc()) {
                    echo "<option value=" . $linhaCurso["idcurso"] . ">" . $linhaCurso["nome_curso"] . "</option>";
                }
                echo "</select>";
            ?>

            <label>Turma:</label>
            <?php 
                $consultaTurma = "SELECT id_curso, nometurma FROM turma INNER JOIN curso ON idcurso WHERE id_curso = idcurso"; 
                $resultadoTurma = banco("localhost", "root", "", "projeto", $consultaTurma);

                echo "<select name='turma'>";
                while ($linhaTurma = $resultadoTurma->fetch_assoc()) {
                    echo "<option value=" . $linhaTurma["nometurma"] . ">" . $linhaTurma["nometurma"] . "</option>";
                }
                echo "</select>";
            ?>

            <label>Matrícula:</label>
            <input type="text" name="matricula" value=<?php echo $matricula1;?> required>

            <label>Nome do docente: </label>
            <input type="text" name="docente_nome" required>
            
            <label>Adicionar mais docentes: </label>
            <textarea name="docentes_nomes" rows="5"></textarea>
            
            <label>Email do docente: </label>
            <input type="text" name="docente_email" required>
            
            <label>Adicionar emails aos docentes: </label>
            <textarea name="docentes_emails" rows="5"></textarea>

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
            <input type="submit" value="Prosseguir" name='acao' >
            <a href="pagina_inicial.php">Voltar</a>
        </form>
</body>
</html>