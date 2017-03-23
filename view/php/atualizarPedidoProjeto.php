<?php
session_start();
?>
<html>
    <head></head>
    <body>
<?php
    $nome=filter_input(INPUT_POST,'nNome');
    $endereco=filter_input(INPUT_POST,'nEnd');
    $detalhe=filter_input(INPUT_POST,'nDet');
    $celular=filter_input(INPUT_POST,'nCel');
    $email=filter_input(INPUT_POST,'nEmail');
    $lista=filter_input(INPUT_POST,'nProjDe');
    $id=filter_input(INPUT_POST,'nId');
    $oldDdd=filter_input(INPUT_POST,'nOldDdd');
    $oldNumero=filter_input(INPUT_POST,'nOldNumero');
    
    
    
    
    $ddd=substr($celular,1,2);
    $telefone1=substr($celular,5,3);
    $telefone2=substr($celular,9);
    $telefone1.=$telefone2;
   
    include "../../includes/conexao.php";
    
    
    $query1 = "UPDATE pedidoprojeto SET nome='$nome',endereco='$endereco',detalhes='$detalhe',projetode='$lista',email='$email' WHERE id=$id";
        
    $conn->query($query1);

    $query1 = "UPDATE telefone SET ddd='$ddd',numero='$telefone1' WHERE idCliente=$id AND ddd='$oldDdd' AND numero='$oldNumero'";
    
    $conn->query($query1);
    
    $conn->close();
    header("location:../web/mostrarPedidoProjeto.php?id=$id");
    ?>
    </body>
</html>
    