<?php

    include "../../includes/conexao.php";
    function buscarUsuario($conn,$usuario,$senha){
        $sql = "SELECT * FROM funcionario "
                . "WHERE LOGIN_Funcionario='{$usuario}' AND SENHA_funcionario='{$senha}' AND ID_TipoUsuario>=2";
        $resultado = $conn->query($sql);
        $usuario = mysqli_fetch_assoc($resultado);
        return $usuario;
    }
