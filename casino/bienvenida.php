
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <style>
        h1 {
            font-size: 1.43em;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <h1>bienvenido al casino</h1>
    <p>Esta es su <?= $_SESSION["visita"] ?> º visita:</p>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        Introduzca el dinero con el que va a jugar: <input type="number" name="dineroInicial" min=0><br>
        <input type="submit" name="accion" value="" hidden>
    </form>
    <?=$msg?>
</body>

</html>