<form name='entrada' method="POST">
    <table>
        <tr>
            <td>Nombre:</td>
            <td> <input type="text" name="nombre" value="<?= (isset($_REQUEST['nombre'])) ? $_REQUEST['nombre'] : 'Nombre no válido' ?>"></td>
        </tr>
        <tr>
            <td>Contraseña: </td>
            <td><input type="password" name="contraseña" value="<?= (isset($_REQUEST['contraseña'])) ? $_REQUEST['contraseña'] : 'Contraseña no válida' ?>"></td>
        </tr>
    </table>
    <input type="submit" name="orden" value="Entrar">
</form>