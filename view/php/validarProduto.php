<?php

    include "../../includes/conexao.php";
    include "banco-produto.php";
    include "banco-estoque.php";
    include "banco-foto.php";

    $nomeProduto = $_POST["nomeProduto"];
    $valor = $_POST["valProduto"];
    $descricao = $_POST["descricaoProduto"];
    if(isset($_POST["ID_TipoCategoria"])){
      $idCategoria = $_POST["ID_TipoCategoria"];
    }
    var_dump($nomeProduto);
    if(inserirProduto($conn,$idCategoria,$nomeProduto,$descricao,$valor)){
      $produto = buscarIdProduto($conn,$nomeProduto);
      $idProduto = $produto->ID_Produto;
      $redirecionar = "../web/adicionarProduto.php?ok=1";
    }else{
        var_dump("error :" .$conn->erro); //mudar pq n ta certo
    }

    var_dump($idProduto);
    if(isset($_FILES["arquivo"])){
      define('TAMANHO_MAXIMO', (2 * 1024 * 1024));
      $arquivo_tmp = $_FILES["arquivo"]["tmp_name"];
      $nome = $_FILES["arquivo"]["name"];
      $tipo = $_FILES["arquivo"]["type"];
      $tamanho = $_FILES["arquivo"]["size"];
      $diretorio = "../../imagens/";
      $extensao = substr($nome, -4);
      $novoNome = md5(time());
      $upload = $diretorio. basename($novoNome) . $extensao;
      if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/',$tipo)){
        echo ('Isso não é uma imagem válida');
        exit;
      }
      if($tamanho > TAMANHO_MAXIMO){
        echo retorno('A imagem deve possuir no máximo 2 MB');
        exit;
      }
      var_dump($upload);
      if(move_uploaded_file($arquivo_tmp,$upload)){
        var_dump($upload);
        $redirecionar = "../web/adicionarProduto.php?ok=1&bl";
      }
      if(inserirImagem($conn,$novoNome,$idProduto,$tipo,$tamanho,$upload)){
          header("location:$redirecionar");
      }else{
        echo $conn->erro;
      }
      //var_dump($idFoto);

    }
