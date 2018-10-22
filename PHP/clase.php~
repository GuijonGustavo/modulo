<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('conn.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$clase=$_POST['clase'];

$cat = catalogos();
$db = conectar();
if($cat)
{
	$datalist = "SELECT DISTINCT nom_clase  FROM taxonomia WHERE nom_division = '".$clase."' ORDER BY nom_clase  ASC";
	$resdata = pg_query($cat, $datalist);
	if (!$resdata) { exit("Error en la consulta"); }
	echo  "<datalist id=\"t_clase\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_t) { echo  "<option value=\"$valor_t\">";	}	} echo  "</datalist>";

}
?>
