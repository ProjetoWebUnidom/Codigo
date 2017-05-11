<?php

  function inserirImagem($conn,$idProduto,$diretorio){
    $stmt = $conn->prepare("INSERT INTO foto(ID_Produto,DIRETORIO_Imagem) VALUES (?,?)");
    $stmt->bind_param("is",$idProduto,$diretorio);
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

function alterarFoto($conn,$diretorio,$id){
  $stmt = $conn->prepare("UPDATE foto SET DIRETORIO_Imagem = ? WHERE ID_Produto = ?");
  $stmt->bind_param("si",$diretorio,$id);
  $resultado = $stmt->execute();
  return $resultado;
}
function fotoExiste($conn,$diretorio){
  $stmt = $conn->prepare("SELECT DIRETORIO_Imagem FROM foto WHERE DIRETORIO_Imagem like ?");
  $stmt->bind_param("s",$diretorio);
  $resultado = $stmt->execute();
  return $resultado;
}
