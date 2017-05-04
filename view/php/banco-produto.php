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
    $stmt = $conn->prepare("SELECT p.NOME_Produto,p.DESCRICAO_produto,p.VALOR_produto, f.DIRETORIO_Imagem FROM produto AS p JOIN foto AS f WHERE
                            p.NOME_Produto = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
  }

  function listaProdutos($conn) {
      $produtos = array();
      $resultado = $conn->query("SELECT p.NOME_Produto,p.DESCRICAO_produto,p.VALOR_produto, f.DIRETORIO_Imagem FROM produto AS p JOIN foto AS f WHERE p.ID_Produto = f.ID_Produto");

      while($produto = $resultado->fetch_assoc()) {
          array_push($produtos, $produto);
      }

      return $produtos;
  }

  function qtdProdutos($conn,$paginas,$itens_por_paginas){
    $stmt = $conn->prepare("SELECT p.NOME_Produto,p.DESCRICAO_produto,p.VALOR_produto, f.DIRETORIO_Imagem FROM produto AS p JOIN foto AS f LIMIT ?,?");
    $stmt->bind_param("ii",$itens,$itens_por_paginas);
    $resultado = $stmt->execute();
    $produtos = $resultado->fetch_assoc();
    return $produtos->num_rows;

  }
