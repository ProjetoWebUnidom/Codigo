<?php
  function inserirProduto($conn,$idCategoria,$nome,$descricao,$valor){
    $stmt = $conn->prepare("INSERT INTO produto(ID_TipoCategoria,NOME_produto,DESCRICAO_produto,VALOR_produto)
                              VALUES (?,?,?,?)");
    $stmt->bind_param("issd",$idCategoria,$nome,$descricao,$valor);
    $resultado = $stmt->execute();
    return $resultado;
  }
  function buscarIdProduto($conn,$nome){
    $stmt = $conn->prepare("SELECT ID_Produto FROM produto WHERE NOME_Produto = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_object();
  }

  function buscarProduto($conn,$nome){
    $stmt = $conn->prepare("SELECT p.ID_Produto,p.NOME_Produto,p.DESCRICAO_produto,p.VALOR_produto,p.ID_TipoCategoria,f.DIRETORIO_Imagem FROM produto AS p JOIN foto AS f ON
      f.ID_Produto = p.ID_Produto and p.NOME_Produto like (SELECT NOME_Produto FROM produto WHERE NOME_Produto like ?)");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
  }

  function listaProdutos($conn) {
      $produtos = array();
      $resultado = $conn->query("SELECT p.NOME_Produto,p.DESCRICAO_produto,p.VALOR_produto,p.ID_TipoCategoria,f.DIRETORIO_Imagem
                                  FROM produto AS p JOIN foto AS f WHERE p.ID_Produto = f.ID_Produto");

      while($produto = $resultado->fetch_assoc()) {
          array_push($produtos, $produto);
      }

      return $produtos;
  }
  function qtdProdutos($conn,$paginas,$qt_paginas){
    $stmt = $conn->prepare("SELECT p.NOME_Produto,p.DESCRICAO_produto,p.VALOR_produto,p.ID_TipoCategoria,f.DIRETORIO_Imagem
                                FROM produto AS p JOIN foto AS f WHERE p.ID_Produto = f.ID_Produto LIMIT ?,?");
    $stmt->bind_param("ii",$paginas,$qt_paginas);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado;

  }
  function alterarProduto($conn,$nome,$valor,$idCategoria,$descricao,$id){
    $stmt = $conn->prepare("UPDATE produto SET NOME_produto  = ?, VALOR_produto = ?, ID_TipoCategoria = ?, DESCRICAO_produto = ? WHERE ID_Produto = ?");
    $stmt->bind_param("sdisi",$nome,$valor,$idCategoria,$descricao,$id);
    $resultado = $stmt->execute();
    return $resultado;
  }
