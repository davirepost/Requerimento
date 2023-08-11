<?php //Guilherme
$hostname = "localhost";
$bancodedados = "login";
$usuario = "root";
$senha = "";

//Conectando o banco de dados.
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

//Verificando se pode haver algum erro.
if ($mysqli -> connect_errno){
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ")" . $mysqli -> connect_error;
}
?>
