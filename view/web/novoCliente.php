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
        <title>Novo_Cliente</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../..js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
               $("#enviar").fadeOut();
               $("#clienteExistente").fadeIn();
               $("#novoCliente").fadeOut();
               $("#subId").click(function(){
                   if($("#iId").val()===''){
                       return false;
                   }
               });
               jQuery("#iCpf").mask("999.999.999-99");
               jQuery("#iCelularC").mask("(99) 99999-9999");

               $("input[type='radio']").click(function(){
                    var opcao=$("input[name='optradio']:checked").val();
                    $("#enviar").fadeIn();
                    if(opcao==="existente"){
                        $("#clienteExistente").slideDown(1000);
                        $("#novoCliente").slideUp(1000);
                        $("#enviar").fadeOut();
                    }else{
                        $("#clienteExistente").slideUp(1000);
                        $("#novoCliente").slideDown(1000);
                        $("#iId").val("");
                        $("#iNome").val("");
                        $("#iBairro").val("");
                        $("#iEnd").val("");
                        $("#iEmail").val("");
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
        <?php
        if(isset($_GET["fun"]) && $_GET["fun"]==1){
          include "../../includes/headerFuncionario.html";
        }else{
          include "../../includes/headerAdm.html";
        }

        ?>
        <h2 style="text-align:center;">Novo cliente</h2>

        <form action="../php/cadastrarNovoCliente.php" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                  <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="existente">Cliente existente</label>
                  <label class="radio-inline"><input type="radio" name="optradio" value="novo">Novo Cliente</label>
            </div>
            <div class="col-sm-6">
            </div>
          </div>

        <div id="clienteExistente" class="form-group">
            <label class="control-label col-sm-2">Id:</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="iId" name="nId" placeholder="Código do cliente" value="<?php echo "".isset($_GET['id'])? $_GET['id'] : ''?>">
            </div>
            <div class="col-sm-2">
                <button type="submit" id="subId" name="nSubId" value="btBuscar" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-sm-offset-2 col-sm-4">
            </div>
        </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iNome">*Nome:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iNome" name="nNome" value="<?php echo "".isset($_GET['nome'])? $_GET['nome'] : ''?>" placeholder="Entre com seu nome">
            </div>
            <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iBairro" name="nBairro" placeholder="Entre com seu bairro" value="<?php echo "".isset($_GET['bairro'])? $_GET['bairro'] : ''?>">
            </div>
          </div>

          <div id="novoCliente">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iEnd" name="nEnd" value="<?php echo "".isset($_GET['endereco'])? $_GET['endereco'] : ''?>" placeholder="Entre com seu endereço">
                  </div>
                  <label class="control-label col-sm-2" for="iEmail">*Email:</label>
                  <div class="col-sm-4">
                      <input type="email" class="form-control" id="iEmail" name="nEmail" placeholder="Insira um email válido" value="<?php echo "".isset($_GET['email'])? $_GET['email'] : ''?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="iCel">Telefone:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iCel" maxlength="15" onkeypress="mascara(this)" name="nCel" placeholder="Entre com seu telefone para contato">
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
                  <label class="control-label col-sm-2" for="iDet">Como chegar:</label>
                  <div class="col-sm-10">
                      <textarea id="iDet" name="nDet" rows="4" class="form-control" placeholder="Preencha este campo com detalhes que possam nos ajudar a encontrar o endereço mais facilmente"></textarea>
                  </div>
                </div>
          </div>

          <div class="form-group">
                <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iCpf" name="nCpf" value="<?php echo "".isset($_GET['cpf'])? $_GET['cpf'] : ''?>" placeholder="Insira o CPF do cliente">
            </div>
              <label class="control-label col-sm-2" for="iDtNasc">Data nascimento:</label>
            <div class="col-sm-4">
                <input type="Date" class="form-control" id="iDtNasc" name="nDtNasc" value="<?php echo "".isset($_GET['data'])? $_GET['data'] : ''?>" placeholder="Data de nascimento do titular">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-11" for="iDet">* Campo obrigatório</label>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button id="enviar" type="submit" class="btn btn-primary btn-block">E n  v i a r</button>
            </div>
          </div>
        </form>
            <?php
                include "../../includes/footer.html";
            ?>
      </div>
    </body>
</html>
