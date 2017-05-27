<?php
session_start();
?>
<html>
    <head></head>
    <body>

<?php
    $nome=filter_input(INPUT_POST,'nNome');
    $endereco=filter_input(INPUT_POST,'nEndereco');
    $informacao=filter_input(INPUT_POST,'nDet');
    $celular=filter_input(INPUT_POST,'nCel');
    $email=filter_input(INPUT_POST,'nEmail');
    $lista=filter_input(INPUT_POST,'nProjDe');
    $id=filter_input(INPUT_POST,'nId');
    $numero=filter_input(INPUT_POST,'nCel');
    $bairro = filter_input(INPUT_POST,'nBai');
    $status = filter_input(INPUT_POST,'nStatus');

    $telefone3 = str_replace(" ", "", $numero);
    $tel1 = str_replace("(", "", $telefone3);
    $tel2 = str_replace(")", "", $tel1);
    $telefone = str_replace("-","", $tel2);

    include "../../includes/conexao.php";

    $stmt = " UPDATE projeto SET NOME_Projeto=?, EMAIL_Projeto=?, INFORMACAO_Projeto=?, BAIRRO_Projeto=?, TELEFONE_Projeto=?, STATUS_Projeto=?, ENDERECO_Projeto=?
              WHERE ID_Projeto= ? ";
    $stmt = $conn->prepare($stmt);
    $stmt->bind_param('ssssissi', $nome, $email, $informacao, $bairro, $telefone, $status, $endereco, $id );
    $stmt->execute();
    $conn->close();
    header("location:../web/mostrarPedidoProjeto.php?id=$id");
    ?>
    </body>
</html>
