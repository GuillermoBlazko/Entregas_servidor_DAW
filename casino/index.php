
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); //NO TE OLVIDES ME CAGO EN TODO 


$resultado = "El resultado es: ";
$msg = "";

//CONTADOR DE VISITAS: 

if (isset($_SESSION["visita"])) {
    $_SESSION["visita"]++;
} else {
    $_SESSION["visita"] = 1;
}

//ESTABLECE DINERO INICIAL
if (isset($_POST["dineroInicial"])) {
    ($_POST["dineroInicial"] > 0) ? $_SESSION["cantidad"] = $_POST["dineroInicial"] : $msg .= "Se requiere que el número sea mayor que 0";
}

//MUESTRA INICIO
if (!isset($_SESSION["cantidad"])) {
    require_once ('bienvenida.php');
    exit();
}




//SWITCH EN BASE AL ACCION. 
if (isset($_REQUEST["accion"])) {
    switch ($_REQUEST["accion"]) {
        case "Apostar":
            if (isset($_POST["dineroApuesta"]) && $_POST["dineroApuesta"] > 0 && $_POST["dineroApuesta"] <= $_SESSION["cantidad"]) {
                $cantidad = $_POST["dineroApuesta"];
                $_SESSION["numeroRandom"] = random_int(1, 2);

                // (isset($_POST["apuesta"])=="Par" && $_SERVER["numeroRandom"]%2==0)?$_SERVER["cantidad"]+=$cantidad*2 :$_SERVER["cantidad"]-=$cantidad;
                // (isset($_POST["apuesta"])=="Impar" && $_SERVER["numeroRandom"]%2!=0)?$_SERVER["cantidad"]+=$cantidad*2:$_SERVER["cantidad"]-=$cantidad;

                if (isset($_POST["apuesta"])) {
                    if ($_POST["apuesta"] == "Par" && $_SESSION["numeroRandom"] == 2) {
                        $_SESSION["cantidad"] += $cantidad * 2;
                        $resultado .= "PAR <br> GANASTE!";
                    } elseif (isset($_POST["apuesta"]) == "Impar" && $_SESSION["numeroRandom"] == 1) {
                        $_SESSION["cantidad"] -= $cantidad;
                        $resultado .= "IMPAR <br> GANASTE!";
                    } else {
                        $_SESSION["cantidad"] -= $cantidad;
                        $resultado .= ($_SESSION["numeroRandom"] == 2) ? "PAR <br> PERDISTE!" : "IMPAR <br> PERDISTE!";
                    }
                } else {
                    $msg .= "Debes seleccionar par o Impar";
                }
            } else {
                $msg .= "No tiene los fondos necesarios";
            }
            break;
        case "Añadir":
            if (isset($_POST["dineroApuesta"]) && $_POST["dineroApuesta"] > 0) {
                $_SESSION["cantidad"] += $_POST["dineroApuesta"];
            } else {
                $msg .= "necesita añadir fondos superiores a 0 euros";
            }
            break;
        case "Abandonar":
            require_once ('despedida.php');
            session_destroy();
            exit();
    }
    require_once ('jugar.php');
}
