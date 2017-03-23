<?php

    $nome=filter_input(INPUT_POST,'nNome');
    $opcaoTipo=filter_input(INPUT_POST,'optradio');
    $paraquem=filter_input(INPUT_POST,'selPara');
    $detalhe=filter_input(INPUT_POST,'nSug');
    $email=filter_input(INPUT_POST,'nEmail');
    
    if($opcaoTipo=="sugestao"){
        $opcaoTipo=0;
    }else{
        $opcaoTipo=1;
    }
    
    include "../../includes/conexao.php";
    
    $query1 = 'INSERT INTO sugestao(nome,email,paraquem,info,tipo) 
        VALUES("'.$nome.'","'.$email.'","'.$paraquem.'","'.$detalhe.'","'.$opcaoTipo.'")';
    
    $conn->query($query1);

    $conn->close();
    header("location:../web/index.php");