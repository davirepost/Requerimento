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
                $turma = $dados['turma'];
                $data_inicial = $dados['data_inicial'];
                $data_final = $dados['data_final'];
                $objeto = $dados['objeto'];
                $obs = $dados['obs'];
                $file = $dados['anexos'];
                $matricula = $dados['discente_matricula'];
                $consulta_dicente = "SELECT * FROM discente WHERE matricula = '$matricula'";
                $resultado_dicente = banco($server, $user, $password, $db, $consulta_dicente);

                if ($resultado_dicente->num_rows > 0) {
                    $dados_dicente = mysqli_fetch_assoc($resultado_dicente);
                    $nome = $dados_dicente['nome_aluno'];
                    $end = $dados_dicente['endereco'];
                    $email = $dados_dicente['email'];
                    $matricula_discente = $dados_dicente['matricula'];
                }

                $idrequerimento = $dados['idrequerimento'];
                $consulta_docentes = "SELECT * FROM docente WHERE idrequerimento = $idrequerimento";
                $resultado_docentes = banco($server, $user, $password, $db, $consulta_docentes);

                if ($resultado_docentes->num_rows > 0) {

                    $dados_docentes = mysqli_fetch_assoc($resultado_docentes);
                    $nome_docentes = $dados_docentes['nome'];
                    $email_docentes = $dados_docentes['email'];

                }


            }
        }
    }
    if (isset($voltar)){
        header('location: cores.php');
        exit;
    }

    if (isset($aprovado)){
        $stat = 'Deferido';
        $consulta = "UPDATE requerimento SET `status` = '$stat' WHERE idrequerimento = $id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        header('location: cores.php');
        exit;
    }

    if (isset($recusado)){
        $stat = 'Indeferido';
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
        <link rel="stylesheet" href="estilo/css/requerimento.css">
        <title>Documento</title>
    </head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
            <h1> Requerimento</h1>
            <label>Nome Completo:</label>
            <input type="text" name="nome" value='<?php echo $nome;?>' readonly>

            <label>Endereço: </label>
            <input type="text" name="end" value='<?php echo $end;?>' readonly>

            <label>Email:</label>
            <input type="text" name="email" value=<?php echo $email;?> readonly>

            <label>Docentes envolvidos:</label>
            <input type="text" name="docentes" value=<?php echo $nome_docentes?> readonly>
            
            <label>Docentes emails:</label>
            <input type="text" name="docentes" value=<?php echo $email_docentes?> readonly>

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

            <?php echo "Anexo: <a href='http://localhost/Requerimento/discente/$file' target='_blank'>Arquivo PDF</a>";?> 

            <input type="submit" value="Voltar" name='voltar'>
            <input type="submit" value="Aprovar" name='aprovado'>
            <input type="submit" value="Recusar" name='recusado'>
    </form>

</body>
</html>