<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';
define("CONT",12345); 

//https://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 5 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

// Div con contenido
$contenido = "";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //CHEQUEO SI TIENE TIEMPO DE SESIÓN
    if (!isset($_SESSION['LAST_ACTIVITY'])) {
        //CHEQUEO SI EL PIN ESTÁ MARCADO
        if (isset($_GET["pin"])) {
            //COMPRUEBO EL PIN
            if ((int)$_GET["pin"] == CONT) {
                $_SESSION['LAST_ACTIVITY'] = time();
                $contenido .= mostrarDatos();
                //ES UNA GUARRADA, LO SE: 
                include_once "app/layout/principal.php";
                exit();

            }
        }
        include_once "app/layout/formulariopin.php";
    } else if (isset($_GET['orden'])) {
        switch ($_GET['orden']) {
            case "Nuevo":
                accionAlta();
                break;
            case "Borrar":
                accionBorrar($_GET['id']);
                break;
            case "Modificar":
                accionModificar($_GET['id']);
                break;
            case "Detalles":
                accionDetalles($_GET['id']);
                break;
            case "Terminar":
                accionTerminar();
                break;
            case "Bloqueo":
                if (isset($_GET["check"])) {
                    accionBloquear($_GET["check"]);
                    break;
                } else {
                    $lista = [];
                    accionBloquear($lista);
                    break;
                }
            case "Incrementar":
                if (isset($_GET["check"])) {
                    accionIncrementar($_GET["check"]);
                    break;
                } else {
                    $lista = [];
                    accionIncrementar($lista);
                    break;
                }
        }
    }
}

// POST Formulario de alta o de modificación
else {
    if (isset($_POST['orden']) && $_SESSION["acceso"] = 1) {
        switch ($_POST['orden']) {
            case "Nuevo":
                accionPostAlta();
                break;
            case "Modificar":
                accionPostModificar();
                break;
            case "Detalles":; // No hago nada
        }
    }
}
$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";
