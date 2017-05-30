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
         
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
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
				$("#iId").attr("readonly",true);
				$("#iCpf").attr("readonly",false);
			}else{
				$("#subAtualizar").fadeIn();
				$("#subBuscar").fadeOut();
				$("#subExcluir").fadeOut();
				$(":input").attr("readonly",false);
				$("#iId").attr("readonly",true);
				$("#iCpf").attr("readonly",true);
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
        <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="iCpf" name="nCpf" required value="<?php echo "".isset($_SESSION["Cpf_buscado"])? $_SESSION["Cpf_buscado"] : ''?>" placeholder="Insira o CPF do Funcionário" >
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
		  <label class="control-label col-sm-2">*Id:</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" id="iId" name="nId" placeholder="Código do Funcionario" readonly required value="<?php echo "".isset($_SESSION['Id_buscado'])? $_SESSION['Id_buscado'] : ''?>">
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

          <label class="control-label col-sm-2" for="iUF">UF:</label><span><?php $UF = "".isset($_SESSION['Uf_buscado'])?$_SESSION['Uf_buscado']: ''?></span>
		  <div class="col-sm-4">
			  <select type="text" class="form-control" readonly id="iUF"  name="nUF" size="1" >               
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
                <option value="PB" <?=($UF == 'PB')?'selected':''?> >Paraíba</option>
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
              </select>
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
			<label class="control-label col-sm-2" for="iStat">Status:</label><span><?php $stat = "".isset($_SESSION['Status_buscado'])?$_SESSION['Status_buscado']: ''?></span>
			  <div class="col-sm-4">
				  <select type="text" class="form-control" readonly id="iStat"  name="nStat" size="1" >		
					<option value=0 <?=($stat == 0)?'selected':''?> >INATIVO</option>
					<option value=1 <?=($stat == 1)?'selected':''?> >ATIVO</option>
				  </select>
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
