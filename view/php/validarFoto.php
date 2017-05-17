<?php

function validarFoto($arquivo){
  define('TAMANHO_MAXIMO', (2 * 1024 * 1024));
  //$arquivo_tmp = $arquivo["tmp_name"];
  $nome = $arquivo["name"];
  $tipo = $arquivo["type"];
  $tamanho = $arquivo["size"];
  $diretorio = "../../imagens/";
  $extensao = substr($nome, -4);
  $novoNome = md5(time());
  $upload = $diretorio. basename($novoNome) . $extensao;
  if(empty($_FILES['arquivo']['name'])){
    return;
  }
  if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/',$tipo)){
    echo('Isso não é uma imagem válida');
    exit;
  }

  if($tamanho > TAMANHO_MAXIMO){
    echo retorno('A imagem deve possuir no máximo 2 MB');
    return;
  }
  return $upload;
}
