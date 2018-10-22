<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('conn.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$familia=$_POST['familia'];

$cat = catalogos();
$db = conectar();
if($cat)
{
	$datalist = "SELECT DISTINCT nom_familia  FROM taxonomia WHERE nom_orden = '".$familia."' ORDER BY nom_familia  ASC";
	$resdata = pg_query($cat, $datalist);
	if (!$resdata) { exit("Error en la consulta"); }
	echo  "<datalist id=\"t_familia\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_t) { echo  "<option value=\"$valor_t\">";	}	} echo  "</datalist>";

}
?>
