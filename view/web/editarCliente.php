<?php
session_start();
include "../php/permissao.php";
perfil();
?>
<!DOCTYPE html>
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

          $("input[type='radio']").click(function(){
    			var opcao=$("input[name='optradio']:checked").val();
    			if(opcao==="buscar"){
    				$("#subId").fadeOut();
    				$("#subId").fadeIn();
    				$("#subId").fadeIn();
    				$(":input").attr("readonly",true);
    				$("#iId").attr("readonly",false);
            $("#iUF").attr("disabled",true);

    			}else{
    				$("#subId").fadeIn();
    				$("#subId").fadeOut();
    				$("#subId").fadeOut();
    				$(":input").attr("readonly",false);
    				$("#iId").attr("readonly",true);
            $("#iST").attr("disabled",false);
            $("#iUF").attr("disabled",false);
    			}
    			});
        });
        </script>

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
            if(isset($_GET["att"]) && $_GET["att"]==1){
         ?>
            <center>
              <div class="alert alert-info alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sucesso!</strong>Cliente atualizado.
              </div>
            </center>
          <?php } ?>

          <?php
              if(isset($_GET["exc"]) && $_GET["exc"]==1){
           ?>
              <center>
                <div class="alert alert-info alert-dismissable fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Sucesso!</strong>Cliente excluido.
                </div>
              </center>
            <?php } ?>

      </head>
  <body>
    <div class="container">
      <h2 style="text-align:center;">Editar cliente</h2>
      <form action="../php/editarCliente.php" method="post" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-6">
          </div>
        </div>

      <div  class="form-group">
        <label class="control-label col-sm-2">Id:</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="iId" name="nId"  placeholder="Código do cliente" value="<?php echo "".isset($_GET['id'])? $_GET['id'] : ''?>">
        </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-offset-2 col-sm-4">
                <label class="radio-inline"><input type="radio" name="optradio" checked value="buscar">Buscar cliente</label>
                <label class="radio-inline"><input type="radio" name="optradio" value="alterar">Alterar cliente</label>
          </div>
      </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iNome">*Nome:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iNome" name="nNome" readonly value="<?php echo "".isset( $_GET['nome'])?$_GET['nome']: ''?>" placeholder="Entre com seu nome">
          </div>
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" id="subId" name="nSubId" value="btBuscar" class="btn btn-primary">Buscar</button>
            <button type="submit" id="subId" name="nSubId" value="btAtt" class="btn btn-primary">Atualizar</button>
          <!  <button type="submit" id="subId" name="nSubId" value="btExc" class="btn btn-primary"><!Excluir</button>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iRG">*RG:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iRG" maxlength="10"readonly  onkeypress="mascara(this)" name="nRG" value="<?php echo "".isset($_GET['rg'])? $_GET['rg'] : ''?>" placeholder="Insira seu RG">
          </div>
          <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCpf" name="nCpf" readonly value="<?php echo "".isset($_GET['cpf'])? $_GET['cpf'] : ''?>" placeholder="Insira o CPF do cliente" >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iTel">*Telefone:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iTel" maxlength="15" readonly onkeypress="mascara(this)" name="nTel" placeholder="Entre com seu telefone para contato" value="<?php echo "".isset($_GET['telefone'])? $_GET['telefone'] :''?>">
          </div>
          <label class="control-label col-sm-2" for="iEmail">*Email:</label>
          <div class="col-sm-4">
              <input type="email" class="form-control" id="iEmail" name="nEmail" readonly placeholder="Insira um email válido" value="<?php echo "".isset($_GET['email'])? $_GET['email'] : ''?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iCel">*Celular:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCel" maxlength="15" readonly  onkeypress="mascara(this)" name="nCel" placeholder="Entre com seu telefone para contato" value="<?php echo "".isset($_GET['celular'])? $_GET['celular'] :''?>">
          </div>
          <label class="control-label col-sm-2" for="iDtNasc">Data nascimento:</label>
          <div class="col-sm-4">
              <input type="Date" class="form-control" id="iDtNasc" name="nDtNasc" readonly value="<?php echo "".isset($_GET['data_nasc'])? $_GET['data_nasc'] : ''?>" placeholder="Data de nascimento do titular">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iCEP">CEP:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCEP" name="nCEP" readonly placeholder="Entre com seu CEP" value="<?php echo "".isset($_GET['CEP'])? $_GET['CEP'] : ''?>">
          </div>
          <label class="control-label col-sm-2" for="iCidade">Cidade:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCidade" maxlength="80" name="nCidade" readonly placeholder="Entre com sua cidade" value="<?php echo "".isset($_GET['cidade'])? $_GET['cidade'] : ''?>"  >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iNum">Numero da casa:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iNum" maxlength="11" name="nNum" readonly value="<?php echo "".isset( $_GET['num'])?$_GET['num']: ''?>" placeholder="Entre com o nomero da casa">
          </div>
          <label class="control-label col-sm-2" for="iUf">UF:</label> <span><?php $UF = "".isset( $_GET['uf'])?$_GET['uf']: ''?></span>
          <div class="col-sm-4">
              <select type="text" class="form-control" id="iUF" disabled  name="nUF" size="1" >
                <option value="AC" <?=($UF == 'AC')?'selected':''?> >Acre</option>
                <option value="AL" <?=($UF == 'AL')?'selected':''?> >Alagoas </option>
                <option value="AP" <?=($UF == 'AP')?'selected':''?> >Amapá</option>
                <option value="AM" <?=($UF == 'AM')?'selected':''?> >Amazonas</option>
                <option value="BA" <?=($UF == 'BA')?'selected':''?> >Bahia</option>
                <option value="CE" <?=($UF == 'CE')?'selected':''?> >Ceará</option>
                <option value="DF" <?=($UF == 'DF')?'selected':''?> >Distrito Federal</option>
                <option value="ES" <?=($UF == 'ES')?'selected':''?> >Espírito Santo</option>
                <option value="GO" <?=($UF == 'GO')?'selected':''?> >Goiás</option>
                <option value="MA" <?=($UF == 'MA')?'selected':''?> >Maranhão</option>
                <option value="MT" <?=($UF == 'MT')?'selected':''?> >Mato Grosso</option>
                <option value="MS" <?=($UF == 'MS')?'selected':''?> >Mato Grosso do Sul</option>
                <option value="MG" <?=($UF == 'MG')?'selected':''?> >Minas Gerais</option>
                <option value="PA" <?=($UF == 'PA')?'selected':''?> >Pará</option>
                <option value="PB" <?=($UF == 'PB')?'selected':''?>>Paraíba</option>
                <option value="PR" <?=($UF == 'PR')?'selected':''?> >Paraná</option>
                <option value="PE" <?=($UF == 'PE')?'selected':''?> >Pernambuco</option>
                <option value="PI" <?=($UF == 'PI')?'selected':''?> >Piauí</option>
                <option value="RJ" <?=($UF == 'RJ')?'selected':''?> >Rio de Janeiro </option>
                <option value="RN" <?=($UF == 'RN')?'selected':''?> >Rio Grande do Norte</option>
                <option value="RS" <?=($UF == 'RS')?'selected':''?> >Rio Grande do Sul</option>
                <option value="RO" <?=($UF == 'RO')?'selected':''?> >Rondônia</option>
                <option value="RR" <?=($UF == 'RR')?'selected':''?> >Roraima</option>
                <option value="SC" <?=($UF == 'SC')?'selected':''?> >Santa Catarina</option>
                <option value="SP" <?=($UF == 'SP')?'selected':''?> >São Paulo</option>
                <option value="SE" <?=($UF == 'SE')?'selected':''?> >Sergipe</option>
                <option value="TO" <?=($UF == 'TO')?'selected':''?> >Tocantins</option>
              </select></label>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iEnd" maxlength="99" name="nEnd" readonly value="<?php echo "".isset( $_GET['end'])?$_GET['end']: ''?>" placeholder="Entre com o seu endereço">
          </div>
          <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iBairro" name="nBairro" readonly placeholder="Entre com seu bairro" value="<?php echo "".isset($_GET['bairro'])? $_GET['bairro'] : ''?>">
          </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iStatus">Status:</label> <span><?php $ST = "".isset( $_GET['status'])?$_GET['status']: ''?></span>
            <div class="col-sm-4">
                <select type="text" disabled class="form-control" id="iST" name="nST" size="1" >
                  <option value="AC" <?=($ST == '1')?'selected':''?> >Ativo</option>
                  <option value="AL" <?=($ST == '0')?'selected':''?> >Inativo </option>
                </select></label>
            </div>
          </div>

</div>
  </body>
        <?php
            include "../../includes/footer.html";
        ?>
  </html>
