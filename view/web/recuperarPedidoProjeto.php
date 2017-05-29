<?php
  session_start();
  include "../php/permissao.php";
  perfil();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script>
              $(document).ready(function () {
                  $('#example').DataTable({
                      "pagingType": "full_numbers",
                      "language": {
                          "sProcessing": "Processando...",
                          "sLengthMenu": "Mostrar _MENU_ registros",
                          "sZeroRecords": "N&atilde;o foram encontrados resultados",
                          "sInfo": "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
                          "sInfoEmpty": "Mostrando de 0 at&eacute; 0 de 0 registros",
                          "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                          "sInfoPostFix": "",
                          "sSearch": "Buscar:",
                          "sUrl": "",
                          "oPaginate": {
                              "sFirst": "Primeiro",
                              "sPrevious": "Anterior",
                              "sNext": "Seguinte",
                              "sLast": "&Uacute;ltimo"
                          }
                      }
                  });
                  $("#iSend").click(function () {
                      var checkbox = $('input[type=checkbox]:checked');
                      if (checkbox.length == 0) {
                          $('#msg').html('<b>Atenção! </b>Marque pelo menos um contato como destinatário!');
                          $('.cxMsg').fadeIn();
                          return false;
                      } else {
                          $('#form_mala_direta').submit();
                      }
                  });
                  $('#valor').mask('000.000.000.000.000,00', {reverse: true});
              });

              function save(status) {
                  var id_projeto = $('#tr_resp_' + $(status).attr('id_projeto'));
                                   
                   if ($(status).val() == "wait") {
                    var r = confirm("Deseja realmente finalizar o pedido?");
                  if (r == true) {

                      $.ajax({
                          type: "POST",
                          url: "../php/statusPedido.php",
                          data: {
                              id: $(status).attr('id_projeto'),
                              status: $(status).attr('value')
                          },
                          success: function (data) {
                          }
                      });
                  }
                      id_projeto.fadeOut();
                  } else {
                      $.ajax({
                          type: "POST",
                          url: "../php/statusPedido.php",
                          data: {
                              id: $(status).attr('id_projeto'),
                              status: $(status).attr('value')
                          },
                          success: function (data) {
                          }
                      });
                      id_projeto.fadeIn();
                  }
              }
               function submeter(botao) {
                var idProjeto = $(botao).attr("projeto");
                        if ($("#iDescricaoResp_"+idProjeto).val() == "") {
                          alert('Atenção!\nOs campos são obrigatórios!');
                          return false;
                      } else {
                          $('#form_resposta').submit();
                      }
              }
              
        </script>
    </head>

    <?php
      include "../../includes/conexao.php";
      $id = filter_input(INPUT_GET, 'id');
      if (isset($_GET["id"])) {
          $sql = "DELETE FROM `protocolo` WHERE `ID_Orcamento` = " . $id;
          $conn->query($sql);
          $sql = "DELETE FROM orcamento WHERE `ID_Orcamento`=" . $id;
          $conn->query($sql);
      }
      $sql = "SELECT SUBSTRING(pr.dt_protocolo, 1, 10) AS data_pedido,
    SUBSTRING(pr.dt_protocolo, 12) AS hora,
    nome_projeto, bairro_projeto, STATUS_Projeto , orc.ID_projeto AS id, telefone_projeto, email_projeto ,orc.INFORMACAO_projeto AS item
    FROM projeto orc
    INNER JOIN protocolo pr ON pr.id_projeto=orc.id_projeto";
      $resultado = $conn->query($sql);
    ?>
    <body>
        <form action='../php/enviar_mala_direta.php' id='form_resposta' method='post'>
            <div class="container">
                <table id="example" class="display" cellspacing="6" width="100%">
                    <thead>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Bairro</th>
                    <th>Status</th>
                    <th>Item</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                        <?php
                          $rowAtual = 0;
                          if ($resultado->num_rows > 0) {
                              while ($row = $resultado->fetch_assoc()) {
                                  if ($row["id"] != $rowAtual) {
                                      echo "<tr>";
                                      echo "<td style='width:105px'>" . $row["data_pedido"] . "</td>";
                                      echo "<td style='width:80px'>" . $row["hora"] . "</td>";
                                      echo "<td>" . $row["nome_projeto"] . "</td>";
                                      echo "<td>" . $row["telefone_projeto"] . "</td>";
                                      echo "<td>" . $row["email_projeto"] . "</td>";
                                      echo "<td>" . $row["bairro_projeto"] . "</td>";
                                      $flag_wait = (strcmp($row['STATUS_Projeto'], 'wait')) ? "" : "checked";
                                      $flag_ready = (strcmp($row['STATUS_Projeto'], 'ready')) ? "" : "checked";
                                      $idProject = $row['id'];
                                      echo "<td style='width:105px' >
                                        <input type='radio' name='status_" . $row["id"] . "' value='ready'  id_projeto = '$idProject' $flag_ready onclick='save(this)'> Análise<br>
                                        <input type='radio' name='status_" . $row["id"] . "' value='wait' id_projeto ='$idProject' $flag_wait onclick='save(this)'> Pronto
                                     </td>";
                                      echo "<td>" . $row["item"] . "</td>";
                                      echo "<td>";
                                      echo "<a href='recuperarPedidoProjeto.php?id=" . $row["id"] . "'><span class='glyphicon glyphicon-remove-sign' title='Excluir'></span></a>";
                                      echo "</td>";
                                      echo "<td>";
                                      echo "<a href='mostrarPedidoProjeto.php?id=" . $row["id"] . "' target='somethingUnique'><span class='glyphicon glyphicon-info-sign' title='Visualizar'></span></a>";
                                      echo "</tr>";
                                      echo "<tr style='display: none' id='tr_resp_" . $idProject . "'> ";
                                      echo "<td colspan='10'>";
                                      echo "<label name=' resposta' style='font-size: 12px; margin-right:5px;'  for='iDescricaoResp_" . $row["id"] . "'>Responder ao Cliente:</label>";
                                      echo "<textarea  rows='2' cols='40' placeholder='Obs.:' class='form-control' id='iDescricaoResp_" . $row["id"] . "' style='width:60%'  name='nDescricaoResp'></textarea>";
                                      echo "<label class='resposta' style='font-size: 15px; margin-left:5px;'  for='iDescricao'>Valor:</label>";
                                      echo "<input type='text' placeholder='R$'pattern='([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$' style='margin-left:15px'  id='valor' />";
                                      echo "<button type = 'button' id = 'iSend'projeto=" . $row["id"] . " name = 'nSend' value = 'respCliente' style = 'margin-left:15px;height:23px; padding-top: 1px' onclick='submeter(this)' class = 'btn btn-primary' ><b>Enviar</b></button>";
                                      echo "</td>";
                                      echo "</tr>";
                                  }
                                  $rowAtual = $row["id"];
                              }
                          }
                        ?>
                    </tbody>
                </table>
                <?php
                  include "../../includes/footer.html";
                ?>
            </div>
        </form>
    </body>
    <?php
      $conn->close();
    ?>
</html>
