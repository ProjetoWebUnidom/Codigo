<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fazer_Pedido</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../..js/jquery.js"></script>
        <script src="../../js/mascaras.js" type="text/javascript"></script>
        <script src="/lib/jquery-1.12.2.min.js"></script>
        <script src="/lib/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
        <?php
            include "../../includes/header.html";
        ?>
        <h3 style="text-align:center;">
            É muito importante que você preencha os dados abaixo com a maior exatidão possível.
        O endereço deve ser aquele no qual faremos o projeto que o Sr(a) deseje.</h3>
            <form action="../web/fazerpedidoConfirmacao.php" method="post" class="form-horizontal">

          <div class="form-group">
            <label class="control-label col-sm-2" for="iNome">*Nome:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iNome" name="nNome" required placeholder="Digite seu nome completo">
            </div>
            <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iBairro" name="nBairro" placeholder="Entre com seu bairro">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iEnd" name="nEnd" placeholder="Ex: Rua da margura 08, Quadra 15">
            </div>
            <label class="control-label col-sm-2" for="iCel">*Telefone:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" required id="iCel" maxlength="15" onkeypress="mascara(this)" name="nCel" placeholder="Entre com seu telefone para contato">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="iEmail">*Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="iEmail" name="nEmail" required placeholder="Insira um email válido">
            </div>
            <label class="control-label col-sm-2">Qual projeto deseja solicitar:</label>
            <div class="col-sm-4">
                <label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="Quarto">Quarto(s)</label>
                <label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="Cozinha">Cozinha</label>
                <label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="Sala">Sala</label>
                <label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="Banheiro">Banheiro(s)</label>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="iDet">O que deseja?</label>
            <div class="col-sm-10">
                <textarea id="iDet" name="nDet" rows="4" class="form-control" placeholder="Preencha este campo com detalhes de como deseja mobiliar"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-11" for="iDet">Campos com * são obrigatórios!</label>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            </div>
          </div>
        </form>
            <?php
                include "../../includes/footer.html";
            ?>
      </div>
    </body>
</html>
