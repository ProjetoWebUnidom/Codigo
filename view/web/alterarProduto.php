<?php
    session_start();
    include "../php/permissao.php";
    perfil();
?>


<!DOCTYPE html>
<html>
  <head>
     
<meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>Karina</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/estilofooter.css">
  </head>
  <body>
    <?php
          include "../../includes/conexao.php";
          include "../php/banco-produto.php";
          include "../php/banco-categoria.php";
          $produtos = listaProdutos($conn);
          $categorias = listaCategorias($conn);
    ?>
    <div class="container">
      <form class="form-horizontal" action="../php/buscarProdutos.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <center>
          <?php  if(isset($_SESSION['ok'])){ ?>
             <p class="alert-success">Alterado com sucesso!</p>
          <?php } ?>
          <?php if(isset($_SESSION['exc'])){ ?>
              <p class="alert-success">Excluido com sucesso!</p>
            <?php } ?>
          <h1>Produtos</h1>
        </center>
        <input type="hidden" name="id" value="<?php echo"".isset($_SESSION['produto'])?$_SESSION['produto']['ID_Produto']: '';?>">
        <label class="control-label col-sm-2">Produtos</label>
          <div class="form-group">
            <div class="col-sm-2">
              <input type="text" name="buscaProduto">
            </div>
            <div class="col-sm-2">
                <button type="submit"  name="buscar" value="btBuscar" class="btn btn-primary">Buscar</button>
                <button type="submit"  name="excluir" value="btExcluir" class="btn btn-primary">Excluir</button>
            </div>
            <div class="col-sm-offset-2 col-sm-4">
            </div>
          </div>
          <label class="control-label col-sm-2">Nome:</label>
            <div class="form-group">
              <div class="col-sm-2">
                  <input type="text" name="nomeProduto" value="<?php echo "".isset($_SESSION["produto"])? $_SESSION['produto']['NOME_Produto']: '';?>">
              </div>
            </div>
          <label class="control-label col-sm-2">Valor:</label>
            <div class="form-group">
              <div class="col-sm-2">
                <input type="number" name="valProduto" value = "<?php echo "".isset($_SESSION['produto'])? $_SESSION['produto']['VALOR_produto']: '';?>">
              </div>
            </div>
            <label class="control-label col-sm-2">Categoria:</label>
              <div class="form-group">
                <div class="col-sm-2">
                  <select  name="ID_TipoCategoria">
                    <?php foreach($categorias as $categoria):
                      $essaEhACategoria = $_SESSION['produto']['ID_TipoCategoria'] == $categoria['ID_TipoCategoria'];
                      $selecao = $essaEhACategoria? "selected = 'selected'":"";
                      ?>
                    <option value="<?=$categoria["ID_TipoCategoria"]?>" <?=$selecao?>>
                      <?=$categoria["DESCRICAO_TipoCategoria"]?>
                    </option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
            <label class="control-label col-sm-2">Descrição:</label>
              <div class="form-group">
                <div class="col-sm-10">
                  <textarea class="form-control"name="descricaoProduto" rows="4" cols="80"><?php echo"".isset($_SESSION['produto'])? $_SESSION['produto']['DESCRICAO_produto']:'';?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="thumbnail">
                    <img src="<?php echo"".isset($_SESSION['produto'])?$_SESSION['produto']['DIRETORIO_Imagem']:'';?>" >
                  </div>
                </div>
              </div>
            <label class="control-label col-sm-2">Foto:</label>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="file"  name="arquivo">
                  </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary btn-block" name="alterar" value="btAlterar">A l  t e r a r</button>
                </div>
              </div>
              </div>
          </form>
    </div>



    <?php unset($_SESSION['produto']);?>



    <?php include "../../includes/footer.html"; ?>
  </body>
</html>
