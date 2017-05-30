<!DOCTYPE html>
<?php
  session_start();
 ?>
<html>
    <head>

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
    </head>
    <body>
        <?php

            include "../../includes/conexao.php";
            include "../php/banco-produto.php";
            include "../php/permissao.php";
            redirecionarSession();

            $produtos = listaProdutos($conn);
            $pagina = (isset($_GET["pagina"]))? $_GET["pagina"] : 1;
            $quantidade_pg = 6;
            $total_produtos = count($produtos);
            $num_paginas = ceil($total_produtos/$quantidade_pg);
            $inicio = ($quantidade_pg*$pagina)-$quantidade_pg;
            $total_cursos = qtdProdutos($conn,$inicio,$quantidade_pg);
        ?>
          <div class="container">  
            <?php include "../../includes/header.html";   ?>
            <form action="pedido-detalhado.php" method="post"  data-toggle="validator" role="form" class="form-horizontal">
              <div class="form-group">
                  <label class="control-label col-sm-2" for="iProduto">Nome:</label>
                  <div class="col-sm-4">
                  <input type="text" class="form-control" id="iProduto" name="nProduto">
              </div>
                <div>
                  <button type="submit" id="subId" name="nSubId" value="btBuscar" class="btn btn-primary">Consultar</button>
                </div>
                  <br/>
               </div>
           </form>
          </div>
        <!-- produtos -->
        <div class="container theme-showcase" id="pesquisa" role="main">
              <div class="row">
                <?php while ($produto = $total_cursos->fetch_assoc()) { ?>
                 <div class="col-sm-6 col-md-4">
                   <div class="thumbnail">
                     <a href ="pedido-detalhado.php?prdt=<?=$produto['NOME_Produto']?>">
                       <img src="<?=$produto["DIRETORIO_Imagem"]?>" alt="Lights" style="width:100%">
                       <div class="caption text-center">
                           <p><?=$produto["NOME_Produto"]?></p>
                           <p><?=$produto["VALOR_produto"]?></p>
                           <p><?=substr($produto["DESCRICAO_produto"],0,40)?></p>
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
