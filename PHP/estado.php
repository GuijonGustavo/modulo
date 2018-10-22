<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('conn.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$estado=$_POST['pais'];
echo $estado;
$cat = catalogos();
$db = conectar();
if($cat){

if ($estado==2)
	{
		$sql_select = 'SELECT "cve_ent", "nom_ent" FROM estados WHERE "cve_pais" = '.$estado.' ORDER BY "nom_ent" ASC';
		$res_select = pg_query($cat, $sql_select);
		if (!$res_select) { exit("Error en la consulta"); }
	
		echo "<option value=\"\">Seleccione un estado</option>";
	
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				echo  "<option value=\"$clave\">$nombre</option>";
			}
		echo  "</select>";

}

elseif ($estado==1)
{
		$sql_select = 'SELECT "cve_dto", "nom_dto" FROM dtos_gt WHERE "cve_pais" = '.$estado.' ORDER BY "nom_dto" ASC';
		$res_select = pg_query($cat, $sql_select);
		if (!$res_select) { exit("Error en la consulta"); }
	
		echo "<option value=\"\">Seleccione un estado</option>";
	
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				echo  "<option value=\"$clave\">$nombre</option>";
			}
		echo  "</select>";
 }
}
?>
