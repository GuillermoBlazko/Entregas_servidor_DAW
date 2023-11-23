<!-- Realizar el programa eje01.php donde se dispone de dos array 
en php: uno contiene los nombres de los alumnos y otro sus 
notas correspondientes. Queremos realizar dos métodos unir y 
separar: el primero combinará los dos arrays generando un 
nuevo array asociativo donde la clave sea el nombre y el 
valor la nota, el segundo genera un nuevo array de dos 
filas a partir del anterior, donde la primera fila 
corresponde a los nombres y la segunda a las notas. -->


<?php

function unir($nombres, $notas){
    return array_combine($nombres,$notas);
}
function separar($calificaciones){
    $aux=[];
    $claves=[]; 
    $valores=[];
    foreach ($calificaciones as $clave =>$valor){
        $claves[]=$clave;
        $valores[]=$valor; 
    }
    $aux=[
        $claves, 
        $valores 
    ];
    return $aux; 
}
$nombres = ["Juan","Pedro","María","Elena","Luis"];
$notas  = [7.5, 6.0, 7.8, 9.5, 3.5 ];

// Une los array en uno nuevo
$calificaciones = unir ($nombres, $notas);
// Creo un nuevo array
$datos = separar($calificaciones);
echo "<code><pre>";
print_r($calificaciones);
print_r($datos);
echo "</pre></code>";


?>