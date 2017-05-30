<?php
	include "../../includes/conexao.php";
	
	function buscarClienteProjeto($conn,$cpf){
		$sql="SELECT ID_Cliente, NOME_Cliente, BAIRRO_Cliente, CIDADE_Cliente, EMAIL_Cliente,
		  DTNASC_Cliente, RG_Cliente, CEP_Cliente, ENDERECO_Cliente, NUMEROCASA_Cliente, UF_Cliente FROM cliente WHERE CPF_Cliente='".$cpf."'";
		 
		return $conn->query($sql);
	}
	
	function buscarCelularProjeto($conn,$id){
		$sql="SELECT `DDD_Telefone`,`NUMERO_Telefone` FROM `telefone_cliente` WHERE `ID_TipoTelefone` = 2  AND `ID_Cliente`='".$id."'";
		$resultado = $conn->query($sql);
		return $resultado->fetch_assoc();
	}
	
	function buscarTelefoneProjeto($conn,$id){
		$sql="SELECT `DDD_Telefone`,`NUMERO_Telefone` FROM `telefone_cliente` WHERE `ID_TipoTelefone` = 1  AND `ID_Cliente`='".$id."'";
		$resultado = $conn->query($sql);
		return $resultado->fetch_assoc();
	}
	
	function salvarProjeto($conn,$nome,$email,$desc,$bairro,$tel,$valor,$stat,$endereco){
		$stmt = $conn->prepare("INSERT INTO `karina`.`projeto` (`NOME_Projeto`, `EMAIL_Projeto`, `INFORMACAO_Projeto`, `BAIRRO_Projeto`, `TELEFONE_Projeto`,
		`STATUS_Projeto`, `ENDERECO_Projeto`) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssss",$nome,$email,$desc,$bairro,$tel,$stat,$endereco);
		$stmt->execute();
		
		$ultimoId = $stmt->insert_id;
		
		$lista=array();
		if(isset($_POST['projeto'])){
			foreach($_POST['projeto'] as $projeto){
				array_push($lista, $projeto);
			}
		}
		
		$tamLista=count($lista);
		for($i=0; $i<$tamLista; $i++){
			$stmt = $conn->prepare("INSERT INTO projeto_categoria (ID_Projeto, ID_TipoCategoria, `VALOR_ProjetoCategoria`) VALUES (?, ?, ?)");
			$stmt->bind_param('iid', $ultimoId, $lista[$i], $valor);
			$stmt->execute();
		}
		
		$stmt->close();
	}