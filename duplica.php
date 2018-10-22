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
	require_once('PHP/sentencias.php');
	
	
	$db = conectar();
	if ($db)
	{
		$cv_principal = isset($_POST['cv_principal']) ? $_POST['cv_principal'] : null ;
		$record_id= isset($_POST['id_general']) ? $_POST['id_general'] : null ;
		$nuevo_proyecto= isset($_POST['nameDuplica']) ? $_POST['nameDuplica'] : null ;
		
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
			echo "id_nuevo: ".$id_key."<br>";
		}
		
		
		
		$sql_buscaNombre = pg_query($db, "SELECT nombre FROM coberturas  WHERE nombre = '".$nuevo_proyecto."'");
		if (!$sql_buscaNombre) { exit("Error al Buscar nombres iguales"); }
		
		
		if ( $record_id== 0)
		{
			
			$mensajesAll = "Seleccione un Metadato para Duplicar Registro";
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
		
		if (pg_num_rows ($sql_buscaNombre) <> 0)
		{
			
			$mensajesAll = "Existe al menos un metadato con el mismo nombre";
			if ( $mensajesAll != "" ) 
			{
				echo "<form id=\"frm_guardar\" name=\"frm_guardar\" method=\"post\" action=\"Menu.php?id=$record_id\">";
					echo "<input type=\"hidden\" name=\"error\" value=\"1\" />";
					echo "<input type=\"hidden\" name=\"msgs_error\" value=\"$mensajesAll\" />";
				echo "</form>";
				echo "<script type=\"text/javascript\">";
					echo "document.frm_guardar.submit();";
				echo "</script>";
			} 
		}
		
		else
		{
			//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE COBERTURAS >>>>>>> 
			
			$sql_coberturas  = "INSERT INTO coberturas SELECT '".$id_key."' , '".$id_nuevo."' , '".$nuevo_proyecto."', ";
			$sql_coberturas .= "cobertura , cita, resumen, abstract, objetivo, datos_comp, geoform, tamano, tiempo, tiempo2, avance, mantenimiento, area_geo 	,";
			$sql_coberturas .= "oeste, este, norte, sur, acceso, uso, observaciones, path, estructura_dato, tipo_dato, total_datos, datum, elipsoide, tecnicos 	,";
			$sql_coberturas .= "fecha_inicial, fecha, version, software_hardware, sistema_operativo, metodologia, descrip_metodologia, descrip_proceso 			,";
			$sql_coberturas .= "id_proyeccion, tabla, descrip_tabla, permisos, clasificacion, id_analista, idcontacto, oi, 'Proyecto' , publish, publish_siglas	,"; 
			$sql_coberturas .= "pubplace, pubplace_edo, pubplace_muni, pubplace_loc, pubdate, edition, escala, clave, issue, vis_min, vis_max ";
			$sql_coberturas .= "FROM coberturas WHERE record_id = '".$record_id."';";
			
			$res_coberturas	= pg_query($db, $sql_coberturas);
			if (!$sql_coberturas) { exit("Error al Buscar informacion de coberturas "); }
			
			// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE AUTORES >>>>>>> 
			
			$sql_autores = "INSERT INTO autores SELECT '".$id_nuevo."' , origin FROM autores WHERE dataset_id = '".$record_id."';";
			$res_autores = pg_query($db, $sql_autores);
			if (!$res_autores) { exit("Error al Buscar informacion de autores "); }
			
			
			 //<<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE LIGAS_WWW >>>>>>> 
			
			$sql_ligas = "INSERT INTO ligas_www SELECT '".$id_nuevo."' , liga_www FROM ligas_www WHERE dataset_id = '".$record_id."';";
			$res_ligas = pg_query($db, $sql_ligas);
			if (!$res_ligas) { exit("Error al Buscar informacion de ligas_www "); }
			
			
			
			//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE TEMAS_CLAVE >>>>>>> 
			
			$sql_temas = "INSERT INTO temas_clave SELECT '".$id_nuevo."' , palabra_clave FROM temas_clave WHERE dataset_id = '".$record_id."';";
			$res_temas = pg_query($db, $sql_temas);
			if (!$res_temas) { exit("Error al Buscar informacion de temas clave "); }
			
			
			//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE SITIOS_CLAVE >>>>>>> 
			
			$sql_sitios = "INSERT INTO sitios_clave SELECT '".$id_nuevo."' , sitios_clave FROM sitios_clave WHERE dataset_id = '".$record_id."';";
			$res_sitios = pg_query($db, $sql_sitios);
			if (!$res_sitios) { exit("Error al Buscar informacion de sitios_clave "); }
			
			
			//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE ATRIBUTOS >>>>>>> 
			
			$sql_atributos = "INSERT INTO atributos SELECT '".$id_nuevo."' , nombre, descipcion_atributo, fuente, unidades, tipo FROM atributos WHERE dataset_id = '".$record_id."';";
			$res_atributos = pg_query($db, $sql_atributos);
			if (!$res_atributos) { exit("Error al Buscar informacion de atributos "); }
			
			
			//// <<<<<< BUSCA TODOS LOS VALORES DE DATOS_ORIGEN >>>>>>> 
			
			
			$datos_origen = pg_query($db, 'SELECT id_origen FROM datos_origen WHERE dataset_id = '.$record_id.' ORDER BY id_origen ASC ');
			if (!$datos_origen) { exit("Error al Buscar el valores de datos_origen"); }
	
			while ($fila = pg_fetch_array($datos_origen, null, PGSQL_ASSOC))	
			{	
				$id_origen = $fila ["id_origen"];
				
				$sql_nuevoid = pg_query($db, 'SELECT "id_origen" FROM datos_origen ORDER BY "id_origen" DESC LIMIT 1');
				if (!$sql_nuevoid) { exit("Error al Buscar el valor maximo de datos_origen (id_origen)"); }
		
				while ($fila = pg_fetch_array($sql_nuevoid, null, PGSQL_ASSOC))	
				{	
					$id_keyDatos = $fila ["id_origen"];
					$id_keyDatos = $id_keyDatos + 1;
					
					//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE DATOS_ORIGEN >>>>>>> 
			
					$sql_datosOrigen  = "INSERT INTO datos_origen SELECT '".$id_keyDatos."' , '".$id_nuevo."' , ";
					$sql_datosOrigen .= "origen_dato, escala_original, formato_original, nombre, publish, publish_siglas, pubplace, pubdate, edition, geoform, srccontr, issue, onlink ";
					$sql_datosOrigen .= "FROM datos_origen WHERE id_origen = '".$id_origen."';";
					$res_datosOrigen  = pg_query($db, $sql_datosOrigen);
					if (!$res_datosOrigen) { exit("Error al Buscar informacion de datos origen "); }
					
					//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE AUTORES >>>>>>> 
			
					$autores_origen = "INSERT INTO autores_origen SELECT '".$id_keyDatos."' , origin FROM autores_origen WHERE id_origen = '".$id_origen."';";
					$res_autoresOrigen = pg_query($db, $autores_origen);
					if (!$res_autoresOrigen) { exit("Error al Buscar informacion de autores Origen "); }
				}
			}
			
			
			//// <<<<<< BUSCA TODOS LOS VALORES DE DATOS_ORIGEN >>>>>>> 
			$taxonomia = pg_query($db, 'SELECT id_taxon FROM taxonomia WHERE dataset_id = '.$record_id.' ORDER BY id_taxon ASC ');
			if (!$taxonomia) { exit("Error al Buscar el valores de taxonomia"); }
	
			while ($fila = pg_fetch_array($taxonomia, null, PGSQL_ASSOC))	
			{	
				$id_taxon = $fila ["id_taxon"];

				$max_taxonomia = pg_query($db, 'SELECT "id_taxon" FROM taxonomia ORDER BY "id_taxon" DESC LIMIT 1');
				if (!$max_taxonomia) { exit("Error al Buscar el valor maximo de taxonomia (id_taxon)"); }
				
				while ($fila = pg_fetch_array($max_taxonomia, null, PGSQL_ASSOC))	
				{	
					$max_taxonId = $fila ["id_taxon"];
					$max_taxonId = $max_taxonId + 1;
					
					//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE TAXONOMIA >>>>>>> 
			
					$sql_taxonomia  = "INSERT INTO taxonomia SELECT '".$max_taxonId."' , '".$id_nuevo."' , ";
					$sql_taxonomia .= "reino, division, clase, orden, familia, genero, especie, nombre_comun, cobertura, cita ";
					$sql_taxonomia .= "FROM taxonomia WHERE id_taxon = '".$id_taxon."';";
					$res_taxonomia  = pg_query($db, $sql_taxonomia);
					if (!$res_taxonomia) { exit("Error al Buscar informacion de taxonomia "); }
					
					
					$taxon_cita = pg_query($db, 'SELECT idau_taxon FROM taxon_cita WHERE id_taxon = '.$id_taxon.' ORDER BY idau_taxon ASC ');
					if (!$taxon_cita) { exit("Error al Buscar el valores de taxon_cita"); }
			
					while ($fila = pg_fetch_array($taxon_cita, null, PGSQL_ASSOC))	
					{	
						$idau_taxon = $fila ["idau_taxon"];
						
						$max_taxonCita = pg_query($db, 'SELECT "idau_taxon" FROM taxon_cita ORDER BY "idau_taxon" DESC LIMIT 1');
						if (!$max_taxonCita) { exit("Error al Buscar el valor maximo de taxon_cita (idau_taxon)"); }
					
						while ($fila = pg_fetch_array($max_taxonCita, null, PGSQL_ASSOC))	
						{	
							$idau_taxon_max = $fila ["idau_taxon"];
							$idau_taxon_max = $idau_taxon_max + 1;
							
							//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE DATOS_ORIGEN >>>>>>> 
			
							$sql_taxonCita  = "INSERT INTO taxon_cita SELECT '".$idau_taxon_max."' , '".$max_taxonId."' , ";
							$sql_taxonCita .= "cita, title,  publish, publish_siglas, pubplace, pubdate, edition, sername ,issue ";
							$sql_taxonCita .= "FROM taxon_cita WHERE idau_taxon = '".$idau_taxon."';";
							$res_taxonCita  = pg_query($db, $sql_taxonCita);
							if (!$res_taxonCita) { exit("Error al Buscar informacion de taxon Cita "); }
							
							 ////<<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE AUTORES >>>>>>> 
					
							$autores_taxon = "INSERT INTO autores_taxon SELECT '".$idau_taxon_max."' , origin FROM autores_taxon WHERE idau_taxon = '".$idau_taxon."';";
							$res_autoresTaxon = pg_query($db, $autores_taxon);
							if (!$res_autoresTaxon) { exit("Error al Buscar informacion de autores taxon "); }
						}
					}
				}
			}
			
			
			//// <<<<<< BUSCA Y DUPLICA TODOS LOS VALORES DE RASTER >>>>>>> 
			
			$sql_raster = "INSERT INTO raster SELECT '".$id_nuevo."' , nun_renglones, num_columnas, pixel, coor_x, coor_y, pixel_x, pixel_y  FROM raster WHERE record_id = '".$record_id."';";
			$res_raster = pg_query($db, $sql_raster);
			if (!$res_raster) { exit("Error al Buscar informacion raster "); }
			
			$mensajesAll = "El Metadato se ha duplicado.";
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
	}// fin if DB	
} // fin else
?>
