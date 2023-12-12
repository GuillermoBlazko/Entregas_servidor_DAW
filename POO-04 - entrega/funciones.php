<?php

include_once "config.php";
include_once "BiciElectrica.php";

define("CABECERA", ["id", "coordenadas X", "coordenadas Y", "Bateria"]);




function cargabicis(): array
{
    $tabla = [];
    if (!is_readable(FICHERO)) {
        $fich = @fopen(FICHERO, "w") or die("Error al crear el fichero");
        fclose($fich);
    }
    $fich = @fopen(FICHERO, "r") or die("Error al leer el fichero");

    while ($partes = fgetcsv($fich)) {
        $objeto = new BiciElectrica($partes[0], $partes[1], $partes[2], $partes[3], $partes[4]);
        $tabla[] = $objeto;
    }
    // var_dump($tabla);
    fclose($fich);
    return $tabla;
}

function bicimascercana($coordX, $coordY, $tabla)
{
    $closestBike = null;
    $closestDistance = PHP_FLOAT_MAX; // Initialize with a large value

    foreach ($tabla as $valor) {
        if ($valor->operativa == 1) {
            
            $deltaX = $coordX - $valor->coordx;
            $deltaY = $coordY - $valor->coordy;

            $distance = sqrt($deltaX ** 2 + $deltaY ** 2);

            if ($distance < $closestDistance) {
                $closestDistance = $distance;
                $closestBike = $valor;
            }
        }
    }

    return $closestBike;
}




function mostrartablabicis($tabla): void
{
    echo "<table border='1'>";
    //CABECERA
    echo "<tr>";
    foreach (CABECERA as $valor) {
        echo "<th>$valor</th>";
    }
    echo "</tr>";
    //CUERPO
    foreach ($tabla as $clave => $valor) {
        // echo $valor->operativa."<br>";
        if ($valor->operativa == 1) {
            echo "<tr><td>{$valor->id}</td>";
            echo "<td> {$valor->coordx}</td>";
            echo "<td> {$valor->coordy}</td>";
            echo "<td> {$valor->bateria}%</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
