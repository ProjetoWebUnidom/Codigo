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
$celular = $_POST["nCel"];
$simbolos = array(".",",","-",":",";","/"," ");
$vazio   = array("");
$cpf = str_replace($simbolos, $vazio, $cpf);
$rg = str_replace($simbolos, $vazio, $rg);
$cep = str_replace($simbolos, $vazio, $cep);

if($bt==='btCadastrar'){
  echo "herebt";
  $stmt = $conn->prepare("INSERT INTO `karina`.`cliente` (`CPF_Cliente`, `NOME_Cliente`, `RG_Cliente`, `DTNASC_Cliente`, `UF_Cliente`,
   `CIDADE_Cliente`, `BAIRRO_Cliente`, `CEP_Cliente`, `NUMEROCASA_Cliente`, `EMAIL_Cliente`)
  VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isissssiis",$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email);
    $stmt->execute();
    $id =  $stmt->insert_id;

    if($telefone!= ""){
      $ddd = substr($telefone, 1, 2);
      $telefone = substr($telefone,5);
      $telefone = str_replace($simbolos, $vazio, $telefone);
      $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
      VALUES ('1',?,?,?)");
      $stmt->bind_param("iii",$id,$ddd,$telefone);
      $stmt->execute();
            echo "$telefone cadastrado   ";
    }
    if($celular!= ""){
      $ddd = substr($celular, 1, 2);
      $celular = substr($celular,5);
      $celular = str_replace($simbolos, $vazio, $celular);
      $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
      VALUES ('2',?,?,?)");
      $stmt->bind_param("iii",$id,$ddd,$celular);
      $stmt->execute();
            echo "$celular cadastrado   ";
    }

}
header("location:../web/novoCliente.php?1");
