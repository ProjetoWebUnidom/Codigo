<?php

  //Funcao para inserir um cliente
function inserirCliente($conn,$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$endereco,$telefone,$celular,$simbolos){
  $stmt = $conn->prepare("INSERT INTO `karina`.`cliente` (`CPF_Cliente`, `NOME_Cliente`, `RG_Cliente`, `DTNASC_Cliente`, `UF_Cliente`,
   `CIDADE_Cliente`, `BAIRRO_Cliente`, `CEP_Cliente`, `NUMEROCASA_Cliente`, `EMAIL_Cliente`,`ENDERECO_Cliente`,`Ativo_Cliente`)
  VALUES (?,?,?,?,?,?,?,?,?,?,?,1)");
    $stmt->bind_param("sssssssisss",$cpf,$nome,$rg,$datnas,$uf,$cidade,$bairro,$cep,$numcas,$email,$endereco);
    $stmt->execute();
    $id =  $stmt->insert_id;
    if($telefone!= ""){
      $ddd = substr($telefone, 1, 2);
      $telefone = substr($telefone,5);
      $telefone = str_replace($simbolos,"", $telefone);
      $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
      VALUES ('1',?,?,?)");
      $stmt->bind_param("iss",$id,$ddd,$telefone);
      $stmt->execute();
    }
    if($celular!= ""){
      $ddd = substr($celular, 1, 2);
      $celular = substr($celular,5);
      $celular = str_replace($simbolos,"", $celular);
      $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
      VALUES ('2',?,?,?)");
      $stmt->bind_param("iss",$id,$ddd,$celular);
      $stmt->execute();
    }
}

    //Funcao para pesquisar um cliente
function buscarCliente($conn,$id){
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
  $end='';
  $celular='';
  $telefone='';
  $uf='';
  $status='';
  $sql="SELECT NOME_Cliente ,BAIRRO_Cliente, CIDADE_Cliente, EMAIL_Cliente,CPF_Cliente,
  DTNASC_Cliente,RG_Cliente,CEP_Cliente, NUMEROCASA_Cliente,UF_Cliente ,`ENDERECO_Cliente`, Ativo_Cliente FROM cliente WHERE ID_Cliente='".$id."'";
  $resultado = $conn->query($sql);
  // SELECT CELULAR
  $sql="SELECT `DDD_Telefone`,`NUMERO_Telefone` FROM `telefone_cliente` WHERE `ID_TipoTelefone` = 2  AND `ID_Cliente`='".$id."'";
  $resultado2 = $conn->query($sql);
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
      .$row['UF_Cliente']."&end="
      .$row['ENDERECO_Cliente']."&status="
      .$row['Ativo_Cliente'];
    }
    if ($resultado2->num_rows > 0 ) {
      $row = $resultado2->fetch_assoc();
      $msg.= "&celular=".$row['DDD_Telefone'].$row['NUMERO_Telefone'];
    }
    if ($resultado3->num_rows > 0 ) {
      $row = $resultado3->fetch_assoc();
      $msg.= "&telefone=".$row['DDD_Telefone'].$row['NUMERO_Telefone'];
    }
    return $msg;
}
  //Funcao para verificar se cpf existe
function cpfExiste($conn,$cpf){
    $sql = "SELECT * FROM cliente WHERE `CPF_Cliente` ='".$cpf."'";
    $resultado = $conn->query($sql);
    return $resultado;
}
    //Funcao para verificar se email existe
function emailExiste($conn,$email){
  $sql = "SELECT * FROM cliente WHERE `EMAIL_Cliente` ='".$email."'";
  $resultado = $conn->query($sql);
  return $resultado;
}
    //Funcao para verificar se email existe na hora de atualizar
function emailExisteAtt($conn,$email,$idcliente){
  $sql = "SELECT * FROM cliente WHERE `EMAIL_Cliente` ='".$email."' AND `ID_Cliente` <>'".$idcliente."'" ;
  $resultado = $conn->query($sql);
  return $resultado;
}
  //Funcao para verificar se cpf existe na hora de atualizar
function cpfExisteAtt($conn,$cpf,$idcliente){
  $sql = "SELECT * FROM cliente WHERE `CPF_Cliente` ='".$cpf."' and `ID_Cliente` <>'".$idcliente."'" ;
  $resultado = $conn->query($sql);
  return $resultado;
}

  //Funcao para verificar se telefone existe
function telefoneExiste($conn,$idcliente,$tipo){
  $sql = "SELECT * FROM `telefone_cliente` AS t INNER JOIN `cliente` AS c WHERE  t.`ID_Cliente` ='".$idcliente."'
  AND t.`ID_Cliente` = c.`ID_Cliente` AND `ID_TipoTelefone`  = '".$tipo."'";
  $resultado = $conn->query($sql);
  return $resultado;
}
  //Funcao para inativar
function inativarCliente($conn,$idcliente,$cpf){
    $stmt = $conn->prepare("UPDATE `cliente` SET `Ativo_Cliente` = b'0' WHERE `ID_Cliente` = ? and `CPF_Cliente` ='".$cpf."'");
    $stmt->bind_param("i",$idcliente);
    $stmt->execute();
    return $stmt;
}
  //Funcao para atualizar um cliente
function attCliente($conn,$nome,$rg,$cpf,$datnas,$cidade,$bairro,$cep,$email,$end,$uf,$idcliente,$telefone,$celular,$numcas,$simbolos,$status){
  $stmt = $conn->prepare("UPDATE `cliente` SET
  `NOME_Cliente` = ? , `RG_Cliente` = ? ,
  `DTNASC_Cliente` = ? , `CIDADE_Cliente` = ? ,
   `BAIRRO_Cliente` = ? ,`CEP_Cliente` = ? ,
  `EMAIL_Cliente` = ? ,`ENDERECO_Cliente`= ?,
  `UF_Cliente` = ? , `CPF_Cliente`= ?,
  `NUMEROCASA_Cliente` = ?, `Ativo_Cliente`= ?
   WHERE `ID_Cliente` = ?  ;");
  $stmt->bind_param("sssssisssssii",$nome,$rg,$datnas,$cidade,$bairro,$cep,$email,$end,$uf,$cpf,$numcas,$status,$idcliente);
  $stmt->execute();
  if($telefone!=""){
    $ddd = substr($telefone, 1, 2);
    $telefone = substr($telefone,5);
    $telefone = str_replace($simbolos,"", $telefone);
    if(telefoneExiste($conn,$idcliente,1)->num_rows > 0){
      $stmt = $conn->prepare("UPDATE `telefone_cliente` SET `DDD_Telefone` = ? ,`NUMERO_Telefone` = ? WHERE `ID_Cliente` = ? AND `ID_TipoTelefone` = 1");
      $stmt->bind_param("ssi",$ddd,$telefone,$idcliente);
      $stmt->execute();
    }else {
      $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
      VALUES ('1',?,?,?)");
      $stmt->bind_param("iss",$idcliente,$ddd,$telefone);
      $stmt->execute();
    }
    }
  if($celular!=""){
    $ddd = substr($celular, 1, 2);
    $celular = substr($celular,5);
    $celular = str_replace($simbolos, "", $celular);
    if(telefoneExiste($conn,$idcliente,2)->num_rows > 0){
    $stmt = $conn->prepare("UPDATE `telefone_cliente` SET `DDD_Telefone` = ? , `NUMERO_Telefone` = ? WHERE `ID_Cliente` = ? AND `ID_TipoTelefone` = 2");
    $stmt->bind_param("ssi",$ddd,$celular,$idcliente);
    $stmt->execute();
  }else{
      $stmt = $conn->prepare("INSERT INTO `telefone_cliente` (`ID_TipoTelefone`, `ID_Cliente`, `DDD_Telefone`, `NUMERO_Telefone`)
      VALUES ('2',?,?,?)");
      $stmt->bind_param("iss",$idcliente,$ddd,$celular);
      $stmt->execute();
    }
}
}
