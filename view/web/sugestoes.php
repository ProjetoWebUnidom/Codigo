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

<meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="../../css/estilofooter.css" rel="stylesheet" type="text/css"/>

        <style>
            div img {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
        <script>
            $(document).ready(function () {
               $("input[type='radio']").click(function(){
                    var opcao=$("input[name='optradio']:checked").val();
                    if(opcao==="sugestao"){
                        $("#txtSR").text("Sugestão: ");
                    }else{
                        $("#txtSR").text("Reclamação: ");
                    }
                });
                $("#iSug").keypress(function(){
                   var tamanho=$("#iSug").val().length;
                   $("#iCarac").val(tamanho);
                });
            });

        </script>

    </head>
    <body>
        <div class="container">
        <?php
            include "../../includes/header.html";
            include "../php/permissao.php";
            redirecionarSession();
        ?>
            <form action="../php/cadastrarSugestaoReclamacao.php" method="post" class="form-horizontal">
          <div class="form-group" style="padding:15px;">
                <div class="col-sm-offset-2 col-sm-4">
                <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="sugestao">Sugestão</label>
                <label class="radio-inline"><input type="radio" name="optradio" value="reclamacao">Reclamação</label>
                </div>
                <label class="control-label col-sm-2">Para quem:</label>
                <div class="col-sm-4">
                <select class="form-control" name="selPara">
                    <option value="Geral" selected>Geral</option>
                    <option value="Administracao">Administração</option>
                    <option value="Projetista">Projetistas</option>
                    <option value="Montador">Montadores</option>
                </select>
                </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-2" for="iNome">*Nome:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iNome" name="nNome" required placeholder="Entre com seu nome">
            </div>
            <label class="control-label col-sm-2" for="iEmail">Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="iEmail" name="nEmail" placeholder="Entre com seu email">
            </div>
          </div>
          <div class="form-group">
                <label id="txtSR" class="control-label col-sm-2" for="iSug">Sugestão:</label>
            <div class="col-sm-10">
                <textarea id="iSug" name="nSug" rows="4" maxlength="250" class="form-control" placeholder="Preencha aqui sua sugestão / reclamação (Máximo 250 caracteres)"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="iCarac">Caracteres:</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="iCarac" name="nCarac" readonly>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-block">E n  v i a r</button>
            </div>
          </div>
        </form>


        <?php
            include "../../includes/footer.html";
        ?>
        </div>
    </body>
</html>
