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
        <title>Novo_Funcionario</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../..js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
               $("#funcionarioExistente").fadeIn();
               $("#novoFuncionario").fadeOut();
			   $("#iEnviar").fadeOut();
               $("#subId").click(function(){
                   $("#iForm").attr("action","../php/procurarFuncionario.php");
				   $("#iForm").submit();
               });
               jQuery("#iCpf").mask("999.999.999-99");
               jQuery("#iCelularC").mask("(99) 99999-9999");

               $("input[type='radio']").click(function(){
                    var opcao=$("input[name='optradio']:checked").val();
                    if(opcao==="existente"){
                        $("#funcionarioExistente").slideDown(1000);
                        $("#novoFuncionario").slideUp(1000);
						$("#iEnviar").fadeOut();
						$("#subId").click(function(){
						   $("#iForm").attr("action","../php/procurarFuncionario.php");
						   $("#iForm").submit();
						});
                    }else{
                        $("#funcionarioExistente").slideUp(1000);
                        $("#novoFuncionario").slideDown(1000);
                        $("#iId").val("");
                        $("#iNome").val("");
                        $("#iBairro").val("");
                        $("#iEnd").val("");
                        $("#iEmail").val("");
						$("#iEnviar").fadeIn();
						$("#iEnviar").click(function(){
						   $("#iForm").attr("action","../php/cadastrarNovoFuncionario.php");
						   $("#iForm").submit();
					    });
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
        <?php
            include "../../includes/headerAdm.html";
            include "../../includes/conexao.php";
            include "../php/banco-funcionario.php";
            if(isset($_GET["ok"]) && $_GET["ok"]==1){
              $id = $_GET["id"];
              $funcionario = buscarFuncionario($conn,$id);
            }
        ?>
        <h2 style="text-align:center;">Novo funcionário</h2>

        <form id="iForm" action="" method="post" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                  <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="existente">Funcionário existente</label>
                  <label class="radio-inline"><input type="radio" name="optradio" value="novo">Novo funcionário</label>
            </div>
            <div class="col-sm-6">
            </div>
          </div>

        <div id="funcionarioExistente" class="form-group">
            <label class="control-label col-sm-2">Id:</label>
            <div class="col-sm-2">
            <input type="text" class="form-control" id="iId" name="nId" placeholder="Código do funcionário" value="<?php echo "".isset($_GET['id'])? $_GET['id'] : ''?>">
            </div>
            <div class="col-sm-2">
                <button id="subId" name="nSubId" value="btBuscar" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-sm-offset-2 col-sm-4">
            </div>
        </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="iNome">*Nome:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iNome" name="nNome" value="<?php echo "".isset($funcionario['NOME_Funcionario'])? $funcionario['NOME_Funcionario'] : ''?>" placeholder="Entre com o nome do funcionario">
            </div>
            <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iBairro" name="nBairro" placeholder="Entre com o bairro do funcionario" value="<?php echo "".isset($_GET['bairro'])? $_GET['bairro'] : ''?>">
            </div>
          </div>
          <div id="novoFuncionario">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iEnd" name="nEnd" value="<?php echo "".isset($_GET['endereco'])? $_GET['endereco'] : ''?>" placeholder="Entre com o endereço do funcionario">
                  </div>
                  <label class="control-label col-sm-2" for="iEmail">*Email:</label>
                  <div class="col-sm-4">
                      <input type="email" class="form-control" id="iEmail" name="nEmail" placeholder="Insira um email válido" value="<?php echo "".isset($_GET['email'])? $_GET['email'] : ''?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="iCel">Telefone:</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control" id="iCel" maxlength="15" onkeypress="mascara(this)" name="nCel" placeholder="Entre com telefone para contato">
                  </div>
                </div>
          </div>
          <div class="form-group">
                <label class="control-label col-sm-2" for="iCpf">*CPF:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iCpf" name="nCpf" placeholder="Insira o CPF do funcionário">
            </div>
              <label class="control-label col-sm-2" for="iDtNasc">Data nascimento:</label>
            <div class="col-sm-4">
                <input type="Date" class="form-control" id="iDtNasc" name="nDtNasc" placeholder="Data de nascimento do titular">
            </div>
          </div>

          <div class="form-group">
                <label class="control-label col-sm-2" for="iConj">Cônjugue:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iConj" name="nConj" placeholder="Cônjugue do funcionário">
            </div>
              <label class="control-label col-sm-2" for="iDtNascC">Data nascimento:</label>
            <div class="col-sm-4">
                <input type="Date" class="form-control" id="iDtNascC" name="nDtNascC" placeholder="Data de nascimento do cônjugue">
            </div>
          </div>

          <div class="form-group">
                <label class="control-label col-sm-2" for="iCelularC">Celular:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="iCelularC" name="nCelularC"  onkeypress="mascara(this)" placeholder="Celular do Cônjugue">
            </div>
            <div class="col-sm-6">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-11" for="iDet">* Campo obrigatório</label>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button id="iEnviar" value="btCadastrar" class="btn btn-primary btn-block">E n  v i a r</button>
            </div>
          </div>
        </form>
            <?php
                include "../../includes/footer.html";
            ?>
      </div>
    </body>
</html>
