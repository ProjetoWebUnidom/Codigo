<?php
$bt=filter_input(INPUT_POST,'nSubId');
$id=filter_input(INPUT_POST,'nId');
include "../../includes/conexao.php";

if($bt==='btBuscar'){
    $nome='';
    $email='';
    $endereco='';
    $bairro='';
    $msg='';
    $sql="SELECT nome,bairro,endereco,email FROM pedidoprojeto WHERE id='".$id."'";
    $resultado = $conn->query($sql);
    
    //resgata os dados na tabela
    if($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $msg="?id=".$id."&nome=".$row['nome']."&bairro=".$row['bairro']."&endereco=".$row['endereco']."&email=".$row['email'];
    }
    header("location:../web/novoCliente.php$msg");
}else{
    if($id===''){
        
    }else{
        
    }
}