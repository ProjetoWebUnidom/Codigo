<?php
    session_start();
    include "../php/permissao.php";
    perfil();
    blockAcess();
?>
<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8">
  <head>
    <title>Karina</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/estilofooter.css">
  </head>
  <body>

    <div class="container">
      <?php
            include "../php/banco-categoria.php";
            include "../../includes/conexao.php";

            $categorias = listaCategorias($conn);
      ?>
        <?php
            if(isset($_GET["ok"]) && $_GET["ok"]==1){
         ?>
            <center>
                <p class="alert-success">Produto cadastrado com sucesso!</p>
            </center>
          <?php } ?>
          <form class="form-horizontal" action="../php/validarProduto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <center>
              <h1>Cadastrar Produtos</h1>
            </center>
              <label class="control-label col-sm-2">Nome:</label>
                <div class="form-group">
                  <div class="col-sm-2">
                      <input type="text" name="nomeProduto">
                  </div>
                </div>
              <label class="control-label col-sm-2">Valor:</label>
                <div class="form-group">
                  <div class="col-sm-2">
                    <input type="number" name="valProduto">
                  </div>
                </div>
                <label class="control-label col-sm-2">Categoria:</label>
                  <div class="form-group">
                    <div class="col-sm-2">
                      <select  name="ID_TipoCategoria">
                        <?php foreach($categorias as $categoria):?>
                        <option value="<?=$categoria["ID_TipoCategoria"]?>"><?=$categoria["DESCRICAO_TipoCategoria"]?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                <label class="control-label col-sm-2">Descrição:</label>
                  <div class="form-group">
                    <div class="col-sm-10">
                      <textarea class="form-control"name="descricaoProduto" rows="4" cols="80"></textarea>
                    </div>
                  </div>
                <label class="control-label col-sm-2">Foto:</label>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="file" required name="arquivo">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary btn-block">E n  v i a r</button>
                    </div>
                  </div>
                  </div>
              </form>
                <?php include "../../includes/footer.html" ?>
    </div>

  </body>
</html>
