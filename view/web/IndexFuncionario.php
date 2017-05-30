<!DOCTYPE html>
<?php session_start() ?>
<html>
    <head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>index</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <style>
          .carousel-inner > .item > img,
          .carousel-inner > .item > a > img {
          width: 70%;
          margin: auto;
          }
          p.texto{
              text-align: justify;
          }
        </style>
    </head>
    <body>
        <div class="container">
        <?php
            include "../../includes/headerFuncionario.html";
        ?>

            <div class="row">
              <div class="col-sm-3">
                <h3>Cozinhas</h3>
                <p class="texto">
                    Armários superiores e inferiores, gaveteiros, paneleiros, tudo
                    para que sua cozinha fique personalizada e funcional.
                </p>
                </div>
              <div class="col-sm-3">
                <h3>Quartos</h3>
                <p class="texto">
                    Variedade de armários com 2, 3 ou 4 portas. Opção de portas deslizantes,
                    gaveteiros personalizados e uma grande diversidade de cores.
                </p>
              </div>
              <div class="col-sm-3">
                <h3>Salas</h3>
                <p class="texto">Como a sala é o lugar onde a familia se reune, dedicamos
                muito esforço e tempo neste espaço, desde painéis a home theater.</p>
              </div>
                <div class="col-sm-3">
                <h3>Banheiros</h3>
                <p>Banheiros funcionais e bonitos com design sofisticado e personalizado
                para você.</p>
                </div>
            </div>
              <br>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">

                <div class="item active">
                  <img src="../../imagens/sala.jpg" class="img-circle" alt="Chania" width="460" height="345">
                  <div class="carousel-caption">
                    <h3>Sala</h3>
                    <p>Projeto de Sala.</p>
                  </div>
                </div>

                <div class="item">
                  <img src="../../imagens/cozinha.jpg" class="img-circle" alt="Chania" width="460" height="345">
                  <div class="carousel-caption">
                    <h3>Cozinha</h3>
                    <p>Projeto de Cozinha.</p>
                  </div>
                </div>

                <div class="item">
                  <img src="../../imagens/banheiro.jpg" class="img-circle" alt="Flower" width="460" height="345">
                  <div class="carousel-caption">
                    <h3>Banheiro</h3>
                    <p>Projeto de Banheiro.</p>
                  </div>
                </div>

                <div class="item">
                  <img src="../../imagens/quarto.jpg" alt="Flower" width="460" class="img-circle" height="345">
                  <div class="carousel-caption">
                    <h3>Quarto</h3>
                    <p>Projeto de Quarto.</p>
                  </div>
                </div>

              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <?php
                include "../../includes/footer.html";
            ?>
          </div>
    </body>
</html>
