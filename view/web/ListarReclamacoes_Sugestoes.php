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
        $sql = "DELETE FROM sugestao_reclamacao` WHERE `ID_Sugestao_Reclamacao` = " .$id;
        $conn->query($sql);

    }
    $sql = "SELECT `ID_Sugestao_Reclamacao` AS 'id' , `TIPO_Sugestao_Reclamacao` , `NOME_Sugestao_Reclamacao` , `EMAIL_Sugestao_Reclamacao` ,
    `DESTINARIO_Sugestao` FROM `sugestao_reclamacao`";
    $resultado = $conn->query($sql);

            ?>
            <body>
                <div class="container">
                <table id="example" class="display" cellspacing="6" width="100%">
                    <thead>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Destinario</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        $rowAtual=0;
                        if($resultado->num_rows > 0) {
                            while($row = $resultado->fetch_assoc()) {
                                if($row["id"]!=$rowAtual){
                                    echo "<td>".$row["TIPO_Sugestao_Reclamacao"]."</td>";
                                    echo "<td>".$row["NOME_Sugestao_Reclamacao"]."</td>";
                                    echo "<td>".$row["EMAIL_Sugestao_Reclamacao"]."</td>";
                                    echo "<td>".$row["DESTINARIO_Sugestao"]."</td>";
                                    echo "<td>";
                                    echo "<a href='ListarReclamacoes_Sugestoes.php?id=".$row["id"]."'><span class='glyphicon glyphicon-remove-sign' title='Excluir'></span></a>";
                                    echo "</td>";
                                    echo "<td>";
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
