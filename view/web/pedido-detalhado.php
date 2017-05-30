<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/estilofooter.css">
  </head>
  <body>
    <?php include "../../includes/header.html";
          include "../../includes/conexao.php";
          include "../php/banco-produto.php"; ?>
    <?php
    include "../php/permissao.php";
    redirecionarSession();
    if(isset($_POST['btBuscar']) || isset($_POST['nProduto'])){
      $nProduto =  $_POST['nProduto'];
      if(produtoExiste($conn,$nProduto)){
        $nome = $_POST['nProduto'];
      }else{
          header("location: ../web/promocoes.php");

      }
    }

    if(isset($_GET['prdt'])){
      $nome = $_GET['prdt'];
    }
    $produto = buscarProduto($conn,$nome);
    ?>
    <div class="container-fluid">
      <div class="col-sm-6 col-sm-4">
        <div class="thumbnail">
          <img src="<?=$produto["DIRETORIO_Imagem"]?>" alt="Lights" style="width:100%">
        </div>
      </div>
      <div class=""><?=$produto['NOME_Produto']?></div>
      <div class=""><?=$produto['DESCRICAO_produto']?></div>
      <div class=""><?=$produto['VALOR_produto']?></div>
    </div>
    <?php include "../../includes/footer.html" ?>

  </body>
</html>
