<?php
    function buscarUsuario($conn,$usuario,$senha){
      $stmt = $conn->prepare("SELECT LOGIN_Funcionario,ID_TipoUsuario FROM funcionario WHERE LOGIN_Funcionario = ?
                                AND SENHA_Funcionario = ? AND ID_TipoUsuario>=2");
      $stmt->bind_param("ss",$usuario,$senha);
      $stmt->execute();
      $resultado = $stmt->get_result();
      return $resultado;
    }
