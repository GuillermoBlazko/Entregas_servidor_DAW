
<?php
class BiciElectrica
{
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)

    function __construct($id, $coordx, $coordy, $bateria, $operativa)
    {
        $this->id = $id;
        $this->coordx = $coordx;
        $this->coordy = $coordy;
        $this->bateria = $bateria;
        $this->operativa = $operativa;
    }

    function __set($campo, $valor)
    {
        $this->$campo = $valor;
    }

    function __get($campo)
    {
        return $this->$campo;
    }

    function __toString()
    {
        return ": $this->id en las coordenadas: $this->coordx X | $this->coordy Y | con una batería $this->bateria% ";
    }
}

?>
