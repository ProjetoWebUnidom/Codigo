<?php
	include "../../includes/conexao.php";
	include "banco-funcionario.php";
	$id = $_POST['nId'];

	if(buscarFuncionario($conn,$id)){
		header("location: ../web/novoFuncionario.php?ok=1&id={$id}");
	}
