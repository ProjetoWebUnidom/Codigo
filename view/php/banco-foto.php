<?php

  function inserirImagem($conn,$nome,$idProduto,$tipo,$tamanho,$diretorio){
    $stmt = $conn->prepare("INSERT INTO foto(NOME_Imagem,ID_Produto,TIPO_Imagem,Tamanho_Imagem,DIRETORIO_Imagem) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sisis",$nome,$idProduto,$tipo,$tamanho,$diretorio);
    $resultado = $stmt->execute();
    return $resultado;
  }

  function buscarIdFoto($conn,$nome){
    $stmt = $conn->prepare("SELECT ID_Imagem FROM fotos WHERE NOME_Imagem = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->bind_result($nome);
    return $resultado;
  }
