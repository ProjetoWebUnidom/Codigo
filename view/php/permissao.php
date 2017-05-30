<?php

function permissaoAcesso($acesso){
  if($acesso==1){
    $_SESSION["ID_TipoUsuario"]  = 1;
  }elseif($acesso == 2){
    $_SESSION["ID_TipoUsuario"]  = 2;
  }
  return $_SESSION["ID_TipoUsuario"];
}

function perfil(){
  if(isset($_SESSION["ID_TipoUsuario"]) && $_SESSION["ID_TipoUsuario"]==1){
      return include "../../includes/headerFuncionario.html";
  }elseif($_SESSION["ID_TipoUsuario"] = 2){
      return include "../../includes/headerAdm.html";
    }

}

function redirecionarSession(){
  if(isset($_SESSION['ID_TipoUsuario']) && $_SESSION['ID_TipoUsuario'] != null){
    if($_SESSION['ID_TipoUsuario'] == 1){
      header("location: ../web/indexFuncionario.php");
    }elseif($_SESSION['ID_TipoUsuario'] == 2){
      header("location: ../web/indexAdm.php");
    }

  }}

function sessionFim(){
  if(isset($_SESSION["ID_TipoUsuario"])){
     unset($_SESSION["ID_TipoUsuario"]);
     session_destroy();
}
}
