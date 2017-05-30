<?php
session_start();
include "../php/permissao.php";
perfil();
blockAcess();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/estilofooter.css">
        <script src="../../js/mascaras_jquery.js" type="text/javascript"></script>
        <script src="../../js/jquery.dataTables.js" type="text/javascript"></script>

        <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 9px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        tr:hover{background-color:#f5f5f5}
        </style>

        <script>
            $(document).ready(function () {
              jQuery("#textFone").mask("(99) 99999-9999");
               $("#formExemplo").css("padding","20px");
               $("input[type='radio']").click(function(){
                    var opcao=$("input[name='optradio']:checked").val();
                    if(opcao=="editar"){
                        $("#btAtualizar").attr("disabled", false);
                        $(".form-control").attr("readonly", false);
                        $("#textStatus").attr("disabled", false);
                    }else{
                        $("#btAtualizar").attr("disabled", true);
                        $("#textStatus").attr("disabled", true);
                        $(".form-control").attr("readonly", true);
                    }
                });
            });
        </script>
        <title></title>
    </head>
    <body>
        <?php
        include "../../includes/conexao.php";
        $id=filter_input(INPUT_GET,'id');
        if(isset($_GET["id"])){
            $sql = "SELECT p.*, pt.NUM_Protocolo from projeto p inner join protocolo pt on p.ID_Projeto ='".$id."'";
            $sql2 = "SELECT sum(VALOR_ProjetoCategoria) from projeto_categoria where ID_Projeto = '".$id."'";
            $sql3 = "SELECT tc.DESCRICAO_TipoCategoria, pc.VALOR_ProjetoCategoria FROM tipo_categoria tc
                     INNER JOIN projeto_categoria pc
                     inner JOIN projeto pj
                     ON pc.id_projeto=pj.id_projeto
                     and tc.ID_TipoCategoria = pc.ID_TipoCategoria and pc.ID_Projeto = '".$id."'";
            $resultado = $conn->query($sql);
            $resultado2 = $conn->query($sql2);
            $resultado3 = $conn->query($sql3);
        }

        $row = $resultado->fetch_assoc();
        $row2 = $resultado2->fetch_assoc();
        ?>

        <div class="container">
            <?phps
                include "../../includes/headerAdm.html";
            ?>
            <form method="post" action="../php/atualizarPedidoProjeto.php" id="formExemplo" data-toggle="validator" role="form" class="form-horizontal">
              <div class="form-group">
                  <div><label for="textProj" class="control-label col-sm-2">Protocolo:</label>
                    <label for="textProj" class="control-label col-sm-2"><?php echo $row['NUM_Protocolo']?></label>
                    <div class="col-sm-4">
                    </div>
                  </div>

                </div>
               <div class="form-group">
                    <label for="textNome" class="control-label col-sm-2">Nome:</label>
                    <div class="col-sm-4">
                    <input id="textNome" name="nNome" class="form-control" readonly type="text" value="<?php echo $row['NOME_Projeto']?>">
                    </div>
                    <label for="textFone" class="control-label col-sm-2">Telefone:</label>
                    <div class="col-sm-4">
                    <input id="textFone" name="nCel" class="form-control" maxlength="15" onkeypress="mascara(this)" readonly type="text" value="<?php echo $row['TELEFONE_Projeto']?>">
                    </div>
              </div>
              <div class="form-group">
                    <label for="textEnd" class="control-label col-sm-2">Bairro:</label>
                    <div class="col-sm-4">
                    <input id="textBai" name="nBai" class="form-control" readonly type="text" value="<?php echo $row['BAIRRO_Projeto']?>">
                    </div>
                    <label for="textEmail" class="control-label col-sm-2">Email:</label>
                    <div class="col-sm-4">
                    <input id="textEmail" name="nEmail" class="form-control" readonly type="email" value="<?php echo $row['EMAIL_Projeto']?>">
                    </div>
              </div>
        <div class="form-group">
            <label for="textStatus" class="control-label col-sm-2">Status:</label>
              <div class="col-sm-4">
                <select readonly type = "text" class = "form-control" id = "textStatus" disabled name = "nStatus" size = "1">
                 <option value="estadoAtual">Atual: <?php echo $row['STATUS_Projeto']?></option>
                  <option value="Em analise">Em análise</option>
                   <option value="Em conclusao">Em conclusão</option>
                    <option value="Concluido">Concluído</option>
                </select>
              </label>
                </div>
                   <label for="textFone" class="control-label col-sm-2">Endereço:</label>
                   <div class="col-sm-4">
                   <input id="textEndereco" name="nEndereco" class="form-control" maxlength="150" readonly type="text" value="<?php echo $row['ENDERECO_Projeto']?>">
                   </div>
              </div>
              <div class="form-group">
                    <label for="textDet" class="control-label col-sm-2">Informações:</label>
                      <div class="col-sm-4">
                        <input id="iDet" name="nDet" rows="10" readonly type="text" class="form-control" value="<?php echo $row['INFORMACAO_Projeto']?>">
                      </div>
                <label for="textProj" class="control-label col-sm-2">Valor total:</label>
                    <div class="col-sm-4">
                        <label for="textProj" class="control-label col-sm-2">R$:<?php echo $row2['sum(VALOR_ProjetoCategoria)']?></label>
                      </div>
                  </div>

                <div class="form-group">
                      <table id="example" class="display" cellspacing="1" width="30%" >
                          <thead>
                            <th>Projetos Solicitados</th>
                            <th>Valor de cada projeto</th>
                          </thead>
                        <?php
                    while ($row3 = $resultado3->fetch_assoc()){
                      echo "<tr>";
                      echo "<td>".$row3["DESCRICAO_TipoCategoria"]."</td>";
                      echo "<td>R$: ".$row3['VALOR_ProjetoCategoria']."</td>";
                        }
                        ?>
                      </table>
                  </div>
              <div class="form-group">
                      <div class="col-sm-offset-6 col-sm-4">
                          <label class="radio-inline"><input type="radio" name="optradio" value="editar">Habilitar edição</label>
                            <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="naoeditar">Desabilitar edição</label>
                              </div>
                              <div class="col-sm-2">
                            <button type="submit" id="btAtualizar" class="btn btn-info btn-lg" disabled>Atualizar</button>
                          </div>
                      </div>
                <input type="hidden" name="nId" value="<?php echo $row['ID_Projeto']?>">
           </form>
        <?php
            include "../../includes/footer.html";
            $conn->close();
        ?>

        </div>
    </body>
</html>
