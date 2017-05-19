<?php
  session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">  

        <style>

            .texto{
                text-align: center;
                font-size: 33px;
                font-family: -moz-fixed;
                text-shadow: 0.1em 0.1em 0.2em black;
            }
        </style>
        <script>

              $(document).ready(function () {
                  $(".texto, .img").fadeIn();
                  $("#iNovaMensagem").click(function () {
                      window.location.href = "../web/malaDireta.php"
                  });
                  $("#itentarNovamente").click(function () {
                      window.location.href = "../web/malaDireta.php"
                  });

              });


        </script>
    </head>

    <body>
        <div class="container">
            <?php
              include "../../includes/headerAdm.html";
            ?>
            <fieldset >
                <legend>Mala Direta</legend>

                <div class="form-group">
                    <br /><br />
                    <?php
                      if ($_GET['envio'] == 'sucesso') {
                          ?>
                          <div class="texto" style="display:none"> Mala Direta enviada com sucesso!</div>
                          <div style=" text-align:  center">
                              <img src="../../imagens/check.svg" style="width: 80px; display:none" alt="sucesso" class="img" id="imgSucesso"/>
                          </div>
                      </div>
                      <br>
                      <div  class="col-sm-12" >
                          <div style="float: right;">
                              <button type="submit" id="iNovaMensagem" name="nNovaMensagem" style="align-items: center;"  class="btn btn-primary">Nova mensagem</button>
                          </div>
                      </div>
                      <?php
                  } else {
                      ?>
                      <div class="texto" style="display:none"> Ocorreu um erro ao realizar a Mala Direta.<br> Tente novamente!</div>
                      <div style=" text-align:  center">
                          <img src="../../imagens/índice.png" style="width: 80px; display:none" alt="erro" class="img" id="imgErro"/>
                      </div>
              </div>
              <br>
              <div  class="col-sm-12" >
                  <div style="float: right;">
                      <button type="submit" id="itentarNovamente" name="ntentarNovamente" style="align-items: center;"  class="btn btn-primary">Tentar novamente</button>
                  </div>
              </div>
              <?php
          }
        ?>
    </fieldset>
    <br>
    <br>
    <?php
      include "../../includes/footer.html";
    ?>
</div>
</body>

</html>