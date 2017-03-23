<?php
session_start();
?>
<html>
    <head></head>
    <body>
<?php
    $nome=filter_input(INPUT_POST,'nNome');
    $bairro=filter_input(INPUT_POST,'nBairro');
    $endereco=filter_input(INPUT_POST,'nEnd');
    $detalhe=filter_input(INPUT_POST,'nDet');
    $celular=filter_input(INPUT_POST,'nCel');
    $email=filter_input(INPUT_POST,'nEmail');
    
    $ddd=substr($celular,1,2);
    $telefone1=substr($celular,4,4);
    $telefone2=substr($celular,9);
    $telefone1.=trim($telefone2);
    
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d');
    $hora=date("H:i");
    
    include "../../includes/conexao.php";
    
    $lista="";
    if(isset($_POST['projeto'])){
        foreach($_POST['projeto'] as $projeto){
            $lista=$lista.",".$projeto;
        }
        $lista=  substr($lista, 1);
    }
    $query1 = 'INSERT INTO pedidoprojeto(nome,bairro,endereco,detalhes,projetode,dataproj,hora,email) 
        VALUES("'.$nome.'","'.$bairro.'","'.$endereco.'","'.$detalhe.'","'.$lista.'","'.$date.'","'.$hora.'","'.$email.'")';
    $last_id="";
    
    if ($conn->query($query1) === TRUE) {
        $last_id = $conn->insert_id;
    }else {
        echo "Error: " . $sql . "<br>" . $conn1->error;
    }
    
    $query1 = 'INSERT INTO telefone(ddd,numero,idCliente) 
        VALUES("'.$ddd.'","'.trim($telefone1).'","'.$last_id.'")';
        
    $conn->query($query1);

    $conn->close();
    header("location:../veb/index.php");
    ?>
    </body>
</html>
    