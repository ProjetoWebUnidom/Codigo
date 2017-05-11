<?php

function permissaoAcesso($acesso){
  if($acesso==4){
    $_SESSION["ID_TipoUsuario"]  = 4;
  }elseif($acesso ==3){
    $_SESSION["ID_TipoUsuario"]  = 3;
  }
  return $_SESSION["ID_TipoUsuario"];
}

function perfil(){
  if(isset($_SESSION["ID_TipoUsuario"]) && $_SESSION["ID_TipoUsuario"]==4){
      return include "../../includes/headerFuncionario.html";  
  }else{
      return include "../../includes/headerAdm.html";
    }

}
