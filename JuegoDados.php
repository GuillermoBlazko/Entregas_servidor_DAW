<?php
    $arrayDados=[1=>9856,9857,9858,9859,9860,9861];
    $resultado1=tirada($arrayDados);
    $resultado2=tirada($arrayDados);
    function tirada($arrayDados){
        $maxValue=0; 
        $minValue=10;
        $suma=0; 
        $mensaje="";
        for ($i=0; $i<6; $i++){
            $clave_aleatoria = array_rand($arrayDados); 
            $valor_aleatorio = $arrayDados[$clave_aleatoria]; 

            if($clave_aleatoria>$maxValue){
                $maxValue=$clave_aleatoria; 
            }
            if($clave_aleatoria<$minValue){
                $minValue=$clave_aleatoria; 
            }
            $suma+=$clave_aleatoria; 
            $mensaje.="&#". $valor_aleatorio .";";
        }
        $suma =$suma-$minValue-$maxValue; 
        return array($mensaje, $suma); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Jugador 1: <?=$resultado1[0]?>. Suma: <?=$resultado1[1]?></p>
    <p>Jugador 2: <?=$resultado2[0]?>. Suma: <?=$resultado2[1]?></p>
    <p>El ganador es:<?=$resultado1[1]>$resultado2[1]? "ha ganado el jugador 1":"ha ganado el jugador 2"?></p>
</body>
</html>
