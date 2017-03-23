<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quem somos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="../../css/estilofooter.css" rel="stylesheet" type="text/css"/>
        <style>
            div img {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            .texto{
                background-color: #FFF;
                padding: 15px;
                text-align: justify;
                font-size: 105%;
            }
 
        </style>
    </head>
    <body>
        <div class="container">
        <?php
            include "../../includes/header.html";
        ?>
            <div id="textos">
            <div class="col-sm-12 texto">
                <p>
                    No menu Inserir, as galerias incluem itens que são 
                    projetados para corresponder à aparência geral do documento. 
                    Você pode usar essas galerias para inserir tabelas, cabeçalhos, rodapés, 
                    listas, folhas de rosto e outros blocos de construção do documento. Quando você 
                    cria imagens, gráficos ou diagramas, esses elementos também são coordenados 
                    com a aparência atual do documento. Você pode alterar facilmente a formatação do 
                    texto selecionado no documento escolhendo uma aparência para o texto selecionado na 
                    galeria Estilos Rápidos, na guia Início.
                </p>
            </div>
            <div class="col-sm-12 texto">
                <p>
                    Você também pode formatar texto diretamente usando os outros controles na guia Início. 
                    A maioria dos controles oferece uma opção entre usar a aparência do tema 
                    atual ou usar um formato que você pode especificar. Para alterar a aparência 
                    geral do documento, escolha novos elementos Tema na guia Layout da Página. 
                    Para alterar as aparências disponíveis na galeria Estilos Rápidos, use o 
                    comando Alterar Conjunto Atual de Estilos Rápidos.
                </p>
            </div>
            <div class="col-sm-12 texto">
                <p>
                    As galerias Temas e Estilos Rápidos fornecem comandos de redefinição para que 
                    você possa sempre restaurar a aparência do documento ao original contido no modelo 
                    atual. No menu Inserir, as galerias incluem itens que são projetados para corresponder 
                    à aparência geral do documento. Você pode usar essas galerias para inserir tabelas, 
                    cabeçalhos, rodapés, listas, folhas de rosto e outros blocos de construção do documento. 
                    Quando você cria imagens, gráficos ou diagramas, esses elementos também são 
                    coordenados com a aparência atual do documento.
                </p>
            </div>
            </div>
        <?php
            include "../../includes/footer.html";
        ?>
        </div>
    </body>
</html>
