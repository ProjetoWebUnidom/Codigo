<?php
/* O validarProduto.php ele realiza toda logica para adicionar um produto
no banco, os seguintes includes trazem os arquivos quem contém as funções necessarias
para o funcionamento do código.*/

    include "../../includes/conexao.php";
    include "banco-produto.php";
    include "banco-foto.php";
    include "validarFoto.php";
//na linha 11 até a 13  as variáveis recebem as informações enviados pelo formulario do adicionarProduto.php.
    $nomeProduto = $_POST["nomeProduto"];
    $valor = $_POST["valProduto"];
    $descricao = $_POST["descricaoProduto"];
//O if ele verifica se está sendo passado o id da categoria do produto
    if(isset($_POST["ID_TipoCategoria"])){
      $idCategoria = $_POST["ID_TipoCategoria"];
    }
//O inserir produto vem do banco-produto e faz a inserção no banco
    if(inserirProduto($conn,$idCategoria,$nomeProduto,$descricao,$valor)){
      $idProduto = $conn->insert_id;//caso seja inserido no banco ele retorna o ultimo id inserido.
      $redirecionar = "../web/adicionarProduto.php?ok=1";//e guarda o endereço no qual deve ser redirecionado.
    }else{
        var_dump("error :" .$conn->erro);
    }
    //Aqui é verificado se existe um arquivo.
    if(isset($_FILES["arquivo"])){
      $upload = validarFoto($_FILES["arquivo"]);//A foto existindo ela é validada por essa função que vem do banco-foto.
        //essa função ela faz um upload e move a foto para a pasta imagens.
      if(move_uploaded_file($_FILES["arquivo"]["tmp_name"],$upload)){
        var_dump($upload);
        $redirecionar = "../web/adicionarProduto.php?ok=1";
      }
      //Aqui é inserido a iamgem e se inserido é redirecionado para o adicionarProduto.
      if(inserirImagem($conn,$idProduto,$upload)){
          header("location:$redirecionar");
      }else{
        echo $conn->erro;
      }


    }
