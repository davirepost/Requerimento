<?php 

    include('../login/conexao.php');
    extract($_POST); 

    if (isset($salvar)){

        if(strlen($mat) == 12 && $senha == $senha2 && $senha != null && $senha2 != null){
            $email= $mat;
            $email.= "@ifba.edu.br";
            $senha = password_hash($senha, PASSWORD_DEFAULT); 
            $numero = 7;
            $identificador = bin2hex(random_bytes($numero));
            $endereco = $end . ', ' . $bairro . ', ' . $cidade . ' - ' . $uf;
            $consulta = "INSERT INTO discente(matricula, email, senha, nome_aluno, endereco, identificador) VALUES ('$mat','$email','$senha','$nome','$endereco', '$identificador')";
            banco($server, $user, $password, $db, $consulta);
            header ('Location:../login/index.php');
            exit;
        }else{
            echo 'Erro ao cadastrar';
        }   
        if(strlen($mat) > 12){
            echo 'Matricula invalida.';
        }

        if ($senha!=$senha2){

            echo 'As senhas estão diferentes. Digite novamente!';
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

        <form action ="" method="post"><br>
     
        Nome: <input type="text" name='nome'><br>
        Matrícula:<input type="int" name='mat'><br>
        CEP: <input type="text" name="cep" id="cep" onchange="buscarEndereco()"> <br>
        Endereço: <input type="text" name="end" id="end"><br>
        Bairro: <input type="text" name="bairro" id="bairro"><br>
        Cidade: <input type="text" name="cidade" id="cidade"><br>
        UF: <input type="text" name="uf" id="uf"><br>
        Senha:<input type="text" name='senha'><br>
        Confirme sua senha:<input type="text" name='senha2'><br>
        
        

        <input type="submit" name='salvar' value='Salvar Cadastro'>
        <a href="../login/index.php"> Voltar a página de login</a>

        </form> 

</body>
</html>
