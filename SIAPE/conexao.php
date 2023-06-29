<?php

$usuario = 'root';
$senha = '';
$database = 'adm';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario,$senha,$database);

if($mysqli -> error){
    die("erro ao tentar se conectar co o banco");
}

?>