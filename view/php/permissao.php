<?php

function permissaoAcesso($acesso){
  if($acesso==2){
    $_SESSION["ID_TipoUsuario"]  = 2;
  }elseif($acesso ==1){
    $_SESSION["ID_TipoUsuario"]  = 1;
  }
  return $_SESSION["ID_TipoUsuario"];
}

function perfil(){
  if(isset($_SESSION["ID_TipoUsuario"]) && $_SESSION["ID_TipoUsuario"]==2){
      return include "../../includes/headerFuncionario.html";
  }else{
      return include "../../includes/headerAdm.html";
    }

}
