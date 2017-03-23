<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8"/>
	<title>Sistema Pesquisa</title>
        <script src="../../js/bootstrap.js" type="text/javascript"></script>
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../../js/jquery-1.11.1.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		#pesquisaCliente{
			width:500px;
		}
		#form_pesquisa{
			margin-top:50px;
		}
	</style>
	
	<script>
	$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
        $('#loading').html("<img src='../../imagens/loading.gif'/>").fadeIn('fast');
    }
    
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }       
    
    
    // aqui a fun��o ajax que busca os dados em outra pagina do tipo html, n�o � json
    function load_dados(valores, page)
    {
        
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
		              loading_show();
				},
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data=msg;
                    
                    var arr=data.split(',');
                    $("#teste").html(data).fadeIn();
                    if(arr[0]!==""){
                        $("iNome").val(arr[0]);
                        $("iBairro").val(arr[1]);
                    }
                }
            });
    }
    
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa.php');
    
    
    //Aqui uso o evento key up para come�ar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#iId').keyup(function(){
        
        var valores = $('#iId').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $("#iId").val();
        
        if($parametro.length >= 1)
        {
            load_dados(valores, 'pesquisa.php');
        }else
        {
            load_dados(null, 'pesquisa.php');
        }
    });

	});
	</script>	
</head>
<body>
    <div class="container">
    <?php
        include "../../includes/header.html";
    ?>
    <h2 style="text-align:center;">Novo cliente</h2>
    <div id="teste">
        
    </div>
      <form name="form_pesquisa" id="form_pesquisa" action="" method="post" class="form-horizontal">
      <div class="form-group vals">
          <label class="control-label col-sm-2" for="iId">Id:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="iId" name="nId" placeholder="Id do pedido">
          </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-sm-2" for="iNome">*Nome:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="iNome" name="nNome" required placeholder="Entre com seu nome">
        </div>
        <label class="control-label col-sm-2" for="iBairro">Bairro:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="iBairro" name="nBairro" placeholder="Entre com seu bairro">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="iEnd">Endereço:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="iEnd" name="nEnd" placeholder="Entre com seu endereço">
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
        <label class="control-label col-sm-2" for="iDet">Como chegar:</label>
        <div class="col-sm-10">
            <textarea id="iDet" name="nDet" rows="4" class="form-control" placeholder="Preencha este campo com detalhes que possam nos ajudar a encontrar o endereço mais facilmente"></textarea>
        </div>  
      </div>
      <div class="form-group">
        <label class="col-sm-offset-1 col-sm-11" for="iDet">* Campo obrigatório</label>
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