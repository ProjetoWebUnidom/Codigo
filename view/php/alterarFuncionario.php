<?php
	session_start();
	$bt=filter_input(INPUT_POST,'nSubId');
	$id=filter_input(INPUT_POST,'nId');
	include "../../includes/conexao.php";
	include "banco-Funcionario.php";
	$nome='';
	$bairro='';
	$cidade='';
	$email='';
	$cpf='';
	$data_nasc='';
	$rg='';
	$CEP='';
	$num='';
	$msg='';
	$lvlAccess='';
	$telefone='';
	$uf='';
  
	if($bt==='btBuscar'){
		$resultado = readFuncionario($conn,$id);
		  
		if($resultado->num_rows > 0) {
			$row = $resultado->fetch_assoc();
			$_SESSION["Id_buscado"]=$id;
			$_SESSION["Nome_buscado"]=$row['NOME_Funcionario'];
			$_SESSION["Bairro_buscado"]=$row['BAIRRO_Funcionario'];
			$_SESSION["CIDADE_buscado"]=$row['CIDADE_Funcionario'];
			$_SESSION["Email_buscado"]=$row['EMAIL_Funcionario'];
			$_SESSION["Cpf_buscado"]=$row['CPF_Funcionario'];
			$_SESSION["Dtnasc_buscado"]=$row['DTNASC_Funcionario'];
			$_SESSION["Rg_buscado"]=$row['RG_Funcionario'];
			$_SESSION["Cep_buscado"]=$row['CEP_Funcionario'];
			$_SESSION["TipoUsuario_buscado"]=$row['ID_TipoUsuario'];
			$_SESSION["NumeroCasa_buscado"]=$row['NUMEROCASA_Funcionario'];
			$_SESSION["Uf_buscado"]=$row['UF_Funcionario'];
			$_SESSION["Telefone_buscado"]=$row['TELEFONE_Funcionario'];
			$_SESSION["Login_buscado"]=$row['LOGIN_Funcionario'];
			$_SESSION["Senha_buscado"]=$row['SENHA_Funcionario'];
			header("location:../web/editarFuncionario.php");
		}else{
			echo '<script type="text/javascript">var decisao=confirm("O ID informado não foi encontrado em nosso banco de dados.\nDeseja tentar novamente?");if(decisao){window.location.href="../web/editarFuncionario.php";}else{window.location.href="../web/recuperarPedidoProjeto.php";}</script>';
			session_destroy();
		}	
	}

	if($bt==='btAtt'){
		$idFuncionario = $_POST["nId"];
		$login = $_POST['nLog'];
		$senha = $_POST['nSenha'];
		$cpf = $_POST["nCpf"];
		$nome = $_POST["nNome"];
		$rg = $_POST["nRG"];
		$datnas = $_POST["nDtNasc"];
		$uf = $_POST["nUF"];
		$cidade = $_POST["nCidade"];
		$bairro = $_POST["nBairro"];
		$cep = $_POST["nCEP"];
		$numcas = $_POST["nNum"];
		$email = $_POST["nEmail"];
		$lvlAccess = $_POST["nLvlAccess"];
		$telefone = $_POST["nTel"];
		$simbolos = array(".",",","-",":",";","/"," ");
		$vazio   = array("");
		$datnas = str_replace($simbolos, $vazio, $datnas);
		$cpf = str_replace($simbolos, $vazio, $cpf);
		$rg = str_replace($simbolos, $vazio, $rg);
		$cep = str_replace($simbolos, $vazio, $cep);
		$telefone = str_replace($simbolos, $vazio, $telefone);
		
		$resultado = readFuncionario($conn,$idFuncionario);
		  
		if($resultado->num_rows > 0) {
			if(!loginExiste($conn,$login)){
				updateFuncionario($conn,$login,$senha,$nome,$lvlAccess,$rg,$datnas,$cidade,$bairro,$cep,$email,$uf,$telefone,$idFuncionario);
				header("location:../web/editarFuncionario.php");
			}else{
				echo '<script type="text/javascript">alert("O login informado já está sendo usado.");window.location.href="../web/editarFuncionario.php";</script>';
			}
		}else{
			echo '<script type="text/javascript">var decisao=confirm("O ID informado não foi encontrado em nosso banco de dados.\nDeseja tentar novamente?");if(decisao){window.location.href="../web/editarFuncionario.php";}else{window.location.href="../web/recuperarPedidoProjeto.php";}</script>';
			session_destroy();
		}
	}

	if($bt==='btExc'){
		$id = $_POST["nId"];
		$resultado = readFuncionario($conn,$id);
		  
		if($resultado->num_rows > 0) {
			deleteFuncionario($conn,$id);
			echo '<script type="text/javascript">alert("Funcionario deletado com sucesso!");window.location.href="../web/editarFuncionario.php";</script>';
		}else{
			echo '<script type="text/javascript">var decisao=confirm("O ID informado não foi encontrado em nosso banco de dados.\nDeseja tentar novamente?");if(decisao){window.location.href="../web/editarFuncionario.php";}else{window.location.href="../web/recuperarPedidoProjeto.php";}</script>';
			session_destroy();
		}
	}
