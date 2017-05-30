<?php
session_start();
include "../php/permissao.php";
perfil();
?>
<html>
    <meta charset="utf-8" />
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>
        <script src='../../classes/tinymce/tinymce.min.js'></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">


        <style>

            #iMsg{
                border:solid 1px #ccc;
                margin-top: -15px;
                border-radius: 5px;
                background: -webkit-gradient(linear, left top, left bottom, from(#800000), to(#ff0000));
                background: -moz-linear-gradient(top, #800000, #ff0000);
                filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr='#800000', EndColorStr='#ff0000');
                box-shadow: 2px 2px 0 #ccc;
            }
            .asteristico{
                color: #ff0000;
                font-size: 17px;
            }
            #fecharMsg{
                float: right;
                cursor:pointer
            }
        </style>
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
                $("#iLimpar").click(function () {
                    $('#iTema').val('');
                    tinyMCE.get('iDescricao').setContent('');
                });

                $("#iNext").click(function () {
                    if ($("#iTema").val() == "") {
                        $('#msg').html('* Por favor, preencha o campo obrigatório!');
                        $('.cxMsg').fadeIn();
                        $("#iTema").focus();
                        return false
                    } else {
                        $("#fecharMsg").trigger(`click`);
                        $(".sceneOne").fadeOut('slow');
                        $(".sceneTwo").delay('600').fadeIn('slow');
                        $("#iSend, #iBack").show('slow');
                        $("#iNext, #iLimpar").hide('slow');
                    }
                });
                $("#iBack").click(function () {
                    $(".sceneTwo").fadeOut('slow');
                    $(".cxMsg").fadeOut('slow');
                    $(".sceneOne").delay('600').fadeIn('slow');
                    $("#iNext, #iLimpar").show('slow');
                    $("#iSend, #iBack").hide('slow');
                });
                $("#fecharMsg").click(function () {
                    $('.cxMsg').fadeOut();
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
            });
            function marcarDesmarcar() {
                $(".marcar").each(
                        function () {
                            if ($(this).prop("checked")) {
                                $(this).prop("checked", false);
                            } else {
                                $(this).prop("checked", true);
                            }
                        }
                )
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

    $sql = "SELECT CPF_Cliente,
	NOME_Cliente,
        DTNASC_Cliente AS DATA_NASC,
        UF_Cliente,
        CIDADE_Cliente,
        BAIRRO_Cliente,
        EMAIL_Cliente,
        DDD_Telefone,
        NUMERO_Telefone FROM cliente
        INNER join telefone_cliente ON (cliente.ID_Cliente = telefone_cliente.ID_Cliente)";
    $resultado = $conn->query($sql);
    ?>
    <body>
        <div class="container">
            <fieldset >
                <legend>Mala Direta</legend>
                <div class="col-sm-12 cxMsg " style="display: none">
                    <span id="iMsg" class="col-sm-12" style="color: #fff" ><span id="msg"></span><span id="fecharMsg"><b>x</b></span></span>
                    <br />
                </div>
                <form action="../php/enviar_mala_direta.php" id="form_mala_direta" method="post">
                    <div class="sceneOne">
                        <div class="col-sm-3">
                            <label class="col-sm-10" style="font-size: 18px; margin-right:5px"  for="iTema">Selecione o Tema:<sup class="asteristico"><b>*</b></sup></label>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" id="iTema"  name="nTema" >
                                <option value="" id="">SELECIONE</option>
                                <?php
                                $query = $conn->query("SELECT ID_TipoAssuntoMalaDireta,NOME_TipoAssuntoMalaDireta FROM tipo_assuntomaladireta");
                                while ($reg = $query->fetch_array()) {
                                    $nome = $reg["NOME_TipoAssuntoMalaDireta"];
                                    echo '<option value="' . $reg["ID_TipoAssuntoMalaDireta"] . '">' . $nome . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <br>
                    </div>

                    <div class="form-group sceneOne">
                        <br />
                        <div class="col-sm-3">
                            <label class="col-sm-10" style="font-size: 18px; margin-right:5px" for="iDescricao">Descrição:</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea  rows="5" cols="40" class="form-control" id="iDescricao"  name="nDescricao"></textarea>
                        </div>
                    </div>
                    <div class="form-group sceneTwo " style="display: none">
                        <div class="col-sm-2">
                            <label class="col-sm-10" style="font-size: 18px; margin-right:5px" for="iContatos">Contatos:</label>
                        </div>

                        <div style="background: #F8F8FF" class="col-sm-10">
                            <table id="example" class="display" cellspacing="6" width="100%" >
                                <thead>
                                <th style=" padding: 11px"><input type="checkbox" name="" id=""  onclick="marcarDesmarcar()" /></th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $rowAtual = 0;
                                    if ($resultado->num_rows > 0) {
                                        while ($row = $resultado->fetch_assoc()) {
                                            if ($row["CPF_Cliente"] != $rowAtual) {
                                                echo "<tr>";
                                                echo "<td> <input type='checkbox' class='marcar' name='marcar[]' value=" . $row['EMAIL_Cliente'] . "> </td>";
                                                echo "<td>" . $row["NOME_Cliente"] . "</td>";
                                                echo "<td>" . $row["EMAIL_Cliente"] . "</td>";
                                                echo "</tr>";
                                            }
                                            $rowAtual = $row["CPF_Cliente"];
                                        }
                                    } else {
                                        ?>
                                    <div>
                                        <span>Nenhum registro encontrado!</span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div  class="col-sm-12" >
                        <br>
                        <div style="float: right;">
                            <button type="button" id="iLimpar"  name="nLimpar"  class="btn">Limpar</button>
                            <button type="button" id="iBack" name="nLeft"   class="btn  btn-primary" style="display: none"><< Voltar</button>
                            <button type="button" id="iNext" name="nNext"   class="btn btn-primary ">Próxima >></button>
                            <button type="button" id="iSend" name="nSend"   value="btEnviar" style="display: none" class="btn btn-primary" ><b>Enviar</b></button>
                        </div>
                    </div>
                </form>

            </fieldset>
            <br>
            <br>
            <?php
            include "../../includes/footer.html";
            ?>
        </div>
    </body>

    <?php
    $conn->close();
    ?>
</html>
