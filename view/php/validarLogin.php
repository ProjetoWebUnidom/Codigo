<?php
session_start();
    include "../../includes/conexao.php";
    include "banco-usuario.php";

    $usuario=filter_input(INPUT_GET,'nUsuario');
    $senha=filter_input(INPUT_GET,'nSenha');
    echo $senha;
    echo $usuario;
    $row = buscarUsuario($conn,$usuario,$senha);
    $user=$row['LOGIN_Funcionario'];
    $permissao=$row['ID_TipoUsuario'];
    $redirecionar="";
    if($row['LOGIN_Funcionario']==""){
        $redirecionar="../web/autenticarAdm.php?code=0";
    }else{
        $redirecionar="../web/recuperarPedidoProjeto.php";
    }
    $conn->close();
    header("location:$redirecionar");
