<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('conn.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$municipio=$_POST['estado'];
echo $municipio;
$cat = catalogos();
$db = conectar();
if($cat)
{
		$sql_select = 'SELECT "cve_mun", "nom_mun" FROM municipios WHERE "cve_ent" = '.$municipio.' ORDER BY "nom_mun" ASC';
		$res_select = pg_query($cat, $sql_select);
		if (!$res_select) { exit("Error en la consulta"); }
	
		echo "<option value=\"\">Seleccione un municipio</option>";
	
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				echo  "<option value=\"$clave\">$nombre</option>";
			}
		echo  "</select>";
}
?>
