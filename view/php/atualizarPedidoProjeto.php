<?php
session_start();
?>

<?php
    $nome = filter_input(INPUT_POST,'nNome');
    $email = filter_input(INPUT_POST,'nEmail');
    $informacao = filter_input(INPUT_POST,'nItem');
    $bairro = filter_input(INPUT_POST,'nBai');
    $telefone = filter_input(INPUT_POST,'nCel');
    $status = filter_input(INPUT_POST,'nStatus');
    $endereco=filter_input(INPUT_POST,'nDet');
    $id=filter_input(INPUT_GET,'id');
    $simbolos = array(".",")","-",":","(","/"," ");
    $telefone = str_replace($simbolos,"", $telefone);
    include "../../includes/conexao.php";

    $stmt = $conn->prepare(" UPDATE projeto SET NOME_Projeto=?, EMAIL_Projeto=?, INFORMACAO_Projeto=?,
      BAIRRO_Projeto=?, TELEFONE_Projeto=?, STATUS_Projeto=?, ENDERECO_Projeto=? WHERE ID_Projeto= ? ");
    $stmt->bind_param('ssssissi', $nome, $email, $informacao, $bairro, $telefone, $status, $endereco, $id);
    $stmt->execute();
    $conn->close();
    header("location:../web/mostrarPedidoProjeto.php?id=".$id);
    ?>
