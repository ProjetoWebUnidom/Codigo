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
        $sql = "DELETE FROM `protocolo` WHERE `ID_projeto` = ".$id;
        $conn->query($sql);
        $sql = "DELETE FROM `projeto_categoria` WHERE `ID_Projeto` =".$id;
        $conn->query($sql);
        $sql = "DELETE FROM projeto WHERE `ID_projeto`=".$id;
        $conn->query($sql);
    }
    $sql = "SELECT SUBSTRING(pr.dt_protocolo, 1, 10) AS data_pedido,
    SUBSTRING(pr.dt_protocolo, 12) AS hora,
    nome_projeto, bairro_projeto , orc.ID_projeto AS id, telefone_projeto, email_projeto ,orc.INFORMACAO_projeto AS item
    FROM projeto orc
    INNER JOIN protocolo pr ON pr.id_projeto=orc.id_projeto";
    $resultado = $conn->query($sql);

            ?>
            <body>
                <div class="container">
                <table id="example" class="display" cellspacing="6" width="100%">
                    <thead>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Bairro</th>
                        <th>Item</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tfoot>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Bairro</th>
                        <th>Item</th>
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
                                    echo "<td>".$row["data_pedido"]."</td>";
                                    echo "<td>".$row["hora"]."</td>";
                                    echo "<td>".$row["nome_projeto"]."</td>";
                                    echo "<td>".$row["telefone_projeto"]."</td>";
                                    echo "<td>".$row["email_projeto"]."</td>";
                                    echo "<td>".$row["bairro_projeto"]."</td>";
                                    echo "<td>".$row["item"]."</td>";
                                    echo "<td>";
                                    echo "<a href='recuperarPedidoProjeto.php?id=".$row["id"]."'><span class='glyphicon glyphicon-remove-sign' title='Excluir'></span></a>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<a href='mostrarPedidoProjeto.php?id=".$row["id"]."' target='somethingUnique'><span class='glyphicon glyphicon-info-sign' title='Visualizar'></span></a>";
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
