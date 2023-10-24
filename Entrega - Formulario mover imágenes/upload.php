<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio = "imgusr/";
    $maxarchivo = 200000; 
    $maxtotal = 300000; 

    $errores = [];

    foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmpName) {
        $nombreArchivo = $_FILES['imagenes']['name'][$key];
        $tamañoArchivo = $_FILES['imagenes']['size'][$key];
        $tipoArchivo = $_FILES['imagenes']['type'][$key];

        $dirsubida = $directorio. $nombreArchivo;

        $extensiones = ['image/jpeg', 'image/png'];
        if (!in_array($tipoArchivo, $extensiones)) {
            $errores[] = "El archivo $nombreArchivo no es una imagen JPEG o PNG.";
        }

        if ($tamañoArchivo > $maxarchivo) {
            $errores[] = "El archivo $nombreArchivo supera el tamaño máximo permitido.";
        }

        if (file_exists($dirsubida)) {
            $errores[] = "El archivo $nombreArchivo ya existe en el directorio de imágenes.";
        }

        if (empty($errores)) {
            move_uploaded_file($tmpName, $dirsubida);
        }
    }

    if (count($errores) > 0) {
        foreach ($errores as $error) {
            echo $error . '<br>';
        }
    } else {
        echo "Las imágenes se han subido exitosamente.";
    }
}
?>
