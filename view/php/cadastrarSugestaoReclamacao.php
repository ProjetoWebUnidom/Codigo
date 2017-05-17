<?php

    include "../../includes/conexao.php";

    $nome=filter_input(INPUT_POST,'nNome');
    $opcaoTipo=filter_input(INPUT_POST,'optradio');
    $paraquem=filter_input(INPUT_POST,'selPara');
    $detalhe=filter_input(INPUT_POST,'nSug');
    $email=filter_input(INPUT_POST,'nEmail');

    if($opcaoTipo=="sugestao"){
      $stmt = $conn->prepare("INSERT INTO `karina`.`sugestao_reclamacao` (`TIPO_Sugestao_Reclamacao`, `NOME_Sugestao_Reclamacao`, `EMAIL_Sugestao_Reclamacao`,
              `Info_Sugestao_Reclamacao`, `DESTINARIO_Sugestao`)VALUES ('Sugestao',?,?,?,?)");
      $stmt->bind_param("ssss",$nome,$email,$detalhe,$paraquem);
      $stmt->execute();
    }if($opcaoTipo=="reclamacao"){
      $stmt = $conn->prepare("INSERT INTO `karina`.`sugestao_reclamacao` (`TIPO_Sugestao_Reclamacao`, `NOME_Sugestao_Reclamacao`, `EMAIL_Sugestao_Reclamacao`,
              `Info_Sugestao_Reclamacao`, `DESTINARIO_Sugestao`)VALUES ('Reclamacao',?,?,?,?)");
      $stmt->bind_param("ssss",$nome,$email,$detalhe,$paraquem);
      $stmt->execute();
    }
    header("location:../web/index.php");
