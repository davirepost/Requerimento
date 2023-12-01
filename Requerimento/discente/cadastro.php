<?php
    include('../login/conexao.php');
    extract($_POST);

    if (isset($salvar)) {
        if (strlen((string)$mat) == 12) {
            $consulta = "SELECT * FROM discente WHERE matricula = '$mat'";
            $resultado = banco($server, $user, $password, $db, $consulta);
            if (mysqli_num_rows($resultado) > 0) {
                echo "Já existe alguém cadastrado com esses dados!";
            }
                
            }else{
            $email = strval($mat) . "@ifba.edu.br";
            $numero = 3;
            $identificador = bin2hex(random_bytes($numero));
            $endereco = $end . ', ' . $bairro . ', ' . $cidade . ' - ' . $uf;

            $para = $email;
            $assunto = "Verifique seu Email";
            $mensagem = "Seu código de verificação é: $identificador";
            $headers = "De: seu-email@example.com";

            if (mail($para, $assunto, $mensagem, $headers)) {
                $consulta = "INSERT INTO discente(matricula, email, nome_aluno, endereco, curso, identificador) VALUES ('$mat','$email','$nome','$endereco', '$curso', '$identificador')";
                banco($server, $user, $password, $db, $consulta);
                $matricula = $mat; 
                header('Location: verificar.php/?&matricula=' . $matricula);
                exit;
            }
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="cadastrodis.css">
    <title>Cadastro</title>
    <script>
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

</head>
<body>

        <form action ="" method="post">
        
            <label> Nome: </label> <br>
            <input type="text" name='nome'><br>

            <label> Matrícula: </label> <br>
            <input type="text" name='mat'><br>

            <label> CEP: </label> <br>
            <input type="text" name="cep" id="cep" onchange="buscarEndereco()"> <br>

            <label>Endereço: </label> <br>
            <input type="text" name="end" id="end"> <br>

            <label>Bairro:</label> <br>
            <input type="text" name="bairro" id="bairro"> <br>

            <label>Cidade:</label> <br>
            <input type="text" name="cidade" id="cidade"> <br>

            <label> UF: </label> <br>
            <input type="text" name="uf" id="uf"> <br>

            <label for=""> Escolha o seu curso:</label><br>
            <select name="curso">
            <option value="Informática"> Informática </option>
            <option value="Meio Ambiente"> Meio Ambiente </option>
            <option value="Edificações"> Edificações </option>
            </select> <br> <br>

            <input type="submit" name='salvar' value='Salvar Cadastro'> <br>
            
            <a href="../login/index.php"> Voltar a página de login</a>

        </form> 

</body>
</html>
