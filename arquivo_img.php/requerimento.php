<!DOCTYPE html>
<html lang="en">
<body>

    <?php
        //Conecção com banco, para salvar a imagem no banco.





        if (isset($_POST['acao'])){
           //Pegando qual a extenção do arquivo.
            $arquivo=$_FILES['file'];

            if (isset($_FILES['file']));
        
            //separação do arquivo
            $arquivo_novo= explode('.', $arquivo['name']);
            
            //strtolower converte tudo para minusculo. EX: JPg--> jpg
            if($arquivo_novo[sizeof($arquivo_novo)-1]!= 'jpg'){
                die('Não é possivel fazer upload desse formato de arquivo');

            }else{
                echo('Upload de foto feito com sucesso!!');
                move_uploaded_file($arquivo['tmp_name'], 'uploads'.$arquivo['name']);
            }
                   
            }
           
               // $sql_code= "INSER INTO requerimento (idrequerimento, objeto, data_inicial, data_final, data/hora_regis, obs, anexos, status, turma, discente_matricula, idcurso) values ('$idrequerimento', '$objeto', '$data_inicial', '$data_final', '$data/hora_regis', '$obs', '$anexos', '$status', '$turma', '$discente_matricula', '$idcurso' )" ;
                //$resultado= mysqli_query($conexao, $query);
            
           
    ?>
    
    <form action="", method="post", enctype="multipart/form-data">
        <input type= "file", name="file"/> <br>
        <br><input type="submit", name="acao" , value="Enviar Arquivo"/>

    </form>
</body>
</html>


</html>