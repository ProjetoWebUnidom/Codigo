<?php
session_start();
    include "../../includes/conexao.php";
    include "banco-funcionario.php";

    $usuario=filter_input(INPUT_POST,'nUsuario');
    $senha=filter_input(INPUT_POST,'nSenha');
    echo $senha;
    echo $usuario;
    $row = buscarUsuario($conn,$usuario,$senha);
    $user= $row->fetch_array(MYSQLI_NUM);
    var_dump($user);
    $permissao= $user[1];
    $redirecionar="";
    if($user[0]==""){
        $redirecionar="../web/autenticarAdm.php?code=0";
    }else{
      if($permissao==4){
        $redirecionar="../web/recuperarPedidoProjeto.php";
      }elseif($permissao==3){
        $redirecionar="../web/recuperarPedidoProjeto.php?fun=1";
      }

    }
    $conn->close();
    header("location:$redirecionar");
