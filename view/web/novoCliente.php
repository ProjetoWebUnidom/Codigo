<?php
session_start();
include "../php/permissao.php";
perfil();
blockAcess();
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
      <title>Novo Cliente</title><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

    <?php
        if(isset($_GET["cpf"]) && $_GET["cpf"]==1){
     ?>
        <center>
          <div class="alert alert-warning alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenção!</strong>O CPF informado já se encontra cadastrado.
            </div>
        </center>
      <?php } ?>

      <?php
          if(isset($_GET["email"]) && $_GET["email"]==1){
       ?>
          <center>
            <div class="alert alert-warning alert-dismissable fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Atenção!</strong>O email informado já se encontra cadastrado.
              </div>
          </center>
        <?php } ?>

    <?php
        if(isset($_GET["ok"]) && $_GET["ok"]==1){
     ?>
        <center>
          <div class="alert alert-info alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Sucesso!</strong>Cliente cadastrado.
          </div>
        </center>
      <?php } ?>

    <body>
        <div class="container">
        <h2 style="text-align:center;">Novo cliente</h2>

        <form action="../php/CadastrandoCliente.php" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
            </div>
            <div class="col-sm-6">
            </div>
          </div>

        <div id="clienteExistente" class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-offset-2 col-sm-4">
            </div>
        </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iNome">*Nome:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iNome" maxlength="150" required name="nNome"  placeholder="Entre com seu nome">
            </div>
            <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iCpf" name="nCpf" required  placeholder="Insira o CPF do cliente">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iRG">*RG:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iRG" maxlength="10" onkeypress="mascara(this)" name="nRG" required  placeholder="Insira seu RG">
            </div>
            <label class="control-label col-sm-2" for="iEmail">*Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="iEmail" maxlength="100" name="nEmail" required  placeholder="Insira um email válido" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iCel">Celular:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iCel" maxlength="15" onkeypress="mascara(this)" name="nCel" placeholder="Entre com seu telefone para contato">
            </div>
            <label class="control-label col-sm-2" for="iDtNasc">Data nascimento:</label>
            <div class="col-sm-4">
                <input type="Date" class="form-control" id="iDtNasc" name="nDtNasc" required  placeholder="Data de nascimento do titular">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iCel">Telefone:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iTel" maxlength="15" onkeypress="mascara(this)" name="nTel" placeholder="Entre com seu telefone para contato">
            </div>
            <label class="control-label col-sm-2" for="iCidade">Cidade:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iCidade" maxlength="80" name="nCidade" placeholder="Entre com sua cidade"   >
            </div>
          </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="iCEP">CEP:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iCEP" name="nCEP" placeholder="Entre com seu CEP" >
                  </div>
                  <label class="control-label col-sm-2" for="iCidade">UF:</label>
                  <div class="col-sm-4">
                      <select type="text" class="form-control" id="iUF" name="nUF" size="1" >
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas </option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro </option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                      </select></label>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="iNum">Numero da casa:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iNum" maxlength="11" name="nNum"  placeholder="Entre com o nomero da casa">
                  </div>
                  <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iBairro" maxlength="80" name="nBairro" placeholder="Entre com seu bairro">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iEnd" maxlength="99" name="nEnd"  placeholder="Entre com o seu endereço">
                  </div>
                  </div>


                <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-11" for="iDet">* Campo obrigatório</label>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button id="iEnviar" name="nEnviar" value="btCadastrar" class="btn btn-primary btn-block">E n  v i a r</button>
                  </div>
                </div>
              </form>
            </div>
          </body>
                <?php
                    include "../../includes/footer.html";
                ?>
    </html>
