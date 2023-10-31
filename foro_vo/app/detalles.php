<div>
<?=include_once "funciones.php"?>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?=str_word_count($_REQUEST['comentario'])?></td></tr>
<tr><td>Letra + repetida:  </td><td><?=contarletras($_REQUEST['comentario'])?></td></tr>
<tr><td>Palabra + repetida:</td><td><?=contarPalabras($_REQUEST['comentario'])?></td></tr>
</table>
</div>

