<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('conn.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$orden=$_POST['orden'];

$cat = catalogos();
$db = conectar();
if($cat)
{
	$datalist = "SELECT DISTINCT nom_orden  FROM taxonomia WHERE nom_clase = '".$orden."' ORDER BY nom_orden  ASC";
	$resdata = pg_query($cat, $datalist);
	if (!$resdata) { exit("Error en la consulta"); }
	echo  "<datalist id=\"t_orden\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_t) { echo  "<option value=\"$valor_t\">";	}	} echo  "</datalist>";

}
?>
