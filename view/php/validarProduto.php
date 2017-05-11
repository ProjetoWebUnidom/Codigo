<?php

    include "../../includes/conexao.php";
    include "banco-produto.php";
    include "banco-estoque.php";
    include "banco-foto.php";
    include "validarFoto.php";

    $nomeProduto = $_POST["nomeProduto"];
    $valor = $_POST["valProduto"];
    $descricao = $_POST["descricaoProduto"];
    if(isset($_POST["ID_TipoCategoria"])){
      $idCategoria = $_POST["ID_TipoCategoria"];
    }
    if(inserirProduto($conn,$idCategoria,$nomeProduto,$descricao,$valor)){
      $idProduto = $conn->insert_id;
      $redirecionar = "../web/adicionarProduto.php?ok=1";
    }else{
        var_dump("error :" .$conn->erro); //mudar pq n ta certo
    }
    if(isset($_FILES["arquivo"])){
      $upload = validarFoto($_FILES["arquivo"]);
      var_dump($upload);
      if(move_uploaded_file($_FILES["arquivo"]["tmp_name"],$upload)){
        var_dump($upload);
        $redirecionar = "../web/adicionarProduto.php?ok=1";
      }
      if(inserirImagem($conn,$idProduto,$upload)){
          header("location:$redirecionar");
      }else{
        echo $conn->erro;
      }


    }
