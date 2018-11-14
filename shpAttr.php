<?php
require_once('php-shapefile/src/ShapeFileAutoloader.php');
\ShapeFile\ShapeFileAutoloader::register();

use \ShapeFile\ShapeFile;
use \ShapeFile\ShapeFileException;

$rutaShapes = 'files/'.$nameFileSession.'/'.$nameFileSession.'.shp';
echo "<pre>";
try {
//$ShapeFile = new ShapeFile('/var/www/html/modulo_cbm/files/potfla_dcgw/potfla_dcgw.shp');
$ShapeFile = new ShapeFile($rutaShapes);

$valores = $ShapeFile->getDBFFields();
    $tabla = "";
for ($i = 0; $i < sizeof($valores); $i++) {
    $fila = (string)$valores[$i]['name'];
        $tabla .= "<tr><td style='border: 1px solid blue';>".$fila."</td><td style='border: 1px solid blue';></td></tr>";
}


//echo $tabla;
echo "<table style='border: 1px solid blue; padding: 15px; background-color: #e5efff;'><tr><th>Atributos</th><th>Color</th></tr>".$tabla."</table>";

} catch (ShapeFileException $e) {
exit('Error '.$e->getCode().' ('.$e->getErrorType().'): '.$e->getMessage());
}
echo "</pre>";
         ?>

