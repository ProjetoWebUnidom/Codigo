<?php
  $bt=filter_input(INPUT_POST,'nSubId');
  $id=filter_input(INPUT_POST,'nId');
  include "../../includes/conexao.php";
  include "banco-cliente.php";
  if($bt==='btBuscar'){
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
      $celular='';
      $telefone='';
      $uf='';
      $sql="SELECT NOME_Cliente ,BAIRRO_Cliente, CIDADE_Cliente, EMAIL_Cliente,CPF_Cliente,
      DTNASC_Cliente,RG_Cliente,CEP_Cliente, NUMEROCASA_Cliente,UF_Cliente FROM cliente WHERE ID_Cliente='".$id."'";
      $resultado = $conn->query($sql);

      // SELECT CELULAR
      $sql2="SELECT `DDD_Telefone`,`NUMERO_Telefone` FROM `telefone_cliente` WHERE `ID_TipoTelefone` = 2  AND `ID_Cliente`='".$id."'";
      $resultado2 = $conn->query($sql2);

      // SELECT TELEFONE
      $sql3="SELECT `DDD_Telefone`,`NUMERO_Telefone` FROM `telefone_cliente` WHERE `ID_TipoTelefone` = 1  AND `ID_Cliente`='".$id."'";
      $resultado3 = $conn->query($sql3);


      //resgata os dados na tabela
      if($resultado->num_rows > 0) {
          $row = $resultado->fetch_assoc();
          $msg="?id=".$id."&nome="
          .$row['NOME_Cliente']."&bairro="
          .$row['BAIRRO_Cliente']."&cidade="
          .$row['CIDADE_Cliente']."&email="
          .$row['EMAIL_Cliente']."&cpf="
          .$row['CPF_Cliente']."&data_nasc="
          .$row['DTNASC_Cliente']."&rg="
          .$row['RG_Cliente']."&CEP="
          .$row['CEP_Cliente']."&num="
          .$row['NUMEROCASA_Cliente']."&uf="
          .$row['UF_Cliente'];
        }
        if ($resultado2->num_rows > 0 ) {
          $row = $resultado2->fetch_assoc();
          $msg.= "&celular=".$row['DDD_Telefone'].$row['NUMERO_Telefone'];
        }
        if ($resultado3->num_rows > 0 ) {
          $row = $resultado3->fetch_assoc();
          $msg.= "&telefone=".$row['DDD_Telefone'].$row['NUMERO_Telefone'];
        }
      header("location:../web/procurarCliente.php$msg");
      }

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
    $email = $_POST["nEmail"];
    $telefone = $_POST["nTel"];
    $celular  = $_POST["nCel"];
    $simbolos = array(".",",","-",":",";","/"," ");
    $vazio   = array("");
    $cpf = str_replace($simbolos, $vazio, $cpf);
    $rg = str_replace($simbolos, $vazio, $rg);
    $cep = str_replace($simbolos, $vazio, $cep);
    $stmt = $conn->prepare("UPDATE `cliente` SET
    `NOME_Cliente` = ? , `RG_Cliente` = ? ,
    `DTNASC_Cliente` = ? , `CIDADE_Cliente` = ? ,
     `BAIRRO_Cliente` = ? ,`CEP_Cliente` = ? ,
    `EMAIL_Cliente` = ? ,`UF_Cliente` = ?
    WHERE `ID_Cliente` = ? AND `CPF_Cliente`= $cpf ;");
    $stmt->bind_param("sisssissi",$nome,$rg,$datnas,$cidade,$bairro,$cep,$email,$uf,$idcliente);
    $stmt->execute();
    if($telefone!= ""){
      $ddd = substr($telefone, 1, 2);
      $telefone = substr($telefone,5);
      $telefone = str_replace($simbolos, $vazio, $telefone);
      $stmt = $conn->prepare("UPDATE `telefone_cliente` SET `DDD_Telefone` = ? , `NUMERO_Telefone` = ? WHERE `ID_Cliente` = ? AND `ID_TipoTelefone` = 1");
      $stmt->bind_param("iii",$ddd,$telefone,$id);
      $stmt->execute();
      //se nenhuma linha for afetada e pq nao existe telefone
      if($stmt->affected_rows === 0){
        $ddd = substr($telefone, 1, 2);
        $telefone = substr($telefone,5);
        $telefone = str_replace($simbolos, $vazio, $telefone);
        $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
        VALUES ('1',?,?,?)");
        $stmt->bind_param("iii",$id,$ddd,$telefone);
        $stmt->execute();
      }
    }

    if($celular!= ""){
      $ddd = substr($celular, 1, 2);
      $celular = substr($celular,5);
      $celular = str_replace($simbolos, $vazio, $celular);
      $stmt = $conn->prepare("UPDATE `telefone_cliente` SET `DDD_Telefone` = ? , `NUMERO_Telefone` = ? WHERE `ID_Cliente` = ? AND `ID_TipoTelefone` = 2");
      $stmt->bind_param("iii",$ddd,$celular,$id);
      $stmt->execute();

      if($stmt->affected_rows === 0){
        $ddd = substr($celular, 1, 2);
        $celular = substr($celular,5);
        $celular = str_replace($simbolos, $vazio, $celular);
        $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
        VALUES ('2',?,?,?)");
        $stmt->bind_param("iii",$id,$ddd,$celular);
        $stmt->execute();
      }

    }
   header("location:../web/procurarCliente.php?att");
  }
  if($bt==='btExc'){
  $stmt = $conn->prepare("DELETE FROM `telefone_cliente` WHERE `ID_Cliente` = '".$id."'");
  $stmt->execute();
  $stmt = $conn->prepare("DELETE FROM `cliente` WHERE `ID_Cliente` ='".$id."'");
  $stmt->execute();
  header("location:../web/procurarCliente.php?hereex");
  }

  else{

      if($id===''){

      }else{

      }
  }
