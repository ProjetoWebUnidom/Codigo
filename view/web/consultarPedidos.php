<?php
session_start();
 ?>

 <!DOCTYPE html>
 <html>
     <head>


<meta http-equiv="content-type" content="text/html;charset=utf-8">

         <meta charset="UTF-8">

         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="../../css/estilofooter.css">
         <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
         <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>

     </head>
     <body>



       <div class="container">
           <?php
               include "../php/permissao.php";
               redirecionarSession();
           ?>

       <div class="container">
           <?php
               include "../../includes/header.html";
           ?>
           <form method="post"  id="formExemplo" data-toggle="validator" role="form" class="form-horizontal">

           <div class="form-group">
             <h5> Digite seu Protocolo de pedido para pesquisar:</h5>
             <label class="control-label col-sm-2" for="iProtocolo">Protocolo:</label>
             <div class="col-sm-4">
            <input type="text" class="form-control" id="iProtocolo" name="nProtocolo" required placeholder="Insira o protocolo do seu pedido">
             </div>
             <div>
               <button type="submit" id="subId" name="nSubId" value="btBuscar" class="btn btn-primary">Consultar</button>
             </div>
             <br/>
            </div>
</form>

         <?php
         include "../../includes/conexao.php";
             $protocolo=filter_input(INPUT_POST,'nProtocolo');


//seleciona os orcamentos do cliente
             $sql = "SELECT DISTINCT pt.NUM_Protocolo, pj.NOME_Projeto, pj.EMAIL_Projeto, pj.STATUS_Projeto, pj.ENDERECO_Projeto,
                        tc.DESCRICAO_TipoCategoria, pc.VALOR_ProjetoCategoria
                         FROM projeto pj
                        INNER JOIN protocolo pt ON pt.id_projeto=pj.id_projeto
                        INNER JOIN projeto_categoria pc ON pc.id_projeto=pj.id_projeto
                        INNER JOIN tipo_categoria tc ON tc.ID_TipoCategoria = pc.ID_TipoCategoria
                        and pt.NUM_Protocolo = ?";

                        $stmt=$conn->prepare($sql);
                        $stmt->bind_param('s',$protocolo);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        $row = $resultado;
                       ?>

                       <table id="example" class="display" cellspacing="6" width="100%">
                           <thead>
                               <th>Numero do Pedido</th>
                               <th>Nome</th>
                               <th>E-mail</th>
                               <th>Status do pedido</th>
                               <th>Endereço</th>
                               <th>Projeto Solicitado</th>
                               <th>Valor do Projeto</th>
                           </thead>
                           </body>

                     <?php
                           while ($row = $resultado->fetch_assoc()){
                             echo "<tr>";
                             echo "<td>".$row["NUM_Protocolo"]."</td>";
                             echo "<td>".$row["NOME_Projeto"]."</td>";
                             echo "<td>".$row["EMAIL_Projeto"]."</td>";
                             echo "<td>".$row["STATUS_Projeto"]."</td>";
                             echo "<td>".$row["ENDERECO_Projeto"]."</td>";
                             echo "<td>".$row["DESCRICAO_TipoCategoria"]."</td>";
                             echo "<td>R$: ".$row["VALOR_ProjetoCategoria"]."</td>";}
                     ?>
             </tbody>
         </table>


                  <script>

                  $(document).ready(function() {
                      $('#example').DataTable( {
                          "pagingType": "full_numbers",
                          "language": {
                              "sProcessing":   "Processando...",
                              "sLengthMenu":   "Mostrar _MENU_ registros",
                              "sZeroRecords":  "N&atilde;o foram encontrados resultados",
                              "sInfo":         "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",

                              "sInfoEmpty":    "Mostrando de 0 at&eacute; 0 registros",

                              "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                              "sInfoPostFix":  "",
                              "sSearch":       "Filtrar:",
                              "sUrl":          "",
                          "oPaginate": {
                              "sFirst":    "Primeiro",
                              "sPrevious": "Anterior",
                              "sNext":     "Seguinte",
                              "sLast":     "&Uacute;ltimo"
                          }
                          }
                      } );
                  } );
                  </script>
         <?php
             include "../../includes/footer.html";
             $conn->close();
         ?>
         </div>
     </body>
 </html>
