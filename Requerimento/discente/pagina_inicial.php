<?php
    include('../login/protecao.php');
    include('../login/conexao.php');    

    extract($_POST);

    if(isset($_FILES))
    
    if(isset($requerimento)){
        header('location: index.php?&id=' . $_SESSION['id']);
    }
    if(isset($visualizar)){
        header('location: visualizar.php?&id=' . $_SESSION['id']);
        
    }
    if(isset($sair)){
        session_destroy();
        header('location: ../login/index.php');
        
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/discente.css">
    <script src="../js/funcoes.js"></script>
    <title>Document</title>
    
</head>
<body>
    <div id="addPhotoIcon" onclick="openFileExplorer()">
        <img src="icone_camera.png" alt="Adicionar Foto">
    </div>

    <form action="" method="post">
    <input type="submit" value="Fazer um novo requerimento" name="requerimento">
    <input type="submit" value="Visualizar requerimentos" name="visualizar">
    <input type="submit" value="Desconectar-se" name="sair">
    <input type="file" id="fileInput" style="display:none;">
    </form>
</body>
</html>