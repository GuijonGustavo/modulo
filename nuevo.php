<?php 
session_start();
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{
		$mensajesAll = "Su sesion ha finalizado.";
		if ( $mensajesAll != "" ) 
		{
			echo "<form name=\"error\"  id=\"frm_error\" method=\"post\" action=\"index.php\">";
				echo "<input type=\"hidden\" name=\"actualiza_error\" value=\"1\" />";
				echo "<input type=\"hidden\" name=\"msg_error\" value=\"$mensajesAll\">";
			echo "</form>";
			echo "<script type=\"text/javascript\"> ";
				echo "document.error.submit();";
			echo "</script>";
		}
}
else
{
	ini_set("display_errors", "on");
	header('Content-Type: text/html; charset=utf-8'); 
	require('PHP/conn.php');
	require('PHP/funciones.php');
	$db = conectar();
	if ($db)
	{
		$cv_principal = isset($_POST['cv_principal']) ? $_POST['cv_principal'] : null ;
		$record_id= isset($_POST['id_general']) ? $_POST['id_general'] : null ;
		
		$nuevo_proyecto= isset($_POST['name']) ? $_POST['name'] : null ;
		
		
		
		$sql_nuevo = pg_query($db, "SELECT record_id FROM coberturas ORDER BY record_id DESC LIMIT 1");
		if (!$sql_nuevo) { exit("Error al Buscar el valor maximo de coberturas (record_id)"); }

		while ($fila = pg_fetch_array($sql_nuevo, null, PGSQL_ASSOC))	
		{	
			$id_nuevo = $fila ["record_id"];
			$id_nuevo = $id_nuevo + 1;
		}
		
		$sql_nuevoid = pg_query($db, 'SELECT "id_nuevo" FROM coberturas ORDER BY "id_nuevo" DESC LIMIT 1');
		if (!$sql_nuevoid) { exit("Error al Buscar el valor maximo de coberturas (IDNuevo)"); }

		while ($fila = pg_fetch_array($sql_nuevoid, null, PGSQL_ASSOC))	
		{	
			$id_key = $fila ["id_nuevo"];
			$id_key = $id_key + 1;
		}
		
		
		//echo "IDNuevo: ".$id_key. " record_id: ". $id_nuevo. "<br> id analista: " .$cv_principal . "<br> nombre del Proyecto: ".$nuevo_proyecto."<br>";
		
		
		$sql_buscaNombre = pg_query($db, "SELECT nombre FROM coberturas  WHERE nombre = '".$nuevo_proyecto."'");
		if (!$sql_buscaNombre) { exit("Error al Buscar nombres iguales"); }
		
		//echo (pg_num_rows($sql_buscaNombre));
		
		if (pg_num_rows ($sql_buscaNombre) == 0)
		{
			
			$sqlupd  = "INSERT INTO coberturas (id_nuevo ,record_id , nombre , id_analista) VALUES ( ";
			$sqlupd .= " ".$id_key.	" , ";
			$sqlupd .= " '".$id_nuevo."',  "; 
			$sqlupd .= " '".$nuevo_proyecto."',  "; 
			$sqlupd .= " '".$cv_principal.	"'  "; 	
			$sqlupd .= " ) ";
			$sql =  pg_query($db, $sqlupd);
			if (!$sql) { exit("Error al insertar la informacion  de atributos en el div 10"); }
			
			//echo "se ha insertado";
			
			$mensajesAll = "El Metadato a sido creado.";
			if ( $mensajesAll != "" ) 
			{
				echo "<form id=\"frm_guardar\" name=\"frm_guardar\" method=\"post\" action=\"Menu.php?id=$id_nuevo\">";
					echo "<input type=\"hidden\" name=\"actualiza\" value=\"1\" />";
					echo "<input type=\"hidden\" name=\"msgs_actualiza\" value=\"$mensajesAll\" />";
				echo "</form>";
				echo "<script type=\"text/javascript\">";
					echo "document.frm_guardar.submit();";
				echo "</script>";
			} 
		}
		
		else
		{
			$mensajesAll = "Existe al menos un metadato con el mismo nombre";
			if ( $mensajesAll != "" ) 
			{
				echo "<form id=\"frm_guardar\" name=\"frm_guardar\" method=\"post\" action=\"Menu.php\">";
					echo "<input type=\"hidden\" name=\"error\" value=\"1\" />";
					echo "<input type=\"hidden\" name=\"msgs_error\" value=\"$mensajesAll\" />";
				echo "</form>";
				echo "<script type=\"text/javascript\">";
					echo "document.frm_guardar.submit();";
				echo "</script>";
			} 
		}
		
		
		
	}// fin if DB	
} // fin else
?>
