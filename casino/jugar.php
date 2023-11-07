<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jugar</title>
</head>

<body>
    <?=$resultado?>
    <p>Dispone de <?= $_SESSION["cantidad"] ?> para jugar</p>
    <p><?=$msg?></p>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <label for="dineroapuesta">Introduca el dinero que va a jugar: </label><input type="number" name="dineroApuesta" id="" min=0><br><br>
        <label for="">Tipo de apuesta: </label><input type="radio" name="apuesta" id="" value="Par">Par <input type="radio" name="apuesta" id="" value="Impar">Impar <br>
        <input type="submit" name="accion" value="Apostar"><input type="submit" name="accion" value="Añadir"><input type="submit" name="accion" value="Abandonar">
    </form>
</body>
</html>
