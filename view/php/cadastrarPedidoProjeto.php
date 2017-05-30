<?php
	session_start();
	
	$bt = filter_input(INPUT_POST,'nSubId');
	$cpf = filter_input(INPUT_POST,'nCpf');
	$simbolos = array(".",",","-",":",";","/"," ");
	$vazio = array("");
	$cpf = str_replace($simbolos, $vazio, $cpf);

	include "../../includes/conexao.php";
	include "banco_projeto.php";

	
	if($bt==='btBuscar'){
		
		$resultado = buscarClienteProjeto($conn,$cpf);

		if($resultado->num_rows > 0) {
			$row = $resultado->fetch_assoc();
			$id=$row['ID_Cliente'];
			$_SESSION["Nome_buscado"]=$row['NOME_Cliente'];
			$_SESSION["Bairro_buscado"]=$row['BAIRRO_Cliente'];
			$_SESSION["CIDADE_buscado"]=$row['CIDADE_Cliente'];
			$_SESSION["Email_buscado"]=$row['EMAIL_Cliente'];
			$_SESSION["Cpf_buscado"]=$cpf;
			$_SESSION["Dtnasc_buscado"]=$row['DTNASC_Cliente'];
			$_SESSION["Rg_buscado"]=$row['RG_Cliente'];
			$_SESSION["Cep_buscado"]=$row['CEP_Cliente'];
			$_SESSION["NumeroCasa_buscado"]=$row['NUMEROCASA_Cliente'];
			$_SESSION["Uf_buscado"]=$row['UF_Cliente'];
			$_SESSION["Endereco_buscado"]=$row['ENDERECO_Cliente'];
			//busca o celular
			$celular=buscarCelularProjeto($conn,$id);
			$_SESSION["Celular_buscado"]= $celular['DDD_Telefone'].$celular['NUMERO_Telefone'];
			
			//busca o telefone
			$telefone=buscarTelefoneProjeto($conn,$id);
			$_SESSION["Telefone_buscado"]= $telefone['DDD_Telefone'].$telefone['NUMERO_Telefone'];
			
			header("location:../web/novoPedidoFuncionario.php");
		}else{
			echo '<script type="text/javascript">var decisao=confirm("O cpf informado não foi encontrado em nosso banco de dados.\nDeseja tentar novamente?");if(decisao){window.location.href="../web/novoPedidoFuncionario.php";}else{window.location.href="../web/recuperarPedidoProjeto.php";}</script>';
			session_destroy();
		}
	}
	
	if($bt==='btSalvar'){
		
		$desc=filter_input(INPUT_POST,'nDesc');
		$valor=filter_input(INPUT_POST,'nVal');
		$stat=filter_input(INPUT_POST,'nStat');
		if(isset($_SESSION['Nome_buscado'])){
			salvarProjeto($conn,$_SESSION["Nome_buscado"],$_SESSION["Email_buscado"],$desc,$_SESSION["Bairro_buscado"],$_SESSION["Telefone_buscado"],$valor,$stat,$_SESSION["Endereco_buscado"]);
			echo '<script type="text/javascript">alert("Projeto cadastrado com sucesso.");window.location.href="../web/novoPedidoFuncionario.php";</script>';
		}else{
			echo '<script type="text/javascript">var decisao=confirm("Erro! Os campos acima não foram preenchidos corretamente. Preencha com atenção!");window.location.href="../web/novoPedidoFuncionario.php";</script>';
		}
	}