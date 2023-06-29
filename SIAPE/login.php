
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    
    <div>

        <form method="post">
            <label for="">Usuario</label>
            <input type="text" name="cod" maxlength="7" >
            <label for="">Senha</label>
            <input type="password" name="senha" >
            <input type="submit" value="entrar"  name="entrar">
            <input type="submit" value="cadastrar" name="cadastrar">
        </form>

    </div>


<?php
include('conexao.php');
extract($_POST);
if(isset($entrar)) {
    if(strlen($cod)==0){
        echo 'digite o codigo de acesso!!';

    } elseif(strlen($senha)==0){
        echo 'digite a senha de acesso!!';

    } else{  
        $sql_code = "SELECT * FROM coordenacao WHERE cod_siape = $cod AND senha = $senha";
        $sql_query = $mysqli->query($sql_code) or die('falha em execultar o SQl' . $mysqli->error);

        $quant = $sql_query->num_rows;
        if($quant==1){
            header('location: siape.php'); }
        else{
            echo 'falha ao logar usuario ou senha incorreta';
        }

        }}

if(isset($cadastrar)){
    echo "ler";
    header('location: cadastro_de_adm.php');
}




 

?>
    
</body>
</html>