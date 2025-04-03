<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cantidadEnPesos = floatval($_POST["pesos"]);
$valorPesos = 40; // Ejemplo 1 USD = 38.5 UYU (puedes actualizarlo) // 

$cantidadTotalDolares = $cantidadEnPesos / $valorPesos;
echo "Resultado de la Conversion";
echo " $cantidadEnPesos pesos uruguayos equivalen a " . $cantidadTotalDolares . " dolares ";
} else {
 echo "Error en la solicitud.";
}
?>