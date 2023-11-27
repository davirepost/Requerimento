<?php
    include("../login/protecao.php");
    include("../login/conexao.php");
    
    extract($_POST);
    if (!empty($_GET['idrequerimento'])){

        $id = $_GET['idrequerimento'];
        
        $consulta = "SELECT * FROM requerimento WHERE idrequerimento=$id";
        $resultado = banco($server, $user, $password, $db, $consulta);

        if ($resultado -> num_rows > 0){
            while ($dados = mysqli_fetch_assoc($resultado)){
                $docentes = $dados['docente'];
                $turma = $dados['turma'];
                $data_inicial = $dados['data_inicial'];
                $data_final = $dados['data_final'];
                $objeto = $dados['objeto'];
                $obs = $dados['obs'];
                $file = $dados['anexos'];
                $matricula = $dados['discente_matricula'];
                $consulta_discente = "SELECT * FROM discente WHERE matricula = '$matricula'";
                $resultado_discente = banco($server, $user, $password, $db, $consulta_discente);

                if ($resultado_discente->num_rows > 0) {
                    // Extrair os dados do discente de uma vez
                    $dados_discente = mysqli_fetch_assoc($resultado_discente);
                
                    // Agora, você pode acessar os campos desejados diretamente do array
                    $nome = $dados_discente['nome_aluno'];
                    $end = $dados_discente['endereco'];
                    $email = $dados_discente['email'];
                    $matricula_discente = $dados_discente['matricula'];
                }



            }
        }
    }
    if (isset($voltar)){
        header('location: cores.php');
        exit;
    }

    if (isset($aprovado)){
        $stat = 'Enviado para o coordenador';
        $consulta = "UPDATE requerimento SET `status` = '$stat' WHERE idrequerimento = $id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        header('location: cores.php');
        exit;
    }

    if (isset($recusado)){
        $stat = 'Recusado';
        $consulta = "UPDATE requerimento SET `status` = '$stat' WHERE idrequerimento = $id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        header('location: cores.php');
        exit;
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
        <div id="requerimento">
            <h1> Requerimento</h1>
            <label>Nome Completo:</label>
            <input type="text" name="nome" value='<?php echo $nome;?>' readonly>

            <label>Endereço: </label>
            <input type="text" name="end" value='<?php echo $end;?>' readonly>

            <label>Email:</label>
            <input type="text" name="email" value=<?php echo $email;?> readonly>

            <label>Docentes envolvidos:</label>
            <input type="text" name="docentes" value=<?php echo $docentes?> readonly>
            

            <label>Curso:</label>
            <?php
                
                $consulta = "SELECT idcurso, nome_curso FROM curso"; // Alteração do nome do campo
                $resultado = banco("localhost", "root", "", "projeto", $consulta);

                echo "<select name='curso' value=<?php echo $nome;?> readonly>";
                while ($linha = $resultado->fetch_assoc()) {
                    echo "<option value=" . $linha["idcurso"] . ">" . $linha["nome_curso"] . "</option>"; // Alteração do nome do campo
                }
                echo "</select>";

            ?>

            <label>Turma:</label>
            <input type="text" name='turma' value=<?php echo $turma;?> readonly>

            <label>Matrícula:</label>
            <input type="text" name="matricula" value=<?php echo $matricula;?> readonly>
            
            <label>Data Inicial:</label>
            <input type="date" name = data_inicial value=<?php echo $data_inicial;?> readonly>

            <label>Data Final:</label>
            <input type="date" name = data_final value=<?php echo $data_final;?> readonly>

            <label>Objetivo:</label>
            <select name="objeto" readonly>
            <option value="Justificativa de Falta" <?php echo ($objeto == 'Justificativa de Falta') ? 'selected' : ''; ?>>Justificativa de Falta</option>
            <option value="2° segunda chamada" <?php echo ($objeto == '2° segunda chamada') ? 'selected' : ''; ?>>2° segunda chamada</option>
            <option value="2° segunda chamada e Justificativa de Falta" <?php echo ($objeto == '2° segunda chamada e Justificativa de Falta') ? 'selected' : ''; ?>>2° segunda chamada e Justificativa de Falta</option>
            </select>

            <label>Observação:</label>
            <textarea name="obs" rows="5" readonly><?php echo $obs;?></textarea>

            <?php echo "Anexo: <a href='visualizar_pdf.php?id=$id'>Arquivo PDF</a>";?>
            </div>
            <input type="submit" value="Imprimir" name='imprimir' id="btn_imp" >
            <input type="submit" value="Voltar" name='voltar'>
            <script src="java.js"></script>
            <input type="submit" value="Aprovar" name='aprovado'>
            <input type="submit" value="Recusar" name='recusado'>
    </form>

</body>
</html>