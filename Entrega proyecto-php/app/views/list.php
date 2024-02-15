<!--OLD FORM: Tipo de ordenación -->
<!-- <form action="">
    orden:
    <select name="ordenacion" id="orden">
        <option value="id">id</option>
        <option value="first_name">First_name</option>
        <option value="email">email</option>
        <option value="gender">gender</option>
        <option value="ip_address">ip_address</option>
        <option value="telefono">telefono</option>
    </select>

    <input type="submit" value=" aceptar ">
</form> -->
<br>
<table>
<tr>
        <th><a href="?ordenacion=id">id</a> <?=($ordenAD == "ASC")?"▲":"▼"?></th>
        <th><a href="?ordenacion=first_name">first_name</a> <?=($ordenAD == "ASC")?"▲":"▼"?></th>
        <th><a href="?ordenacion=email">email</a> <?=($ordenAD == "ASC")?"▲":"▼"?></th>
        <th><a href="?ordenacion=gender">gender</a> <?=($ordenAD == "ASC")?"▲":"▼"?>
        <th><a href="?ordenacion=ip_address">ip_address</a> <?=($ordenAD == "ASC")?"▲":"▼"?>
        <th><a href="?ordenacion=telefono">teléfono</a> <?=($ordenAD == "ASC")?"▲":"▼"?>
    </tr>
    <?php foreach ($tvalores as $valor) : ?>
        <tr>
            <td><?= $valor->id ?> </td>
            <td><?= $valor->first_name ?> </td>
            <td><?= $valor->email ?> </td>
            <td><?= $valor->gender ?> </td>
            <td><?= $valor->ip_address ?> </td>
            <td><?= $valor->telefono ?> </td>
            <td>Borrar</td>
            <td>Modificar</td>
            <td><a href="?orden=Detalles&id=<?= $valor->id ?>">Detalles</a></td>

        <tr>
        <?php endforeach ?>
</table>

<form>
    <br>
    <button type="submit" name="nav" value="Primero">
        << </button>
            <button type="submit" name="nav" value="Anterior">
                < </button>
                    <button type="submit" name="nav" value="Siguiente"> > </button>
                    <button type="submit" name="nav" value="Ultimo"> >> </button>
                    <br>
</form>
<form action="" style="text-align: right;">
    <button type="submit" name="orden" value="Terminar">Terminar</button>
</form>
