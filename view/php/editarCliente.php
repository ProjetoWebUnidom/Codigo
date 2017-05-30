<?php
  $bt=filter_input(INPUT_POST,'nSubId');
  $id=filter_input(INPUT_POST,'nId');
  include "../../includes/conexao.php";
  include "banco-cliente.php";
  //QUANDO O BOTAO btBuscar for presionado
  if($bt==='btBuscar'){
      $msg = buscarCliente($conn,$id);
      header("location:../web/editarCliente.php$msg");
      }
      //QUANDO O BOTAO btAtt for presionado
  if($bt==='btAtt'){
    $idcliente = $_POST["nId"];
    $cpf = $_POST["nCpf"];
    $nome = $_POST["nNome"];
    $rg = $_POST["nRG"];
    $datnas = $_POST["nDtNasc"];
    $uf = $_POST["nUF"];
    $cidade = $_POST["nCidade"];
    $bairro = $_POST["nBairro"];
    $cep = $_POST["nCEP"];
    $numcas = $_POST["nNum"];
    $end =  $_POST["nEnd"];
    $email = $_POST["nEmail"];
    $telefone = $_POST["nTel"];
    $celular  = $_POST["nCel"];
    $simbolos = array(".",",","-",":",";","/"," ");
    $cpf = str_replace($simbolos,"", $cpf);
    $rg = str_replace($simbolos,"", $rg);
    $cep = str_replace($simbolos,"", $cep);
      //Verifica que existe o email ja esta cadastrado no sistema
    if(emailExisteAtt($conn,$email,$idcliente)->num_rows == 0){
      //Verifica que existe o cpf ja esta cadastrado no sistema
      if(cpfExisteAtt($conn,$cpf,$idcliente)->num_rows == 0){
        attCliente($conn,$nome,$rg,$cpf,$datnas,$cidade,$bairro,$cep,$email,$end,$uf,$idcliente,$telefone,$celular,$numcas,$simbolos,$status);
        header("location:../web/editarCliente.php?att=1");
      }else {
        header("location:../web/editarCliente.php?cpf=1");
      }
    }else{
        header("location:../web/editarCliente.php?email=1");
    }
  }
    //QUANDO O BOTAO btExc for presionado
  if($bt==='btExc'){
    $idcliente = $_POST["nId"];
    $cpf = $_POST["nCpf"];
    $simbolos = array(".",",","-",":",";","/"," ");
    $cpf = str_replace($simbolos,"", $cpf);
    $result = inativarCliente($conn,$idcliente,$cpf);
    header("location:../web/editarCliente.php?exc=1");
  }
  else{
      if($id===''){
      }else{
      }
  }
