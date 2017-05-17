<!DOCTYPE html>
<?php
  session_start();
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
    </head>
    <body>
        <?php
            include "../../includes/header.html";
            include "../../includes/conexao.php";
            include "../php/banco-produto.php";
            $produtos = listaProdutos($conn);
            $pagina = (isset($_GET["pagina"]))? $_GET["pagina"] : 1;
            $quantidade_pg = 6;
            $total_produtos = count($produtos);
            $num_paginas = ceil($total_produtos/$quantidade_pg);
            $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
            $total_cursos = qtdProdutos($conn,$inicio,$quantidade_pg);
        ?>
        <div class="container" >
            <form class="form" action="busca-produto.php" method="post">
              <input type="search" name="busca" class="form-control">
              <button type="button" class="btn btn-info">
                  <label for="">Buscar</label>
                  <span class="glyphicon glyphicon-search"></span>
              </button>
            </form>
            <div class="page-header">
                  <h2>Produtos</h2>
            </div>
        </div>
        <!-- produtos -->
        <div class="container theme-showcase" role="main">
              <div class="row">
                <?php while ($produto = $total_cursos->fetch_assoc()) { ?>
                 <div class="col-sm-6 col-md-4">
                   <div class="thumbnail">
                     <a href ="pedido-detalhado.php">
                       <img src="<?=$produto["DIRETORIO_Imagem"]?>" alt="Lights" style="width:100%">
                       <div class="caption text-center">
                         <p><?=$produto["NOME_Produto"]?></p>
                         <p><?=$produto["VALOR_produto"]?></p>
                         <p><?=substr($produto["DESCRICAO_produto"],0,40)?></p>
                         <?php $_SESSION['produtoNome'] = $produto['NOME_Produto'] ?>
                       </div>
                     </a>
                   </div>
                 </div>
                 <?php }?>

        </div>
        <?php
            $pagina_posterior = $pagina + 1;
            $pagina_anterior = $pagina - 1;
         ?>
      <!-- paginação-->
      <nav clas="text-center">
        <ul class="pagination">
          <li>
            <?php if($pagina_anterior != 0){ ?>
              <a href="promocoes.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            <?php }else{ ?>
              <span aria-hidden="true">&laquo;</span>
          <?php }  ?>
          </li>

          <?php for($i=1; $i < $num_paginas + 1; $i++){ ?>
              <li><a href="promocoes.php?pagina=<?php echo $i; ?>" aria-label="previous"><?php echo $i; ?></a></li>
          <?php } ?>
          <li>
            <?php
            if($pagina_posterior <= $num_paginas){ ?>
              <a href="promocoes.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
                <span aria-hidden="true">&raquo;</span>
              </a>
            <?php }else{ ?>
              <span aria-hidden="true">&raquo;</span>
          <?php }  ?>
          </li>
        </ul>
      </nav>
    </div>
      <?php
          include "../../includes/footer.html";
      ?>
    </body>
</html>
