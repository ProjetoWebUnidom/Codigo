<?php
session_start();
include "../php/permissao.php";
perfil();
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
        <title>Editar Cliente</title><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../..js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script>
        $(document).ready(function () {
          jQuery("#iCpf").mask("999.999.999-99");
          jQuery("#iCel").mask("(99) 99999-9999");
          jQuery("#iTel").mask("(99) 9999-9999");
          jQuery("#iRG").mask("99.999.999-99");
          jQuery("#iCEP").mask("99.999-999");
        });

        </script>
      </head>
  <body>
    <div class="container">
      <h2 style="text-align:center;">Procurar cliente</h2>
      <form action="../php/buscarCliente.php" method="post" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-6">
          </div>
        </div>

      <div id="clienteExistente" class="form-group">
        <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="iCpf" name="nCpf" readonly value="<?php echo "".isset($_GET['cpf'])? $_GET['cpf'] : ''?>" placeholder="Insira o CPF do cliente" >
        </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" id="subId" name="nSubId" value="btBuscar" class="btn btn-primary">Buscar</button>
            <button type="submit" id="subId" name="nSubId" value="btAtt" class="btn btn-primary">Altualizar</button>
            <button type="submit" id="subId" name="nSubId" value="btExc" class="btn btn-primary">Excluir</button>
          </div>
      </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iNome">*Nome:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iNome" name="nNome" value="<?php echo "".isset( $_GET['nome'])?$_GET['nome']: ''?>" placeholder="Entre com seu nome">
          </div>
          <label class="control-label col-sm-2">Id:</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="iId" name="nId" placeholder="Código do cliente" value="<?php echo "".isset($_GET['id'])? $_GET['id'] : ''?>">
          </div>

        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iRG">*RG:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iRG" maxlength="10" onkeypress="mascara(this)" name="nRG" value="<?php echo "".isset($_GET['rg'])? $_GET['rg'] : ''?>" placeholder="Insira seu RG">
          </div>
          <label class="control-label col-sm-2" for="iEmail">*Email:</label>
          <div class="col-sm-4">
              <input type="email" class="form-control" id="iEmail" name="nEmail" placeholder="Insira um email válido" value="<?php echo "".isset($_GET['email'])? $_GET['email'] : ''?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iTel">*Telefone:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iTel" maxlength="15" onkeypress="mascara(this)" name="nTel" placeholder="Entre com seu telefone para contato" value="<?php echo "".isset($_GET['telefone'])? $_GET['telefone'] :''?>">
          </div>
          <label class="control-label col-sm-2" for="iCel">*Celular:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCel" maxlength="15" onkeypress="mascara(this)" name="nCel" placeholder="Entre com seu telefone para contato" value="<?php echo "".isset($_GET['celular'])? $_GET['celular'] :''?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iCEP">CEP:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCEP" name="nCEP" placeholder="Entre com seu CEP" value="<?php echo "".isset($_GET['CEP'])? $_GET['CEP'] : ''?>">
          </div>
          <label class="control-label col-sm-2" for="iCidade">Cidade:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCidade" maxlength="80" name="nCidade" placeholder="Entre com sua cidade" value="<?php echo "".isset($_GET['cidade'])? $_GET['cidade'] : ''?>"  >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iBairro" name="nBairro" placeholder="Entre com seu bairro" value="<?php echo "".isset($_GET['bairro'])? $_GET['bairro'] : ''?>">
          </div>
          <label class="control-label col-sm-2" for="iDtNasc">Data nascimento:</label>
          <div class="col-sm-4">
              <input type="Date" class="form-control" id="iDtNasc" name="nDtNasc" value="<?php echo "".isset($_GET['data_nasc'])? $_GET['data_nasc'] : ''?>" placeholder="Data de nascimento do titular">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iNum">Numero da casa:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iNum" maxlength="11" name="nNum" value="<?php echo "".isset( $_GET['num'])?$_GET['num']: ''?>" placeholder="Entre com o nomero da casa">
          </div>

          <label class="control-label col-sm-2" for="iCidade">UF:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iUF" maxlength="80" name="nUF" value="<?php echo "".isset( $_GET['uf'])?$_GET['uf']: ''?>">
          </div>
        </div>


</div>
  </body>
        <?php
            include "../../includes/footer.html";
        ?>
  </html>
