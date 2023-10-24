<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = "../imgusr/";
    $maxarchivo = 200000; 
    $maxtotal = 300000; 

    $errores = [];

    foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmpName) {
        $nombreArchivo = $_FILES['imagenes']['name'][$key];
        $tamañoArchivo = $_FILES['imagenes']['size'][$key];
        $tipoArchivo = $_FILES['imagenes']['type'][$key];

        $uploadPath = $uploadDir . $nombreArchivo;

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($tipoArchivo, $allowedTypes)) {
            $errores[] = "El archivo $nombreArchivo no es una imagen JPEG o PNG.";
        }

        if ($tamañoArchivo > $maxarchivo) {
            $errores[] = "El archivo $nombreArchivo supera el tamaño máximo permitido.";
        }

        if (file_exists($uploadPath)) {
            $errores[] = "El archivo $nombreArchivo ya existe en el directorio de imágenes.";
        }

        if (empty($errores)) {
            move_uploaded_file($tmpName, $uploadPath);
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
