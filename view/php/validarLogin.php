<?php
    session_start();
    include "../../includes/conexao.php";
    include "banco-funcionario.php";
    include "permissao.php";

    $usuario=filter_input(INPUT_POST,'nUsuario');
    $senha=filter_input(INPUT_POST,'nSenha');
    //Codifica a senha
    $senha =  base64_encode($senha);

    echo $senha;
    echo $usuario;
    $row = buscarUsuario($conn,$usuario,$senha);
    $user= $row["LOGIN_Funcionario"];
    $permissao= $row["ID_TipoUsuario"];
    $redirecionar="";

    if(empty($user)){
        $redirecionar="../web/autenticarAdm.php?code=0";
        session_destroy();
        unset($_SESSION["login"]);
    }else{
      permissaoAcesso($permissao);
      $redirecionar = "../web/recuperarPedidoProjeto.php";
    }
    $conn->close();
    header("location:$redirecionar");
