<!-- Realizar la aplicación eje03.php que gestiona las preferencias
de frutas que tiene un usuario. Estas preferencias se muestran 
a partir de la información que un cookie denominado galletadefrutas
que tiene la lista de frutas que prefiere el usuario. La aplicación 
muestra esta lista en un formulario y permitirá al usuario cambiarla 
o anular la lista, borrando el cookie. -->

<?php
//Array de todas las frutas;
$arrayF=["Platano","fresa","Naranja","Melón","Manzana"];

define ("TIEMPO",time() + 7 * 24 * 60 * 60);

    $frutas=[];
    if(isset($_COOKIE["frutas"])){
        $frutas=explode(",",$_COOKIE["frutas"]);
    }

    if(isset($_GET["orden"])){
        switch($_GET["orden"]){
            case "cambiar":
                if(isset($_GET["listafrutas"])){
                    $frutas=$_GET["listafrutas"];
                    setcookie("frutas",implode(",",$frutas),TIEMPO);
                }else{
                    $msg="Se deben añadir frutas";
                }
                break;
            case "borrar":
                if(isset($_COOKIE["frutas"])){
                    setcookie("frutas","",time()-1000);
                } 
                break;
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> las frutas </title>
</head>

<body>
    <form>
        <fieldset>
            <legend>Sus frutas preferidas </legend>
            <label for="nombre">Lista de frutas:</label><br>
            <select name="listafrutas[]" multiple>
                <option value="<?=$arrayF[0]?>" <?=in_array($arrayF[0], $frutas) ? "selected=\"selected\"" : "";?>><?=$arrayF[0]?></option>
                <option value="<?=$arrayF[1]?>" <?=in_array($arrayF[1],$frutas)?"selected=\"selected\"":"";?>><?=$arrayF[1]?></option>
                <option value="<?=$arrayF[2]?>"<?=in_array($arrayF[2],$frutas)?"selected=\"selected\"":"";?>><?=$arrayF[2]?></option>
                <option value="<?=$arrayF[3]?>" <?=in_array($arrayF[3],$frutas)?"selected=\"selected\"":"";?>><?=$arrayF[3]?></option>
                <option value="<?=$arrayF[4]?>"<?=in_array($arrayF[4],$frutas)?"selected=\"selected\"":"";?>><?=$arrayF[4]?></option>
            </select>
            <button name="orden" value="cambiar"> Cambiar </button>
            <button name="orden" value="borrar"> Borrar </button>
        </fieldset>
    </form>
</body>

</html>