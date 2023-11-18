<?php
    include("../login/protecao.php");
    include("../login/conexao.php");
    
    extract($_POST);
    if (!empty($_GET['idrequerimento'])){

        $id = $_GET['idrequerimento'];

        $consulta = "SELECT * FROM requerimento WHERE idrequerimento=$id";
        $resultado = banco($server, $user, $password, $db, $consulta);
        if($resultado -> num_rows > 0){
            while($requerimento = mysqli_fetch_assoc($resultado)){
                $matricula = $requerimento['discente_matricula'];
                $consulta_nome = "SELECT nome_aluno, endereco FROM discente WHERE matricula = '$matricula'";
                $resultado_nome = banco($server, $user, $password, $db, $consulta_nome);
                $nome = mysqli_fetch_assoc($resultado_nome)['nome_aluno'];

                $nome = $requerimento['nome'];
                $siap = $user_data['cod_siape'];
                $coordenacao = $user_data['coordenacao'];
                $senha = $user_data['senha'];

            }
        }


    }
    if (isset($voltar)){
        header('location: cores.php');
    }

?>
<<!DOCTYPE html>
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
        <h1> Requerimento</h1>
        <form action="" method="post" enctype="multipart/form-data">

            <label>Nome Completo:</label>
            <input type="text" name="nome" value=<?php echo $nome;?> readonly>

            <label>Endereço: </label>
            <input type="text" name="end" value=<?php echo $nome;?> readonly>

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
            <input type="text" name='turma' value=<?php echo $nome;?> readonly>

            <label>Matrícula:</label>
            <input type="text" name="matricula" value=<?php echo $matricula1;?> readonly>
            
            <label>Data Inicial:</label>
            <input type="date" name = data_inicial value=<?php echo $nome;?> readonly>

            <label>Data Final:</label>
            <input type="date" name = data_final value=<?php echo $nome;?> readonly>

            <label>Objetivo:</label>
            <select name="objeto" value=<?php echo $nome;?>readonly>
                <option value="Justificativa de Falta"> Justificativa de Falta</option>
                <option value="2° segunda chamada"> 2° segunda chamada</option>
                <option value="2° segunda chamada e Justificativa de Falta"> 2° segunda chamada e Justificativa de Falta</option>
            </select>

            <label>Observação:</label>
            <textarea name="obs" rows="5" value=<?php echo $nome;?> readonly></textarea>
            <input type= "file" name="file"/> 
            <input type="submit" value="Imprimir" name='imprimir' >
            <input type="submit" value="Voltar" name='voltar' >
        </form>

</body>
</html>