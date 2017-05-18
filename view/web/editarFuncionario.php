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
        <title>Editar Funcionário</title><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../..js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script>
        $(document).ready(function () {
          jQuery("#iCpf").mask("999.999.999-99");
          jQuery("#iTel").mask("(99) 9999-9999");
          jQuery("#iRG").mask("99.999.999-99");
          jQuery("#iCEP").mask("99.999-999");
		  $("#subAtualizar").fadeOut();

		  $("input[type='radio']").click(function(){
			var opcao=$("input[name='optradio']:checked").val();
			if(opcao==="buscar"){
				$("#subAtualizar").fadeOut();
				$("#subBuscar").fadeIn();
				$("#subExcluir").fadeIn();
				$(":input").attr("readonly",true);
				$("#iId").attr("readonly",false);
			}else{
				$("#subAtualizar").fadeIn();
				$("#subBuscar").fadeOut();
				$("#subExcluir").fadeOut();
				$(":input").attr("readonly",false);
				$("#iId").attr("readonly",true);
			}
			});
		});
        </script>
      </head>
  <body>
    <div class="container">
      <h2 style="text-align:center;">Editar Funcionário</h2>
      <form action="../php/alterarFuncionario.php" method="post" class="form-horizontal">
         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                  <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="buscar">Buscar Funcionário</label>
                  <label class="radio-inline"><input type="radio" name="optradio" value="alterar">Alterar Funcionário</label>
            </div>
            <div class="col-sm-6">
            </div>
          </div>

      <div id="FuncionarioExistente" class="form-group">
        <label class="control-label col-sm-2">*Id:</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="iId" name="nId" placeholder="Código do Funcionario" required value="<?php echo "".isset($_SESSION['Id_buscado'])? $_SESSION['Id_buscado'] : ''?>">
          </div>
          <div class="col-sm-2">
          </div>
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" id="subBuscar" name="nSubId" value="btBuscar" class="btn btn-primary btn-block">Buscar</button>
            <button type="submit" id="subExcluir" name="nSubId" value="btExc" class="btn btn-primary btn-block">Excluir</button>
          </div>
      </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iNome">*Nome:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iNome" name="nNome" readonly required value="<?php echo "".isset($_SESSION['Nome_buscado'])?$_SESSION['Nome_buscado']: ''?>" placeholder="Entre com seu nome">
          </div>
		  <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="iCpf" name="nCpf" readonly required value="<?php echo "".isset($_SESSION["Cpf_buscado"])? $_SESSION["Cpf_buscado"] : ''?>" placeholder="Insira o CPF do Funcionário" >
			</div>

        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iRG">*RG:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iRG" maxlength="10" onkeypress="mascara(this)" name="nRG" readonly required value="<?php echo "".isset($_SESSION['Rg_buscado'])? $_SESSION['Rg_buscado'] : ''?>" placeholder="Insira seu RG">
          </div>
          <label class="control-label col-sm-2" for="iEmail">*Email:</label>
          <div class="col-sm-4">
              <input type="email" class="form-control" id="iEmail" name="nEmail" placeholder="Insira um email válido" readonly required value="<?php echo "".isset($_SESSION['Email_buscado'])? $_SESSION['Email_buscado'] : ''?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iTel">Telefone:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iTel" maxlength="15" onkeypress="mascara(this)" name="nTel" placeholder="Entre com seu telefone para contato" readonly value="<?php echo "".isset($_SESSION['Telefone_buscado'])? $_SESSION['Telefone_buscado'] :''?>">
          </div>
          <label class="control-label col-sm-2" for="iLvlAccess">*Nível de acesso:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iLvlAccess" maxlength="3" name="nLvlAccess" placeholder="" readonly required value="<?php echo "".isset($_SESSION['TipoUsuario_buscado'])? $_SESSION['TipoUsuario_buscado'] :''?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iCEP">*CEP:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCEP" name="nCEP" placeholder="Entre com seu CEP" readonly required value="<?php echo "".isset($_SESSION['Cep_buscado'])? $_SESSION['Cep_buscado']: ''?>">
          </div>
          <label class="control-label col-sm-2" for="iCidade">Cidade:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iCidade" maxlength="80" name="nCidade" placeholder="Entre com sua cidade" readonly value="<?php echo "".isset($_SESSION['CIDADE_buscado'])? $_SESSION['CIDADE_buscado'] : ''?>"  >
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iBairro" name="nBairro" placeholder="Entre com seu bairro" readonly value="<?php echo "".isset($_SESSION['Bairro_buscado'])? $_SESSION['Bairro_buscado'] : ''?>">
          </div>
          <label class="control-label col-sm-2" for="iDtNasc">*Data nascimento:</label>
            <div class="col-sm-4">
                <input type="Date" class="form-control" id="iDtNasc" name="nDtNasc" readonly required value="<?php echo "".isset($_SESSION['Dtnasc_buscado'])? $_SESSION['Dtnasc_buscado'] : ''?>" placeholder="Data de nascimento do titular">
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="iNum">Numero da casa:</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="iNum" maxlength="11" name="nNum" readonly value="<?php echo "".isset($_SESSION['NumeroCasa_buscado'])?$_SESSION['NumeroCasa_buscado']: ''?>" placeholder="Entre com o nomero da casa">
          </div>

          <label class="control-label col-sm-2" for="iCidade">UF:</label>
		  <div class="col-sm-4">
			  <select readonly type="text" class="form-control" id="iUF" name="nUF" size="1" >
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="AC")?"true":"false"?>" value="AC">Acre</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="AL")?"true":"false"?>" value="AL">Alagoas </option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="AP")?"true":"false"?>" value="AP">Amapá</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="AM")?"true":"false"?>" value="AM">Amazonas</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="BA")?"true":"false"?>" value="BA">Bahia</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="CE")?"true":"false"?>" value="CE">Ceará</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="DF")?"true":"false"?>" value="DF">Distrito Federal</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="ES")?"true":"false"?>" value="ES">Espírito Santo</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="GO")?"true":"false"?>" value="GO">Goiás</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="MA")?"true":"false"?>" value="MA">Maranhão</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="MT")?"true":"false"?>" value="MT">Mato Grosso</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="MS")?"true":"false"?>" value="MS">Mato Grosso do Sul</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="MG")?"true":"false"?>" value="MG">Minas Gerais</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="PA")?"true":"false"?>" value="PA">Pará</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="PB")?"true":"false"?>" value="PB">Paraíba</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="PR")?"true":"false"?>" value="PR">Paraná</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="PE")?"true":"false"?>" value="PE">Pernambuco</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="PI")?"true":"false"?>" value="PI">Piauí</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="RJ")?"true":"false"?>" value="RJ">Rio de Janeiro </option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="RN")?"true":"false"?>" value="RN">Rio Grande do Norte</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="RS")?"true":"false"?>" value="RS">Rio Grande do Sul</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="RO")?"true":"false"?>" value="RO">Rondônia</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="RR")?"true":"false"?>" value="RR">Roraima</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="SC")?"true":"false"?>" value="SC">Santa Catarina</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="SP")?"true":"false"?>" value="SP">São Paulo</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="SE")?"true":"false"?>" value="SE">Sergipe</option>
				<option selected="<?php echo "".isset($_SESSION['Uf_buscado'])&&($_SESSION['Uf_buscado']==="TO")?"true":"false"?>" value="TO">Tocantins</option>
			  </select></label>
		  </div>
        </div>

		<div class="form-group">
		  <label class="control-label col-sm-2" for="iNum">*Login:</label>
		  <div class="col-sm-4">
			  <input type="text" class="form-control" id="iLog" maxlength="10" name="nLog" readonly required value="<?php echo "".isset( $_SESSION['Login_buscado'])? $_SESSION['Login_buscado'] : ''?>" placeholder="Entre com o seu login">
		  </div>
		  <label class="control-label col-sm-2" for="iSenha">*Senha:</label>
		  <div class="col-sm-4">
			  <input type="text" class="form-control" id="iSenha" maxlength="10" name="nSenha" placeholder="Entre com sua senha" readonly required value="<?php echo "".isset($_SESSION['Senha_buscado'])? $_SESSION['Senha_buscado'] : ''?>">
		  </div>
		</div>

		<div class="form-group">
            <label class="col-sm-offset-1 col-sm-11" for="iDet">* Campo obrigatório</label>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" id="subAtualizar" name="nSubId" value="btAtt" class="btn btn-primary btn-block">Atualizar</button>
            </div>
          </div>
	</form>
</div>
  </body>
        <?php
            include "../../includes/footer.html";
        ?>
  </html>
