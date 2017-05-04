<?php

function listaCategorias($conn){
  $categorias = array();
  $query = "select* from tipo_categoria";
  $resultado = mysqli_query($conn,$query);
  while($categoria = mysqli_fetch_assoc($resultado)){
    array_push($categorias, $categoria);
  }
  return $categorias;
}
