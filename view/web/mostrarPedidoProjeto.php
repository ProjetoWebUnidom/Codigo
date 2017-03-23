<?php
session_start();
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
        <script src="../../js/mascaras.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
               $("#formExemplo").css("padding","20px");
               $("input[type='radio']").click(function(){
                    var opcao=$("input[name='optradio']:checked").val();
                    if(opcao=="editar"){
                        $("#btAtualizar").attr("disabled", false);
                        $(".form-control").attr("readonly", false);
                    }else{
                        $("#btAtualizar").attr("disabled", true);
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
            $sql = "SELECT DATE_FORMAT(dataproj,'%d/%m/%Y') AS datapr,hora,nome,ddd,numero,bairro,detalhes,projetode,endereco,email,id "
            . "FROM pedidoprojeto JOIN telefone WHERE pedidoprojeto.id=telefone.idcliente AND"
            . " pedidoprojeto.id=".$id;
            $resultado = $conn->query($sql);
        }
        $row = $resultado->fetch_assoc();
        
        ?>
        <div class="container">
            <?php
                include "../../includes/headerAdm.html";
            ?>
            <form method="post" action="../php/atualizarPedidoProjeto.php" id="formExemplo" data-toggle="validator" role="form" class="form-horizontal">
               <div class="form-group">
                    <label for="textNome" class="control-label col-sm-2">Nome:</label>
                    <div class="col-sm-4">
                    <input id="textNome" name="nNome" class="form-control" readonly type="text" value="<?php echo $row['nome']?>">
                    </div>
                    <label for="textFone" class="control-label col-sm-2">Telefone:</label>
                    <div class="col-sm-4">
                    <input id="textFone" name="nCel" class="form-control" maxlength="15" onkeypress="mascara(this)" readonly type="text" value="<?php echo "(".$row['ddd'].") ".$row['numero']?>">
                    </div>
              </div>
              <div class="form-group">
                    <label for="textEnd" class="control-label col-sm-2">Endereço:</label>
                    <div class="col-sm-4">
                    <input id="textEnd" name="nEnd" class="form-control" readonly type="text" value="<?php echo $row['endereco']?>">
                    </div>
                    <label for="textEmail" class="control-label col-sm-2">Email:</label>
                    <div class="col-sm-4">
                    <input id="textEmail" name="nEmail" class="form-control" readonly type="email" value="<?php echo $row['email']?>">
                    </div>
              </div>
              <div class="form-group">
                    <label for="textDet" class="control-label col-sm-2">Como chegar:</label>
                    <div class="col-sm-4">
                    <textarea id="textDet" name="nDet" class="form-control" readonly rows="5" cols="47"><?php echo $row['detalhes']?></textarea>
                    </div>
                    <label for="textProj" class="control-label col-sm-2">Projeto de:</label>
                    <div class="col-sm-4">
                    <input id="textProj" name="nProjDe" class="form-control" readonly type="text" value="<?php echo $row['projetode']?>">
                    </div>
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
                <input type="hidden" name="nId" value="<?php echo $row['id']?>">
                <input type="hidden" name="nOldDdd" value="<?php echo $row['ddd']?>">
                <input type="hidden" name="nOldNumero" value="<?php echo $row['numero']?>">
           </form>

        <?php
            include "../../includes/footer.html";
            $conn->close();
        ?>
        </div>
    </body>
</html>
