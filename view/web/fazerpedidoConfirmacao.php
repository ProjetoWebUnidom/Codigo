<?php
session_start();
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../css/estilofooter.css">
  <script src="../..js/jquery.js"></script>
  <script src="../../js/mascaras.js" type="text/javascript"></script>
  <script src="/lib/jquery-1.12.2.min.js"></script>
  <script src="/lib/bootstrap.min.js"></script>
</head>
<?php
    include "../../includes/header.html";
?>

<body>
<?php


//salva os dados dos campos nas variaveis
    $nome=filter_input(INPUT_POST,'nNome');
    $bairro=filter_input(INPUT_POST,'nBairro');
    $endereco=filter_input(INPUT_POST,'nEnd');
    $detalhe=filter_input(INPUT_POST,'nDet');
    $celular=filter_input(INPUT_POST,'nCel');
    $email=filter_input(INPUT_POST,'nEmail');

//retira o '()' e o '-' do numero de telefone EX: (00) 00000-0000 = 00000000000
     $telefone3 = str_replace(" ", "", $celular);
     $tel1 = str_replace("(", "", $telefone3);
     $tel2 = str_replace(")", "", $tel1);
     $telefone1 = str_replace("-","", $tel2);


//salva os dados do tipo de projeto solicitado na variavel $lista
    $lista="";
    $qtd=0;
    if(isset($_POST['projeto'])){
        foreach($_POST['projeto'] as $projeto){
            $lista=$lista.",".$projeto;
            $qtd++;
        }
        $lista=  substr($lista, 1);
    }


include "../../includes/conexao.php";

$status = "Em analise";

insertProjeto($conn, $nome, $email, $detalhe, $bairro, $telefone1, $status, $endereco);

$last_id = $conn->insert_id;
$ultimoIdInserido = $last_id;
$result="";

$l = explode(",", $lista);

for($i=0; $i<$qtd; $i++){
$result = selecionarIdLista($conn, $l[$i]);
insert2($conn, $ultimoIdInserido, $result['ID_TipoCategoria']);
}
?>


              <div class="alert alert-info">
                <strong>Confirmação!</strong> Seu pedido foi enviado com sucesso!<br/><br/><h4>Numero do Protocolo de pedido:</h4><h3><?php
                include "../../includes/conexao.php";

                $result =buscapedido($conn, $ultimoIdInserido);
                function buscapedido($conn, $ultimoIdInserido){
                $stmt = "SELECT NUM_Protocolo from protocolo where ID_Projeto = ?";
                $stmt = $conn->prepare($stmt);
                $stmt->bind_param('i', $ultimoIdInserido);
                $stmt->execute();
                $resultado = $stmt->get_result();
                return $resultado-> fetch_assoc();
                $resultado->NUM_Protocolo;
              }
              $Npedido = $result['NUM_Protocolo'];

              echo $Npedido;

                 ?><h4></br>Entraremos em contato no prazo de 24 horas!</h4>
                </h3><br/> Por favor, guarde este protocolo para obter informações sobre o seu pedido!
              </div>

              <?php
                  include "../../includes/footer.html";
              ?>

<?php

//cadastra um novo orçamento no banco de dados
function insertProjeto($conn, $nome, $email, $detalhe, $bairro, $telefone1, $status, $endereco){
        $stmt = $conn->prepare("INSERT INTO projeto (NOME_Projeto, EMAIL_Projeto, INFORMACAO_Projeto, BAIRRO_Projeto, TELEFONE_Projeto, STATUS_Projeto, ENDERECO_Projeto) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssiss', $nome, $email,$detalhe, $bairro, $telefone1, $status, $endereco);
        $stmt->execute();
        $stmt->close();
}
function selecionarIdLista($conn, $l){
        $stmt = $conn->prepare("SELECT ID_TipoCategoria FROM tipo_categoria WHERE DESCRICAO_TipoCategoria = ?");
        $stmt->bind_param('s', $l);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado-> fetch_assoc();
        $resultado ->ID_TipoCategoria;
        $stmt->close();

}
function insert2($conn, $ultimoIdInserido, $result){
        $stmt = $conn->prepare("INSERT INTO projeto_categoria (ID_Projeto, ID_TipoCategoria) VALUES (?, ?)");
        $stmt->bind_param('ii', $ultimoIdInserido, $result);
        $stmt->execute();
        $stmt->close();
}
?>
</body>
