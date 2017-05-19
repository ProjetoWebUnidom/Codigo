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
        <script src="../../js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
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
                  jQuery("#iCpf").mask("999.999.999-99");
                  jQuery("#iDtNasc,#iDtCad,#iDtUltAce").mask("99/99/9999");
                  $("#iLimpar").click(function () {
                      $('#iCpf').val('');
                      $('#iNome').val('');
                      $('#iDtNasc').val('');
                      $('#iDtCad').val('');
                      $('#iDtUltAce').val('');
                  });

              });
              function relatorioCliente() {
                  window.open('../../classes/relatorio_PDF/relatorioClientes.php', '_blank');
              }


        </script>
    </head>

    <?php
      include "../../includes/conexao.php";

      function inverteData($data) {
          if (count(explode('/', $data)) > 1) {
              return implode('-', array_reverse(explode("/", $data)));
          } elseif (count(explode('-', $data)) > 1) {
              return implode('/', array_reverse(explode("-", $data)));
          }
      }

      // Variável do tipo array para armazenar as condições quando algum dado for passado nos campos de filtro;
      $condition = array();
      $condition = ["WHERE 1 = 1 "];
      if (isset($_POST['nCpf']) && $_POST['nCpf'] != '') {
          $cpf = str_replace(['.', '-'], '', $_POST['nCpf']);
          $condition[] = 'AND CPF_Cliente = ' . $cpf;
      }
      if (isset($_POST['nNome']) && $_POST['nNome'] != '') {
          $condition[] = "AND NOME_Cliente LIKE '%" . $_POST['nNome'] . "%'";
      }
      if (isset($_POST['nDtNasc']) && $_POST['nDtNasc'] != '') {
          $condition[] = "AND DATA_NASC = '" . $_POST['nDtNasc'] . "'";
      }
      if (isset($_POST['nDtCad']) && $_POST['nDtCad'] != '') {
          $condition[] = "AND DATA_CAD = '" . $_POST['nDtCad'] . "'";
      }
      if (isset($_POST['nDtUltAce']) && $_POST['nDtUltAce'] != '') {
          $condition[] = "AND DATA_ULT_ACESSO = '" . $_POST['nDtUltAce'] . "'";
      }

      $condition_sql = implode(" ", $condition);
      $sql = "SELECT CPF_Cliente,
	NOME_Cliente,
        DTNASC_Cliente AS DATA_NASC, 
        UF_Cliente, 
        CIDADE_Cliente, 
        BAIRRO_Cliente,
        EMAIL_Cliente,
        DDD_Telefone,
        NUMERO_Telefone FROM cliente
        INNER join telefone_cliente ON (cliente.ID_Cliente = telefone_cliente.ID_Cliente) ";
      $sql = $sql . $condition_sql;
      $resultado = $conn->query($sql);

      $disabled = (empty($sql)) ? 'disabled' : '';
    ?>
    <body>
        <div class="container">
            <fieldset >
                <legend>Filtro</legend>
                <form action="clientesCadastrados.php" method="post" >

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="col-sm-10" style="font-size: 15px; margin-right:5px" for="iCpf">CPF:</label>
                        </div>
                        <div class="col-sm-7">
                            <label class="col-sm-4" style="font-size: 15px"for="iNome">Nome: </label>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-sm-12" style="font-size: 15px; margin-right: 5px"for="iDtNasc">Dt. Nasc.:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="iCpf"  name="nCpf" placeholder="___.___.___-__" value="<?php echo "" . isset($_POST['nCpf']) ? $_POST['nCpf'] : '' ?>">
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="iNome"  name="nNome" value="<?php echo "" . isset($_POST['nNome']) ? $_POST['nNome'] : '' ?>" placeholder="Encontre por nome">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="iDtNasc"  name="nDtNasc" placeholder="__/__/____" value="<?php echo "" . isset($_POST['nDtNasc']) ? $_POST['nDtNasc'] : '' ?>">
                        </div>
                        <br><br><br>
                    </div>
                    <div  class="col-sm-12" >
                        <div style="float: left;">
                            <button type="button" id="iLimpar" name="nLimpar"  value="btBuscar" class="btn">Limpar</button>
                            <button type="submit" id="subId" name="nSubId" style="align-items: center;"  class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </fieldset>
            <br>
            <!--inicio Lista de clientes Cadastrados-->
            <fieldset  id="result">
                <legend>Clientes cadastrados
                    <button type="button"  style="float: right;  font-size:12px;height:27px " id="imprimir" <?php $disabled ?> class="btn btn-primary" onclick="relatorioCliente()" ><i class="fa fa-print" aria-hidden="true"></i> Imprimir Relatório</button>
                </legend>

                <div style="background: #F8F8FF">
                    <table id="example" class="display" cellspacing="6" width="100%" >
                        <thead>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>Telefone</th>
                        <th>Cidade/Estado</th>
                        <th>E-mail</th>
                        </thead>
                        <tfoot>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>Telefone</th>
                        <th>Cidade/Estado</th>
                        <th>E-mail</th>
                        </tfoot>
                        <tbody>
                            <?php
                              $rowAtual = 0;
                              if ($resultado->num_rows > 0) {
                                  while ($row = $resultado->fetch_assoc()) {
                                      if ($row["CPF_Cliente"] != $rowAtual) {
                                          echo "<tr>";
                                          echo "<td>" . $row["CPF_Cliente"] . "</td>";
                                          echo "<td>" . $row["NOME_Cliente"] . "</td>";
                                          echo "<td>" . $row["DATA_NASC"] . "</td>";
                                          echo "<td>" . $row["DDD_Telefone"] . " - " . $row["NUMERO_Telefone"] . "</td>";
                                          echo "<td>" . $row["CIDADE_Cliente"] . " - " . $row["UF_Cliente"] . "</td>";
                                          echo "<td>" . $row["EMAIL_Cliente"] . "</td>";
                                          echo "</tr>";
                                      }
                                      $rowAtual = $row["CPF_Cliente"];
                                  }
                              }
                            ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <?php
              include "../../includes/footer.html";
            ?>
        </div>
    </body>
    <?php
      $conn->close();
    ?>
</html>