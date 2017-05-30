<?php
session_start();
include "../php/permissao.php";
perfil();
blockAcess();
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

        $(document).ready(function() {
            $('#example').DataTable( {
                "pagingType": "full_numbers",
                "language": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "N&atilde;o foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 at&eacute; 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
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
    </head>

<?php

    include "../../includes/conexao.php";
    $id=filter_input(INPUT_GET,'id');
    if(isset($_GET["id"])){
        $sql = "DELETE FROM `karina`.`protocolo` WHERE `ID_Protocolo`=".$id;
        $conn->query($sql);
        $sql = "DELETE FROM orcamento WHERE id=".$id;
        $conn->query($sql);
    }
    $sql = "SELECT ID_Cliente as id , NOME_Cliente ,BAIRRO_Cliente, CIDADE_Cliente, EMAIL_Cliente,`CPF_Cliente`,CEP_Cliente,UF_Cliente FROM cliente WHERE Ativo_Cliente = 1 ";
    $resultado = $conn->query($sql);

            ?>
            <body>
                <div class="container">
                <table id="example" class="display" cellspacing="6" width="100%">
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>E-mail</th>
                        <th>UF</th>
                        <th>CEP</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tfoot>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>E-mail</th>
                        <th>UF</th>
                        <th>CEP</th>
                        <th></th>
                        <th></th>
                    </tfoot>
                    <tbody>
                        <?php
                        $rowAtual=0;
                        if($resultado->num_rows > 0) {
                            while($row = $resultado->fetch_assoc()) {
                                if($row["id"]!=$rowAtual){
                                echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["NOME_Cliente"]."</td>";
                                    echo "<td>".$row["CPF_Cliente"]."</td>";
                                    echo "<td>".$row["BAIRRO_Cliente"]."</td>";
                                    echo "<td>".$row["CIDADE_Cliente"]."</td>";
                                    echo "<td>".$row["EMAIL_Cliente"]."</td>";
                                    echo "<td>".$row["UF_Cliente"]."</td>";
                                    echo "<td>".$row["CEP_Cliente"]."</td>";
                                //    echo "<td>".$row["bairro_orcamento"]."</td>";
                                    echo "<td>";
                                  //  echo "<a href='recuperarPedidoProjeto.php?id=".$row["id"]."'><span class='glyphicon glyphicon-remove-sign' title='Excluir'></span></a>";
                                   echo "</td>";
                                   echo "<td>";
                                  //  echo "<a href='mostrarPedidoProjeto.php?id=".$row["id"]."' target='somethingUnique'><span class='glyphicon glyphicon-info-sign' title='Visualizar'></span></a>";
                                  //  echo "</td>";
                                    echo "</tr>";
                                }
                                $rowAtual=$row["id"];
                            }
                        }
                                ?>
                    </tbody>
                </table>
                <?php
                    include "../../includes/footer.html";
                ?>
                </div>
            </body>
            <?php
            $conn->close();
            ?>
</html>
