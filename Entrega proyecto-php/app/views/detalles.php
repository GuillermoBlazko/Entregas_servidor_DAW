<?php
// Obtener latitud y longitud de la IP
$json_data = file_get_contents("http://ip-api.com/json/$cli->ip_address?fields=57538");
$data = json_decode($json_data, true);
$latitud = 0;
$longitud = 0;
if (isset($data['lat']) && isset($data['lon'])) {
    $latitud = $data['lat'];
    $longitud = $data['lon'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
    <style>
      #tabla {
            width: 100%;
        }
        
        #bandera {
            float: right;
            margin-left: 20px; /* Espacio entre la tabla y la bandera */
        }

        #mapa {
            clear: both;
            /* Asegura que el mapa aparezca debajo de la tabla y la bandera */
            width: 100%;
            height: 400px; /* Altura del mapa */
        }

        #map {
            width: 100%;
            height: 100%;
        }

        /* Estilos para la tabla */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<?php
// Obtener latitud y longitud de la IP
$json_data = file_get_contents("http://ip-api.com/json/$cli->ip_address?fields=57538");
$data = json_decode($json_data, true);
$latitud = 0;
$longitud = 0;
if (isset($data['lat']) && isset($data['lon'])) {
    $latitud = $data['lat'];
    $longitud = $data['lon'];
}
?>

<!-- API de map -->
<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>

<hr>
<button onclick="location.href='./'"> Volver </button>
<?= $_SESSION["msg"] ?>
<br><br>
    <table id="tabla">
        <tr>
            <th>Información del Cliente</th>
            <th>Fotografía</th>
            <th>Bandera</th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>id:</td>
                        <td><input type="number" name="id" value="<?= $cli->id ?>" readonly> </td>
                    </tr>
                    <tr>
                        <td>first_name:</td>
                        <td><input type="text" name="first_name" value="<?= $cli->first_name ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>last_name:</td>
                        <td><input type="text" name="last_name" value="<?= $cli->last_name ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>email:</td>
                        <td><input type="email" name="email" value="<?= $cli->email ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>ip_address:</td>
                        <td><input type="text" name="ip_address" value="<?= $cli->ip_address ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>telefono:</td>
                        <td><input type="tel" name="telefono" value="<?= $cli->telefono ?>" readonly></td>
                    </tr>
                </table>
            </td>
            <td>
                <!-- AQUI ESTÁ LA PUTA IMAGEN -->
                <?= mostrarFoto($cli->id) ?>
                <!-- <?= numeroFormateado($cli->id) ?> -->
            </td>
            <td id="bandera">
                <!-- Aquí va la imagen de la bandera -->
                <img src="<?= banderaIP($cli->ip_address) ?>" alt="no hay nada">
            </td>
        </tr>
    </table>
<div id="mapa">
        <!-- Aquí va el mapa -->
        <div id="map"></div>
    </div>
<form>
    <?php $variable = $_SESSION["ordenacion"] ?>
    <input type="hidden" name="id" value="<?= $cli->$variable ?>">
    <!-- para imprimir -->
    <input type="hidden" name="identificador" value="<?= $cli->id ?>">    

    <button type="submit" name="nav-detalles" value="Anterior"> Anterior << </button>
            <button type="submit" name="nav-detalles" value="Siguiente"> Siguiente >> </button> <br>
            <button type="submit" name="nav-detalles" value="Imprimir"> Imprimir</button> <br>
</form>

    <div id="map"></div>

    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
    <script>
        var latitud = <?php echo $latitud; ?>;
        var longitud = <?php echo $longitud; ?>;

        // Crear mapa
        var map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([longitud, latitud]),
                zoom: 12
            })
        });

        // Añadir marcador
        var marker = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.fromLonLat([longitud, latitud]))
        });

        var markerStyle = new ol.style.Style({
            image: new ol.style.Icon({
                src: 'https://openlayers.org/en/latest/examples/data/icon.png'
            })
        });

        marker.setStyle(markerStyle);

        var vectorSource = new ol.source.Vector({
            features: [marker]
        });

        var markerVectorLayer = new ol.layer.Vector({
            source: vectorSource
        });

        map.addLayer(markerVectorLayer);
    </script>
</body>
</html>
