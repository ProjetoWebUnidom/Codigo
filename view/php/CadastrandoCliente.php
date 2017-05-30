<?php

$bt = filter_input(INPUT_POST,'nEnviar');
include "../../includes/conexao.php";
include "banco-cliente.php";
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
$endereco = $_POST["nEnd"];
$celular = $_POST["nCel"];
$simbolos = array(".",",","-",":",";","/"," ");
$cpf = str_replace($simbolos,"", $cpf);
$rg = str_replace($simbolos,"", $rg);
$cep = str_replace($simbolos,"", $cep);

if($bt==='btCadastrar'){
  if(cpfExiste($conn,$cpf)->num_rows == 0){
    if(emailExiste($conn,$email)->num_rows == 0){
  inserirCliente($conn,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$endereco,$telefone,$celular,$simbolos);
  header("location:../web/novoCliente.php?ok=1");
    }else {
    header("location:../web/novoCliente.php?email=1");
    }
  }else{
  header("location:../web/novoCliente.php?cpf=1");
  }
}
