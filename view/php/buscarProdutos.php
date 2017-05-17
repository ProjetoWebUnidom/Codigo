<?php
  session_start();
  include "banco-produto.php";
  include "banco-foto.php";
  include "validarFoto.php";
  include "../../includes/conexao.php";

  $bt = filter_input(INPUT_POST,"buscar");
  $btAlterar = filter_input(INPUT_POST,"alterar");
  $btExcluir = filter_input(INPUT_POST,"excluir");
  $id = $_POST['id'];
  $nome = $_POST['buscaProduto'];
  $nomeProduto = $_POST['nomeProduto'];
  $valProduto = $_POST['valProduto'];
  $IdTipoCategoria = $_POST['ID_TipoCategoria'];
  $descricao = $_POST['descricaoProduto'];
  $diretorio = $_FILES['arquivo']['tmp_name'];
  if(strpos($bt,"btBuscar") !==false ){
    $produto = buscarProduto($conn,$nome);
    $_SESSION['produto'] = $produto;
    header("location: ../web/alterarProduto.php");

}
  if(strpos($btAlterar,"btAlterar") !== false){
    alterarProduto($conn,$nomeProduto,$valProduto,$IdTipoCategoria,$descricao,$id);
    var_dump($_FILES['arquivo']['name']);
    if(isset($_FILES["arquivo"])){
      if(fotoExiste($conn,$diretorio)){
        $upload = validarFoto($_FILES["arquivo"]);
        move_uploaded_file($_FILES["arquivo"]["tmp_name"],$upload);
        $redirecionar = "../web/alterarProduto.php";
        alterarFoto($conn,$upload,$id);
      }elseif(empty($_FILES['produto'])){
        $redirecionar = "../web/alterarProduto.php";
    }
        }
    $_SESSION['ok'];
    header("location:$redirecionar");
}
if(strpos($btExcluir,"btExcluir") !== false){
  excluirProduto($conn,$nomeProduto);
  header("location: ../web/alterarProduto.php?exc");
}
