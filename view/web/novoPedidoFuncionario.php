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

<meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Fazer_Pedido</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../..js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
		<script>
		  $(document).ready(function () {
			jQuery("#iCpf").mask("999.999.999-99");
			jQuery("#iTel").mask("(99) 9999-9999");
			jQuery("#iCel").mask("(99) 9999-9999");
			jQuery("#iRg").mask("99.999.999-99");
			jQuery("#iCEP").mask("99.999-999");
			$("#iDiv").hide();
			$("input[type='radio']").click(function(){
				var opcao=$("input[name='optradio']:checked").val();
				if(opcao==="buscar"){
					$("#subBuscar").attr("disabled",false);
					$("#iCpf").attr("readonly",false);
					$("#iDiv").fadeOut();
					$("#iDesc").attr("required",false);
					$("#iStat").attr("required",false);
					$("#iVal").attr("required",false);
				}else{
					$("#subBuscar").attr("disabled",true);
					$("#iCpf").attr("readonly",true);
					$("#iDiv").fadeIn();
					$("#iDesc").attr("required",true);
					$("#iStat").attr("required",true);
					$("#iVal").attr("required",true);
				}
			});
		  });

		</script>
    </head>
    <body>
        <div class="container">
        <h3 style="text-align:center;">
            É muito importante que você preencha os dados abaixo com a maior exatidão possível.
        O endereço deve ser aquele no qual faremos o projeto que o(a) Sr(a) deseje.</h3>

		<form action="../php/cadastrarPedidoProjeto.php" method="post" class="form-horizontal">
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-4">
					  <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="buscar">Buscar cliente</label>
					  <label class="radio-inline"><input type="radio" name="optradio" value="salvar">Salvar projeto</label>
				</div>
				<div class="col-sm-6">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="iCpf">*CPF:</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="iCpf" name="nCpf" placeholder="CPF do Cliente" required value="<?php echo "".isset($_SESSION["Cpf_buscado"])? $_SESSION["Cpf_buscado"] : ''?>">
				</div>
				<div class="col-sm-2">
				</div>
				<div class="col-sm-offset-2 col-sm-4">
					<button type="submit" id="subBuscar" name="nSubId" value="btBuscar" class="btn btn-primary btn-block">Buscar</button>
				</div>
			</div>

		  <div class="form-group">
            <label class="control-label col-sm-2" for="iNome">*Nome:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" readonly id="iNome" name="nNome" placeholder="" value="<?php echo "".isset($_SESSION["Nome_buscado"])? $_SESSION["Nome_buscado"] : ''?>">
            </div>
          </div>

		  <div class="form-group">
            <label class="control-label col-sm-2" for="iRg">*RG:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" readonly id="iRg" name="nRg" placeholder="" value="<?php echo "".isset($_SESSION["Rg_buscado"])? $_SESSION["Cpf_buscado"] : ''?>">
            </div>
            <label class="control-label col-sm-2" for="iDtNasc">*Data nascimento:</label>
            <div class="col-sm-4">
                <input type="Date" class="form-control" readonly id="iDtNasc" name="nDtNasc" value="<?php echo "".isset($_SESSION["Dtnasc_buscado"])? $_SESSION["Dtnasc_buscado"] : ''?>" placeholder="Data de nascimento do titular">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
     		  <div class="col-sm-4">
				  <input type="text" class="form-control" readonly id="iEnd" name="nEnd" placeholder="" value="<?php echo "".isset($_SESSION["Endereco_buscado"])? $_SESSION["Endereco_buscado"] : ''?>">
			  </div>
			<label class="control-label col-sm-2" for="iCEP">*CEP:</label>
	 		  <div class="col-sm-4">
				  <input type="text" class="form-control" readonly id="iCEP" name="nCEP" placeholder="" value="<?php echo "".isset($_SESSION["Cep_buscado"])? $_SESSION["Cep_buscado"] : ''?>">
			  </div>
          </div>

     	<div class="form-group">
		  <label class="control-label col-sm-2" for="iNum">Número da casa:</label>
		  <div class="col-sm-4">
			  <input type="text" class="form-control" readonly id="iNum" maxlength="11" name="nNum" value="<?php echo "".isset($_SESSION["NumeroCasa_buscado"])? $_SESSION["NumeroCasa_buscado"] : ''?>" placeholder="">
		  </div>
		  <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
		  <div class="col-sm-4">
			  <input type="text" class="form-control" readonly id="iBairro" maxlength="80" name="nBairro" placeholder="" value="<?php echo "".isset($_SESSION["Bairro_buscado"])? $_SESSION["Bairro_buscado"] : ''?>">
		  </div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="iCidade">Cidade:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" readonly id="iCidade" maxlength="80" name="nCidade" placeholder="" value="<?php echo "".isset($_SESSION["CIDADE_buscado"])? $_SESSION["CIDADE_buscado"] : ''?>">
            </div>
		<label class="control-label col-sm-2" for="iUF">UF:</label>
			<div class="col-sm-4">
                <input type="text" class="form-control" readonly id="iUF" maxlength="80" name="nUF" placeholder="" value="<?php echo "".isset($_SESSION["Uf_buscado"])? $_SESSION["Uf_buscado"] : ''?>">
            </div>
		</div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iEmail">*Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" readonly id="iEmail" name="nEmail" placeholder=""value="<?php echo "".isset($_SESSION["Email_buscado"])? $_SESSION["Email_buscado"] : ''?>">
            </div>
          </div>

		  <div class="form-group">
			<label class="control-label col-sm-2" for="iTel">Telefone:</label>
			  <div class="col-sm-4">
				  <input type="text" class="form-control" readonly id="iTel" maxlength="15" onkeypress="mascara(this)" name="nTel" placeholder="" value="<?php echo "".isset($_SESSION['Telefone_buscado'])? $_SESSION['Telefone_buscado'] :''?>">
			  </div>
     		<label class="control-label col-sm-2" for="iCel">Celular:</label>
			  <div class="col-sm-4">
				  <input type="text" class="form-control" readonly id="iCel" maxlength="15" onkeypress="mascara(this)" name="nCel" placeholder="" value="<?php echo "".isset($_SESSION['Celular_buscado'])? $_SESSION['Celular_buscado'] :''?>">
			  </div>
		  </div>

		<div id="iDiv">
			<div class="form-group">
				<label class="control-label col-sm-2" for="iDesc">*Descrição:</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="iDesc" maxlength="50" name="nDesc" placeholder="">
				</div>
				<label class="control-label col-sm-2" for="iVal">*Valor:</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="iVal" maxlength="80" name="nVal" placeholder="">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="iStat">*Status:</label>
				<div class="col-sm-4">
				  <select type="text" class="form-control" id="iStat"  name="nStat" size="1">
					<option value="Análise">Análise</option>
					<option value="Concluído">Concluído</option>
				  </select>
			  </div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Qual projeto deseja solicitar:</label>
				<div class="col-sm-4">
					<label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="2">Quarto(s)</label>
					<label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="1">Cozinha</label>
					<label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="3">Sala</label>
					<label class="checkbox-inline"><input type="checkbox" name="projeto[]" value="4">Banheiro(s)</label>
				</div>
			</div>

          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-11" for="iDet">* Campo obrigatório</label>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary btn-block" id="iSalvar" name="nSubId" value="btSalvar">SALVAR</button>
            </div>
          </div>
		</div>
    </form>
            <?php
                include "../../includes/footer.html";
            ?>
      </div>
    </body>
</html>
