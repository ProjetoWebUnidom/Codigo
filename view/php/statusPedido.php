<?php

  include "../../includes/conexao.php";
  include "banco-cliente.php";

  
  $sql = "UPDATE projeto SET STATUS_Projeto = '" . $_POST["status"] . "' WHERE ID_Projeto = " . $_POST["id"] . "";
  $resultado = $conn->query($sql);
  return true;
  