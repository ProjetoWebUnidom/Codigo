<?php
session_start();
    include "../../includes/conexao.php";
        
    $usuario=filter_input(INPUT_GET,'nUsuario');
    $senha=filter_input(INPUT_GET,'nSenha');
    echo "<h1>$senha</h1>";
    echo "<h1>$usuario</h1>";
    $sql = "SELECT nome,idPermissao from funcionario "
            . "WHERE usuario='".$usuario."' AND senha='".$senha."' AND idPermissao>=2";
    $resultado = $conn->query($sql);
    $row = $resultado->fetch_assoc();
    $user=$row['nome'];
    $permissao=$row['idPermissao'];
    $redirecionar="";
    if($row['nome']==""){
        $redirecionar="../web/autenticarAdm.php?code=0";
    }else{
        $redirecionar="../web/recuperarPedidoProjeto.php";
    }
    $conn->close();
    header("location:$redirecionar");