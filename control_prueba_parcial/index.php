<?php
session_start();

if(!isset($_SESSION["intentos"])){
  $_SESSION["intentos"]=5; 
}
include_once('app/funciones.php');

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        echo"Rol profe"; 
        $contenido = verNotaTodas($_GET['login']);
      } else {
        echo"Rol Alum"; 
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
      $_SESSION["intentos"]--;  
      if($_SESSION["intentos"]<=0){
        $contenido = "superado el número de intentos";
        include_once('app/acceso.php');
        exit();
      }else{
        $contenido = "El número de usuario y la contraseña no son válidos";
        include_once('app/acceso.php');
      }
    
    
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}


