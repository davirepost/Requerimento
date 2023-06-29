<!DOCTYPE html> //DANIEL
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div>
    <div>
        <h1>Cadastrar</h1>
    </div>
    <form method="post">
        
        
        <label>Qual setor de ensino pertence?</label><br>
        <select name="curso" >
            <option value="1" selected> ---------- </option>

            <option value="C.I Técnico em Edificações">C.I Técnico em Edificações</option>
            <option value="C.I Técnico em Informática">C.I Técnico em Informática</option>
            <option value="C.I Técnico em Meio Ambiente">C.I Técnico em Meio Ambiente</option>

            <option value="C.S Técnico em Meio Ambiente">C.S Técnico em Meio Ambiente</option>
            <option value="C.S Técnico em Segurança do Trabalho">C.S Técnico em Segurança do Trabalho</option>
            <option value="C.S Técnico em Enfermagem">C.S Técnico em Enfermagem</option>

            <option value="E.S Engenharia Civil">E.S Engenharia Civil</option>
            <option value="E.S Licenciatura em Matemática">E.S Licenciatura em Matemática</option>
            <option value="E.S Analise e Desenvolvimento de Sistemas ADS">E.S Analise e Desenvolvimento de Sistemas ADS</option>

        </select><p></p>

        <label >Nome:</label><br>
        <input type="text" name="nome"><p></p>

        <label >email:</label><br>
        <input type="text" name="email"><p></p>

        <label>Telefone:</label><br>
        <input type="tel" name="tel"><p></p>

        <label>Senha:</label><br>
        <input type="password" name="senha"><p></p>
        <label >endereço</label><br>
        <input type="text" name="end"><p></p>

        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="cancelar" name="cancelar">

    </form>

</div>

<?php
include('conexao.php');

extract($_POST);
echo $enviar;
if(isset($enviar)){
    $sql = "INSERT INTO coordenacao (cod_siape, nome, curso, telefone, email, endereco, senha) VALUES (NULL, '$nome', '$curso', '$tel', '$email', '$end', '$senha')";
    echo "<script>alert('Funcionou!!!')</script>";
    if ($mysqli->query($sql) === TRUE) {
        echo "<script>alert('cadastrado com sucesso')</script>";
        header('location: login.php');

      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
}

if(isset($cancelar)){
    header('location: login.php');
}
  ?>

</body>
</html>
