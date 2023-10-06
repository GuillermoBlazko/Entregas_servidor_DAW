<?php
    $juego=[[0,2,1],[1,0,2],[2,1,0]];
   
    $msg=["Empate", "ganador jugador 1","ganador jugador 2"];
    
    define ('PIEDRA',  "&#x1F91C;");
    define ('PIEDRA2',  "&#x1F91B;");
    define ('TIJERAS',  "&#x1F596;");
    define ('PAPEL',    "&#x1F91A;" );


    $valores = [PIEDRA,PAPEL,TIJERAS];

    $jugador1 = random_int(0,2); 
    $jugador2 = random_int(0,2); 

    function jugar($jugador1, $jugador2,$juego,$msg){
        $resultado = $juego[$jugador1][$jugador2]; 
        return $msg[$resultado]; 
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>
<body>



    <h1>PIEDRA PAPEL TIJERAS: </h1>
<table>
    <tr>
        <th>Jugador 1: </th> <th>Jugador 2: </th>
    </tr>
    <tr>
        <td><span style="font-size: <?=($resultado==1)? "40":"25"?>px;"><?=$valores[$jugador1];?></span></td>
        <td><span style="font-size: <?=($resultado==2)? "40":"25"?>px;"><?=($valores[$jugador2]==PIEDRA)? PIEDRA2:$valores[$jugador2] ;?></span></td>

    </tr>
</table>
<p><?=jugar($jugador1,$jugador2,$juego,$msg)?></p>
</body>
</html>