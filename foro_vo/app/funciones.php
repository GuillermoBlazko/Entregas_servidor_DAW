<?php
function usuarioOk($usuario, $contraseña): bool
{
   return (strlen($usuario) > 8 && $contraseña == strrev($usuario)) ? true : false;
}


function contarLetras($linea){
   $linea = strtolower($linea);
   $letras = str_split($linea); 
   $mapa =[]; 

   foreach($letras as $char){
      if (array_key_exists($char,$mapa)){
         $mapa[$char]++; 
      }else{
         $mapa[$char]=1; 
      }
   }

   $max =0; 
   $letrasRepetida="";
   foreach($mapa as $car=>$valor){
      if($valor>$max){
         $max = $valor; 
         $letrasRepetida=$car; 
      }
   }
   return $letrasRepetida; 

}

function contarPalabras($comentario)
{
   $comentario = strtolower($comentario);
   $palabras = str_word_count($comentario, 1); 
   $mappalabras = array_count_values($palabras); 
   $max = 0; 
   $palabraMásRepetida="";
   foreach($mappalabras as $palabra => $valor){
      if($valor>$max){
         $palabraMásRepetida = $palabra;
         $max = $valor; 
      }
   }
   if($max=1){
      return "No hay palabras repetidas";
   }else{
      return $palabraMásRepetida;
   }
}

