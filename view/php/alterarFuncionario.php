<meta charset="utf-8">
<?php
	session_start();
	
	$bt=filter_input(INPUT_POST,'nSubId');
	$cpf=filter_input(INPUT_POST,'nCpf');
	$simbolos = array(".",",","-",":",";","/"," ","(",")");
	$vazio   = array("");
	$cpf = str_replace($simbolos, $vazio, $cpf);

	include "../../includes/conexao.php";
	include "banco-Funcionario.php";
	
	if($bt==='btBuscar'){
		$resultado = readFuncionario($conn,$cpf);
		  
		if($resultado->num_rows > 0) {
			$row = $resultado->fetch_assoc();
			$_SESSION["Id_buscado"]=$row['ID_Funcionario'];
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
			$_SESSION["Senha_buscado"] = base64_decode($_SESSION["Senha_buscado"]);
                        $row['SENHA_Funcionario'] = base64_decode($row['SENHA_Funcionario']);
                        $_SESSION["Senha_buscado"] = $row['SENHA_Funcionario'];
			$_SESSION["Status_buscado"]=$row['ATIVO_Funcionario'];
			header("location:../web/editarFuncionario.php");
		}else{
			echo '<script type="text/javascript">var decisao=confirm("O CPF informado não foi encontrado em nosso banco de dados.\nDeseja tentar novamente?");if(decisao){window.location.href="../web/editarFuncionario.php";}else{window.location.href="../web/recuperarPedidoProjeto.php";}</script>';
			session_destroy();
		}	
	}

	if($bt==='btAtt'){
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
		$simbolos = array(".",",","-",":",";","/"," ","(",")");
		$vazio   = array("");
		$datnas = str_replace($simbolos, $vazio, $datnas);
		$cpf = str_replace($simbolos, $vazio, $cpf);
		$rg = str_replace($simbolos, $vazio, $rg);
		$cep = str_replace($simbolos, $vazio, $cep);
		$telefone = str_replace($simbolos, $vazio, $telefone);
		$status=$_POST["nStat"];
		$resultado = readFuncionario($conn,$cpf);
		  
		if($resultado->num_rows > 0) {
			if(!loginExiste($conn,$login)||!cpfExiste($conn,$cpf)||!emailExiste($conn,$email)||getId($conn,$login)==$_SESSION["Id_buscado"]){
				echo $status;
				echo $_SESSION["Id_buscado"];
				updateFuncionario($conn,$cpf,$login,$senha,$nome,$lvlAccess,$rg,$datnas,$cidade,$bairro,$numcas,$cep,$email,$uf,$telefone,$_SESSION["Id_buscado"],$status);
				
				$resultado = readFuncionario($conn,$cpf);
				$row = $resultado->fetch_assoc();
				$_SESSION["Id_buscado"]=$row['ID_Funcionario'];
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
				$_SESSION["Senha_buscado"] = base64_decode($_SESSION["Senha_buscado"]);
                                $row['SENHA_Funcionario'] = base64_decode($row['SENHA_Funcionario']);
                                $_SESSION["Senha_buscado"] = $row['SENHA_Funcionario'];
				$_SESSION["Status_buscado"]=$row['ATIVO_Funcionario'];
				
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
		$resultado = readFuncionario($conn,$cpf);
		  
		if($resultado->num_rows > 0) {
			deleteFuncionario($conn,$id);
			echo '<script type="text/javascript">alert("Funcionario deletado com sucesso!");window.location.href="../web/editarFuncionario.php";</script>';
		}else{
			echo '<script type="text/javascript">var decisao=confirm("O ID informado não foi encontrado em nosso banco de dados.\nDeseja tentar novamente?");if(decisao){window.location.href="../web/editarFuncionario.php";}else{window.location.href="../web/recuperarPedidoProjeto.php";}</script>';
			session_destroy();
		}
	}
