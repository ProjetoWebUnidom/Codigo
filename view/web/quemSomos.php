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

<meta http-equiv="content-type" content="text/html;charset=utf-8">
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
            include "../php/permissao.php";
            redirecionarSession();  
        ?>
            <div id="textos">
            <div class="col-sm-12 texto">
                <p>
                <center>
                    <h3><b>Sobre nós</b></h3>
                </center>
                    <br>
                    Na loja Karina modulados, acreditamos que cada lar é a realização de um sonho e
                    nosso objetivo é ajudar você a completar o seu, decorando com móveis de qualidade.
                    Para isso, reunimos as melhores soluções de venda de móveis presencialmente com projetos
                    para sala, quarto, banheiro e cozinha, onde oferecemos inspirações para decorar cada momento da sua vida.<br><br>
                    Ajudando você a explorar a maior variedade de móveis planejados! Através de nossos ambientes decorados,
                    você vê como o seu móvel ficará naquele cantinho todo especial.
                    Contribuindo juntamente com você para mobiliar sua casa com móveis modulados, aproveitando cada espaço do ambiente
                    da melhor forma, como se fossem planejados.
                </p>
            </div>

            <div class="col-sm-12 texto">

                 <center>
                    <h3><b>Algumas imagens de nossos projetos: </b></h3>
                </center>
                    <br>

                <table>
                <tr>
                    <td><IMG src="../../imagens/projetobanheiro.jpg" WIDTH=60%>
                    <td><IMG src="../../imagens/projetocozinha.jpg" WIDTH=60%>
                    <td><IMG src="../../imagens/projetoquarto.jpg" WIDTH=60%>
                    <td><IMG src="../../imagens/projetosala.jpg" WIDTH=60%>
                </tr>
                </table>

            </div>

            </div>

        <?php
            include "../../includes/footer.html";
        ?>
        </div>
    </body>
</html>
