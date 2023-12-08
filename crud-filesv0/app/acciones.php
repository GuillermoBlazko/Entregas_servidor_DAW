<?php
// Borra el elemento indicado de tabla de usuarios
// Reordena indexa la tabla
function accionBorrar($id)
{
    //<<<< COMPLETAR >>>>>>  
    if (isset($_SESSION["tuser"][$id])) {
        unset($_SESSION["tuser"][$id]);
        $msg = "Usuario $id eliminado";
    } else {
        $msg = "El usuario login $id no se ha encontrado";
    }
    $_SESSION['msg'] = "EL MÉTODO " . __FUNCTION__ . " NO  ESTA IMPLEMENTADO ";
}

// Termina: Cierra sesión y vuelva los datos
function accionTerminar()
{
    //<<<< COMPLETAR >>>>>>  
    volcarDatos($_SESSION["tuser"]); 
    session_destroy();
    $_SESSION['msg'] = " EL MÉTODO " . __FUNCTION__ . " NO  ESTA IMPLEMENTADO ";
}


// Muestra un formularios cn los datos de un usuario de la posición $id de la tabla
function accionDetalles($id)
{
    $login = $id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  = $usuario[0];
    $nombre   = $usuario[1];
    $comentario = $usuario[2];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

// Muestra un el formularios con los datos permitiendo la modificación
function accionModificar($id)
{
    $login = $id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  = $usuario[0];
    $nombre   = $usuario[1];
    $comentario = $usuario[2];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();
    // $_SESSION['msg'] = " EL MÉTODO ".__FUNCTION__." NO  ESTA IMPLEMENTADO ";
}


function accionPostModificar()
{
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $id = $_POST["login"];
    $nuevo = [$_POST['clave'], $_POST['nombre'], $_POST['comentario']];
    $_SESSION['tuser'][$id] = $nuevo;
    $_SESSION["msg"] = "Usuario $id ha sido modificado";
}

// Muestra un el formulario con los datos vacios para realizar una alta
function accionAlta()
{
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden = "Nuevo";
    include_once "layout/formulario.php";
    exit();
}
function accionREAlta($nuevo)
{
    $nombre  = $nuevo[1];
    $login   = "";
    $clave   = $nuevo[0];
    $comentario = $nuevo[2];
    $orden = "Nuevo";
    $msg="El login ya ha sido registrado, porfavor, inserte uno correcto";
    include_once "layout/formulario.php";
    exit();
}

// Proceso los datos del formularios guardandolo en la sesión
// Debe evitar que se puedan introducir dos usuarios con el mismo login
function accionPostAlta()
{

    //<<<< COMPLETAR >>>>>>
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código

    //<<<< COMPLETAR y CORREGIR>>>>>>
    $id = $_POST['login'];
    $nuevo = [$_POST['clave'], $_POST['nombre'], $_POST['comentario']];

    if(isset($_SESSION["tuser"][$id])){
        accionAlta($nuevo); 
    }else{
        $_SESSION['tuser'][$id] = $nuevo;
        $_SESSION['msg'] = " Nuevo usuario añadido.";
    }

}
