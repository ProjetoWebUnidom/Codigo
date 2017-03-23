<?php
	//recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
	$msg = "";
		
        include "../../includes/conexao.php";

            $sql="SELECT * FROM pedidoprojeto WHERE id='".$parametro."'";
            $resultado = $conn->query($sql);
            //resgata os dados na tabela
            if($resultado->num_rows > 0) {
                $msg=$row['nome'].",".$row['bairro'];
            }
	echo $msg;
?>