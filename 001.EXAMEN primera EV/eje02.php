<!-- Realizar la aplicación eje02.php que controla 
una agenda de contactos. La información a gestionar 
está almacenada el fichero contactos.txt. Este fichero
 de texto  guardan el nombre y el teléfono de cada contacto. 
 Cada contacto ocupa una línea, existiendo una coma que separa
  el nombre y su teléfono. Hay que tratar el caso que el 
  fichero no exista o no se pueda leer o escribir, en estos 
  casos el programa mostrará un mensaje y terminará.
Ejemplo de contenido de fichero contactos.txt: -->




<?php

session_start();


if($_SERVER["REQUEST_METHOD"]==="GET"){
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
}
//compruebo ataques. 
///////
print $_SESSION["token"] . "<br>";
/////////
$msg = "";
$contactodiv = [];
$nombre = "";

define("FICHERO", "contactos.txt");


if (file_exists(FICHERO)) {
    $contactos = @file(FICHERO);
    $contactodiv = separararray($contactos);
} else {
    $msg = "No se puede encontrar o escribir en el fichero";
}

if (isset($_POST["orden"])) {

    //////////  
    print $_POST["token"];
    ///////////
    if (!isset($_REQUEST['token']) || $_REQUEST['token'] != $_SESSION['token']) {
        echo " Intento de ataque.... ";
        die();
    }
    switch ($_POST["orden"]) {
        case "Consultar":
            if (isset($_POST["nombre"])) {
                $nombre = htmlspecialchars($_POST["nombre"]);
                if (array_key_exists($nombre, $contactodiv)) {
                    $msg = "Encontrado! " . $nombre . ". Su número es: " . $contactodiv[$nombre];
                } else {
                    $msg = "No se ha encontrado";
                }
            }
            break;
        case "Añadir":
            if (isset($_POST["nombre"]) && isset($_POST["telefono"]) && is_numeric($_POST["telefono"])) {
                $archivo = @fopen(FICHERO, "a");
                if ($archivo) {
                    fwrite($archivo, trim(htmlspecialchars($_POST['nombre'])) . "," . $_POST['telefono'] . "\n");
                    fclose($archivo);
                    $msg = "texto agregado";
                } else {
                    $msg = "Archivo no encontrado";
                }
            }
    }
}

function separararray($listacontactos)
{
    $separada = [];
    foreach ($listacontactos as $key => $value) {
        if ($value != "\n") {
            $aux = explode(",", $value);
            // $separada[]=explode(",",$value);
            $separada[$aux[0]] = $aux[1];
        }
    }
    // print_r($separada); para debugging
    return $separada;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title> Agenda App </title>
</head>

<body>
    <form method="POST">
        <fieldset>
            <legend>Su agenda personal</legend>
            <label for="nombre">Nombre:</label><br>
            <input type='text' name='nombre' size=20 value="">
            <input type='submit' name="orden" value="Consultar"><br>
            <label for="telefono">Teléfono:</label><br>
            <input type='number' name='telefono' size=20 value="">
            <input type='submit' name="orden" value="Añadir">
            <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
        </fieldset>
    </form><br>
    <?= $msg ?> <br>
</body>

</html>