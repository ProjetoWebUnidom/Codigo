<?php
    include "../../includes/conexao.php";

	function buscarUsuario($conn,$usuario,$senha){

      $stmt = $conn->prepare("SELECT LOGIN_Funcionario,ID_TipoUsuario FROM funcionario WHERE LOGIN_Funcionario = ?
                                AND SENHA_Funcionario = ?");
      $stmt->bind_param("ss",$usuario,$senha);
      $stmt->execute();
      $resultado = $stmt->get_result();
      return $resultado->fetch_assoc();
    }

	function createFuncionario($conn,$permissao,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$telefone,$login,$senha,$status){
            $senha = base64_encode($senha);
            $stmt = $conn->prepare("INSERT INTO `karina`.`Funcionario` (`ID_TipoUsuario`, `CPF_Funcionario`, `NOME_Funcionario`, `RG_Funcionario`, `DTNASC_Funcionario`, `UF_Funcionario`,
	   `CIDADE_Funcionario`, `BAIRRO_Funcionario`, `CEP_Funcionario`, `NUMEROCASA_Funcionario`, `EMAIL_Funcionario`, `TELEFONE_Funcionario`, `LOGIN_Funcionario`, `SENHA_Funcionario`,`ATIVO_Funcionario`)
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,'1')");
		$stmt->bind_param("issssssssissss",$permissao,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$telefone,$login,$senha);
		$stmt->execute();
	}

	function readFuncionario($conn,$cpf){
		$sql="SELECT ID_Funcionario, NOME_Funcionario, BAIRRO_Funcionario, CIDADE_Funcionario, EMAIL_Funcionario,CPF_Funcionario,
		DTNASC_Funcionario,RG_Funcionario,CEP_Funcionario, ID_TipoUsuario, NUMEROCASA_Funcionario,UF_Funcionario, TELEFONE_Funcionario, LOGIN_Funcionario, SENHA_Funcionario, ATIVO_Funcionario FROM Funcionario WHERE CPF_Funcionario='".$cpf."'";
		return $conn->query($sql);
	}

	function updateFuncionario($conn,$cpf,$login,$senha,$nome,$lvlAccess,$rg,$datnas,$cidade,$bairro,$numcas,$cep,$email,$uf,$telefone,$idFuncionario,$status){
		$senha = base64_encode($senha);
                $stmt = $conn->prepare("UPDATE `karina`.`Funcionario`
		SET `CPF_Funcionario` = ?, `LOGIN_Funcionario` = ?, `SENHA_Funcionario` = ?, `NOME_Funcionario` = ?, `ID_TipoUsuario` = ?, `RG_Funcionario` = ?, `DTNASC_Funcionario` = ?, `CIDADE_Funcionario` = ?,
		 `BAIRRO_Funcionario` = ?, `NUMEROCASA_Funcionario` = ?,`CEP_Funcionario` = ?, `EMAIL_Funcionario` = ?, `UF_Funcionario` = ?, `TELEFONE_Funcionario` = ?, `ATIVO_Funcionario` = ?
		WHERE `ID_Funcionario` = ?");
		$stmt->bind_param("ssssissssissssii",$cpf,$login,$senha,$nome,$lvlAccess,$rg,$datnas,$cidade,$bairro,$numcas,$cep,$email,$uf,$telefone,$status,$idFuncionario);
		$stmt->execute();
	}

	function deleteFuncionario($conn,$id){
		$stmt = $conn->prepare("DELETE FROM `karina`.`Funcionario` WHERE `ID_Funcionario` = ?");
		$stmt->bind_param("i",$id);
		$stmt->execute();
	}

	function loginExiste($conn,$login){
		$stmt = $conn->prepare("SELECT LOGIN_Funcionario FROM funcionario WHERE LOGIN_Funcionario = ?");
		$stmt->bind_param("s",$login);
		$stmt->execute();
		$resultado = $stmt->get_result();
		if($resultado->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function getId($conn,$login){
		$stmt = $conn->prepare("SELECT ID_Funcionario FROM funcionario WHERE LOGIN_Funcionario = ?");
		$stmt->bind_param("s",$login);
		$stmt->execute();
		$resultado = $stmt->get_result();
		$row = $resultado->fetch_assoc();
		return $row['ID_Funcionario'];
	}

	function cpfExiste($conn,$cpf){
		$stmt = $conn->prepare("SELECT CPF_Funcionario FROM funcionario WHERE CPF_Funcionario = ?");
		$stmt->bind_param("s",$cpf);
		$stmt->execute();
		$resultado = $stmt->get_result();
		if($resultado->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function emailExiste($conn,$email){
		$stmt = $conn->prepare("SELECT EMAIL_Funcionario FROM funcionario WHERE EMAIL_Funcionario = ?");
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$resultado = $stmt->get_result();
		if($resultado->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
