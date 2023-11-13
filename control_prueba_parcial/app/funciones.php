<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;



    // foreach($usuarios as $key => $valor){
    //     if($valor[0]==$login && $valor[1]==$clave){
    //         return true;
    //     }
    // }

    if (key_exists($login,$usuarios)){
        if($usuarios[$login][1]==$clave){
            return true; 
        }
    }
    return false; 
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios; 
    // foreach($usuarios as $key => $valor){
    //     if($valor[0]==$login){
    //         return $valor[2];
    //     }
    // }
    if (key_exists($login,$usuarios)){
        if($usuarios[$login][2]==ROL_PROFESOR){
            return ROL_PROFESOR; 
        }else{
            return ROL_ALUMNO; 
        }
    }
    
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    $clave=0; 

    global $nombreModulos;
    global $notas;
    global $usuarios;


    $msg .= " Bienvenido/a alumno/a: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    // Completar

    //RECOGER LA CLAVE de ACCESO: 
    // foreach($usuarios as $key => $valor){
    //     if($valor[0]==$codigo){
    //         $clave=$onlyclaves[$key]; 
    //         break; 
    //     }
    // }

    $codigo = strval($codigo); 
    for($i=0; $i<count($nombreModulos); $i++){
        $msg.="<tr>"; 
        $msg.="<td> $nombreModulos[$i]</td>";
        $msg.="<td>".$notas[$codigo][$i]."</td>"; 
        $msg.="</tr>";       
    }


    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    $code=0; 
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $msg .= " Bienvenido Profesor: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg.="<tr>"; 
    $msg.="<td> Nombres: </td>";

    for($i=0; $i<count($nombreModulos); $i++){
        $msg.="<td> $nombreModulos[$i]</td>";
    }
    $msg.="</tr>";    

    foreach($usuarios as $clave=>$valor){
        if($valor[2]==ROL_ALUMNO){
            $msg.="<tr>"; 
            $msg.="<td>$valor[0]</td>";
            //es una guarrada, lo se. 
            for ($i=0; $i<4; $i++){
                $msg.="<td>".$notas[$clave][$i]."</td>"; 
            }
            $msg.="<tr>"; 

        }
    }

    // for($i=0; $i<count($usuarios); $i++){
    //     if($usuarios[$i][2]==ROL_ALUMNO){
    //         $msg.="<tr>"; 
    //         $msg.="<td".$usuarios[$i][0]."</td";
    //         for($i=0; $i<count($nombreModulos); $i++){
    //             if($notas[$i]!=$codigo){
    //                 for($j=0; $j<4; $j++){
    //                     $msg.="<td>".$notas[$i][$j]."</td>";
    //                 }
    //             }
    //         }
    //     }
    // }   

    $msg .= "</table>";
    return $msg;
}