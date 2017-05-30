<?php

$bt = filter_input(INPUT_POST,'nEnviar');

include "../../includes/conexao.php";
include "banco-Funcionario.php";

$permissao = 2;
$status = 0;
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
$telefone = $_POST["nTel"];
$login = $_POST["nLog"];
$senha = $_POST["nSenha"];
$simbolos = array(".",",","-",":",";","/"," ","(",")");
$vazio   = array("");
$cpf = str_replace($simbolos, $vazio, $cpf);
$rg = str_replace($simbolos, $vazio, $rg);
$cep = str_replace($simbolos, $vazio, $cep);
$telefone = str_replace($simbolos, $vazio, $telefone);

if($bt==='btCadastrar'){
    if(!loginExiste($conn,$login)&&!cpfExiste($conn,$cpf)&&!emailExiste($conn,$email)){
		createFuncionario($conn,$permissao,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$telefone,$login,$senha,$status);
		echo '<script type="text/javascript">alert("Funcionário cadastrado com sucesso.");window.location.href="../web/novoFuncionario.php";</script>';
	}else{
		echo '<script type="text/javascript">alert("O login, cpf ou´e-mail informado já existe.");window.location.href="../web/novoFuncionario.php";</script>';
	}
}

