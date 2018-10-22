<?php 
session_start();
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{
	$mensajesAll = "FAVOR DE INICIAR SESSION.";
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
		$contenido = $_GET["hoja"];
		$record_id = $_GET["id"];
		$cv_principal = $_GET["cv_principal"];
		$valor_null = "";
		$sqlupd_c = ""; //Se inicializa pa variable para que no tenga problemas en 918
		
		switch ($contenido)
		{
			case "datos":
			{
				//if ($_POST['c_pubplace'] == ""){	echo "imprime vacio"; }
				//<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 1 >>>>>>>>>>>>>
				$sqlupd  = "UPDATE coberturas SET ";  
				$sqlupd .= "nombre 			= '".$_POST['c_nombre'] 		."',";
				$sqlupd .= "cobertura 		= '".$_POST['c_cobertura'] 		."',";
				$sqlupd .= "publish 		= '".$_POST['c_publish'] 		."',";
				$sqlupd .= "publish_siglas 	= '".$_POST['c_publish_siglas'] ."',";
				$sqlupd .= "pubplace_edo	= '".$_POST['estado'] 			."',";
				
				if (isset($_POST['municipio'])) { $sqlupd .= "pubplace_muni	= '".$_POST['municipio']."',";}
				else 							{ $sqlupd .= "pubplace_muni	= '".$valor_null."',";}
				
				if (isset($_POST['localidad'])) { $sqlupd .= "pubplace_loc	= '".$_POST['localidad']."',";
												  $sqlupd .= "pubplace	= '".$valor_null."',";
												}
				else 							{ $sqlupd .= "pubplace_loc	= '".$valor_null."',";
				  								  $sqlupd .= "pubplace	= '".$_POST['c_pubplace']."',";
												} 
				$sqlupd .= "pubdate 		= '".$_POST['c_pubdate'] 		."',";
				$sqlupd .= "edition 		= '".$_POST['c_edition'] 		."',";
				$sqlupd .= "escala 			= '".$_POST['c_escala'] 		."',";
				$sqlupd .= "clave 			= '".$_POST['c_clave'] 			."',";
				$sqlupd .= "issue 			= '".$_POST['c_issue'] 			."',";
				$sqlupd .= "resumen 		= '".$_POST['c_resumen'] 		."',";
				$sqlupd .= "abstract 		= '".$_POST['c_abstract'] 		."',";
				$sqlupd .= "objetivo 		= '".$_POST['c_objetivo'] 		."',";
				$sqlupd .= "datos_comp 		= '".$_POST['c_datos_comp'] 	."',";
				$sqlupd .= "tiempo 			= '".$_POST['c_tiempo'] 		."',";
				$sqlupd .= "tiempo2			= '".$_POST['c_tiempo2'] 		."',";
				$sqlupd .= "avance			= '".$_POST['c_avance'] 		."',";
				$sqlupd .= "mantenimiento 	= '".$_POST['c_mantenimiento'] 	."',";
				$sqlupd .= "tamano 			= '".$_POST['c_tamano'] 		."',";
				$sqlupd .= "fecha_inicial 	= '".$_POST['c_fecha_inicial'] 	."',";
				$sqlupd .= "fecha 			= '".$_POST['c_fecha'] 			."',";
				$sqlupd .= "version 		= '".$_POST['c_version'] 		."',";
				$sqlupd .= "geoform 		= '".$_POST['c_geoform'] 		."'";
				$sqlupd .= " WHERE record_id = '" .$record_id 				."'";
				
				$sql_div1 =  pg_query($db, $sqlupd);
				if (!$sql_div1) { exit("Error al actualizar la información del div 1"); } 
				
				/// ACTUALIZA LOS AUTORES
		
				$delete_origin =  pg_query($db, "DELETE FROM autores WHERE dataset_id = '".$record_id."'");
				$x_origin = $_POST['x_origin'];
				foreach ($x_origin as $key => $value) 
				{
					if ($value <> "" ) 
					{
						$sql_origin =  "INSERT INTO autores (dataset_id, origin) VALUES ('" .$record_id. "','" .$value."')";
						$res_origin =  pg_query($db, $sql_origin);
						if (!$res_origin) { exit("Error al actualizar la información de autores del div 1"); }
					}
				}
				
				/// ACTUALIZA LAS LIGAS
				
				$delete_ligaWWW =  pg_query($db, "DELETE FROM ligas_www WHERE dataset_id = '".$record_id."'");
				$l_liga_www = $_POST['l_liga_www'];
				foreach ($l_liga_www as $key => $value) 
				{
					if ($value <> "" ) 
					{
						$sql_ligaWWW =  "INSERT INTO ligas_www (dataset_id, liga_www) VALUES ('" .$record_id. "','" .$value."')";
						$res_ligaWWW =  pg_query($db, $sql_ligaWWW);
						if (!$res_ligaWWW) { exit("Error al actualizar la información de ligas del div 1"); }
					}
				}
			} break;
			
			case "ubicacion":
			{
			 	//<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 2 >>>>>>>>>>>>>
				$sqlupd2 = "UPDATE coberturas SET ";  
				$sqlupd2 .= "area_geo 	= '".$_POST['c_area_geo'] 	."', ";
				$sqlupd2 .= "oeste 		= '".$_POST['c_oeste'] 		."', ";
				$sqlupd2 .= "este 		= '".$_POST['c_este'] 		."', ";
				$sqlupd2 .= "norte 		= '".$_POST['c_norte'] 		."', ";
				$sqlupd2 .= "sur 		= '".$_POST['c_sur'] 		."' ";
				$sqlupd2 .= " WHERE record_id = '" .$record_id 		."'";
				
				$sql_div2 =  pg_query($db, $sqlupd2);
				if (!$sql_div2) { exit("Error al actualizar la información del div 2"); }
				
			} break;
			
			case "restricciones":
			{
				//<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 3 >>>>>>>>>>>>>
				$sqlupd3  = "UPDATE coberturas SET ";  
				$sqlupd3 .= "acceso 			= '".$_POST['c_acceso'] 		."', ";
				$sqlupd3 .= "uso 				= '".$_POST['c_uso'] 			."', ";
				$sqlupd3 .= "observaciones 		= '".$_POST['c_observaciones'] 	."' ";
				$sqlupd3 .= " WHERE record_id 	= '" .$record_id 				."'";
				
				$sql_div3 =  pg_query($db, $sqlupd3);
				if (!$sql_div3) { exit("Error al actualizar la información del div 3"); }
			} break;
			
			case "palabrasClave":
			{
			  //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 4 >>>>>>>>>>>>>
				/// ACTUALIZA LOS TEMAS
				
				$delete_Palabra_Clave =  pg_query($db, "DELETE FROM temas_clave WHERE dataset_id = '".$record_id."'");
				$Palabra_Clave = $_POST['m_Palabra_Clave'];
				foreach ($Palabra_Clave as $key => $value) 
				{
					if ($value <> "" ) 
					{
						$sql_clave =  "INSERT INTO temas_clave (dataset_id, palabra_clave) VALUES ('" .$record_id. "','" .$value."')";
						$res_clave =  pg_query($db, $sql_clave);
						if (!$res_clave) { exit("Error al actualizar la información de temas del div 4"); }
					}
				}
				
				/// ACTUALIZA LOS SITIOS
				
				$delete_Sitios_Clave =  pg_query($db, "DELETE FROM sitios_clave WHERE dataset_id = '".$record_id."'");
				$Sitios_Clave = $_POST['s_Sitios_Clave'];
				foreach ($Sitios_Clave as $key => $value) 
				{
					if ($value <> "" ) 
					{
						$sql_sitios =  "INSERT INTO sitios_clave (dataset_id, sitios_clave) VALUES ('" .$record_id. "','" .$value."')";
						$res_sitios =  pg_query($db, $sql_sitios);
						if (!$res_sitios) { exit("Error al actualizar la información de sitios del div 4"); }
					}
				}
			} break;
			
			case "ambienteDeTrabajo":
			{
			  //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 5 >>>>>>>>>>>>>
		
				$sqlupd5  = "UPDATE coberturas SET ";  
				$sqlupd5 .= "software_hardware 	= '".$_POST['c_software_hardware'] 	."', ";
				$sqlupd5 .= "sistema_operativo 	= '".$_POST['c_sistema_operativo'] 	."', ";
				$sqlupd5 .= "tecnicos 			= '".$_POST['c_tecnicos'] 			."', ";
				$sqlupd5 .= "path 				= '".$_POST['c_path'] 				."' ";
				$sqlupd5 .= " WHERE record_id 	= '" .$record_id 					."'";
				
				$sql_div5 =  pg_query($db, $sqlupd5);
				if (!$sql_div5) { exit("Error al actualizar la información del div 5"); }
			} break;

	
			case "RegistroColaborador":
			{
			  //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 12 >>>>>>>>>>>>>
	
			$nombreCapturista = $_POST['nombreCapturista'];
			$puestoCapturista = $_POST['puestoCapturista']; 
			$telCapturista = $_POST['telCapturista'];
			$correoCapturista = $_POST['correoCapturista'];
			$userCapturista = $_POST['userCapturista'] ;
			$passCapturista = $_POST['passCapturista'];
			$activoCapturista = $_POST['activoCapturista'];
			$activoCapturista = (int) $activoCapturista;


			$sqlupd_c  = 'INSERT INTO analistas ("Persona","Puesto","Telefono", mail, nom_user, password, activo) VALUES ( ';
			$sqlupd_c .= " '".$nombreCapturista."' , ";
			$sqlupd_c .= " '".$puestoCapturista."' , ";
			$sqlupd_c .= " '".$telCapturista."' , ";
			$sqlupd_c .= " '".$correoCapturista."' , ";
			$sqlupd_c .= " '".$userCapturista."',  "; 
			$sqlupd_c .= " '".$passCapturista."',  "; 
			$sqlupd_c .= "".$activoCapturista.""  ; 
			$sqlupd_c .= " ) ";
		//	$sql =  pg_query($db, $sqlupd_c);
		//	if (!$sql) { exit("Error al insertar la informacion  de atributos en el div 12"); }
			$sqlupd_c =  pg_query($db, $sqlupd_c);
			if (!$sqlupd_c) { exit("Error al insertar la informacion  de atributos en el div 12"); }
			
			} break;
			





			case "calidadDeDatos":
			{
			  //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 6 >>>>>>>>>>>>>
		
				$sqlupd6  = "UPDATE coberturas SET ";  
				$sqlupd6 .= "metodologia 			= '".$_POST['c_metodologia'] 		."', ";
				$sqlupd6 .= "descrip_metodologia 	= '".$_POST['c_descrip_metodologia']."', ";
				$sqlupd6 .= "descrip_proceso 		= '".$_POST['c_descrip_proceso'] 	."' ";
				$sqlupd6 .= " WHERE record_id 	= '" .$record_id 						."'";
				
				$sql_div6 =  pg_query($db, $sqlupd6);
				if (!$sql_div6) { exit("Error al actualizar la información del div 6"); }
				
				$nombre	 	= $_POST['d_nombre']; 
				$publish 	= $_POST['d_publish'];
				$siglas 	= $_POST['d_siglas'];
				$pubplace 	= $_POST['d_pubplace'];
				$edition 	= $_POST['d_edition'];
				$escala 	= $_POST['d_escala'];
				$pubdate 	= $_POST['d_pubdate'];
				$formato 	= $_POST['d_formato'];
				$geoform 	= $_POST['d_geoform'];
				$srccontr 	= $_POST['d_srccontr'];
				$issue 		= $_POST['d_issue'];
				$onlink 	= $_POST['d_onlink'];
				$idorigen 	= $_POST['d_idorigen'];
				
				
				$sql_buscaDatos = pg_query($db, "SELECT id_origen FROM datos_origen  WHERE dataset_id = '".$record_id."' ORDER BY id_origen ASC");
				if (!$sql_buscaDatos) { exit("Error al Buscar valores a la base de datos"); }
				
				$array_datos = array();
				$array_origen = array();
				
				while ($fila = pg_fetch_array($sql_buscaDatos, null, PGSQL_ASSOC))	{	$array_datos [] = $fila ["id_origen"];	}
				
				$sql_buscaMax = pg_query($db, "SELECT id_origen FROM datos_origen  ORDER BY id_origen DESC LIMIT 1");
				if (!$sql_buscaMax) { exit("Error al Buscar el valor maximo del div 6 a la base de datos"); }
					
				$val_maxId = 0;
				if (pg_num_rows ($sql_buscaMax) <> "")
				{
					while ($fila = pg_fetch_array($sql_buscaMax)) 
					{
						$val_maxId = $fila [0]; 
						$val_maxId = $val_maxId + 1;
					}
				}
				else {$val_maxId = $val_maxId + 1;}
						
				
				
				foreach ($idorigen as $fila => $valor)
				{
					$array_origen [] = $idorigen[$fila];
					if ($valor <> 0)
					{
						$sqlupd_d6  = "UPDATE datos_origen SET ";  
						$sqlupd_d6 .= "nombre 			= '".$nombre[$fila] 	."',";
						$sqlupd_d6 .= "publish 			= '".$publish[$fila] 	."',";
						$sqlupd_d6 .= "publish_siglas 	= '".$siglas[$fila]  	."',";
						$sqlupd_d6 .= "pubplace 		= '".$pubplace[$fila]  	."',";
						$sqlupd_d6 .= "edition			= '".$edition[$fila]  	."',";
						$sqlupd_d6 .= "escala_original	= '".$escala[$fila]  	."',";
						$sqlupd_d6 .= "pubdate			= '".$pubdate[$fila]  	."',";
						$sqlupd_d6 .= "formato_original	= '".$formato[$fila]  	."',";
						$sqlupd_d6 .= "geoform 			= '".$geoform[$fila]  	."',";
						$sqlupd_d6 .= "srccontr 		= '".$srccontr[$fila]  	."',";
						$sqlupd_d6 .= "issue 			= '".$issue[$fila]  	."',";
						$sqlupd_d6 .= "onlink 			= '".$onlink[$fila] 	."'";
						$sqlupd_d6 .= "WHERE id_origen 	= '".$valor 			."'";
						
						$sql_d6 =  pg_query($db, $sqlupd_d6);
						if (!$sql_d6) { exit("Error al actualizar la información del div 6 tabla_d"); }
						
						
						
						// ACTUALIZA LOS AUTORES
				
						$delete_origin =  pg_query($db, "DELETE FROM autores_origen WHERE id_origen = '".$valor."'");
						$campo_origin 	= "h_origin".$valor;
						$h_origin		=  $_POST[$campo_origin];
						
						foreach ($h_origin as $key => $value) 
						{
							if ($value <> "" ) 
							{
								$sql_origin =  "INSERT INTO autores_origen (id_origen, origin) VALUES ('" .$valor. "','" .$value."')";
								$res_origin =  pg_query($db, $sql_origin);
								if (!$res_origin) { exit("Error al actualizar la información de autores del div 6"); }
							}
						}
					}
					else
					{
						if  ( $nombre[$fila] <> "")
						{
							$sqlupd_d6  = "INSERT INTO datos_origen (id_origen, dataset_id , nombre, publish, publish_siglas, pubplace,edition, escala_original, pubdate, formato_original, geoform, srccontr, issue, onlink) VALUES ( ";
							$sqlupd_d6 .= " ".$val_maxId.		" , ";
							$sqlupd_d6 .= " ".$record_id.		" , ";
							
							if  ( $nombre[$fila] <> "")	{	$sqlupd_d6 .= " '".$nombre[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $publish[$fila] <> ""){	$sqlupd_d6 .= " '".$publish[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $siglas[$fila] <> "")	{	$sqlupd_d6 .= " '".$siglas[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $pubplace[$fila] <> ""){	$sqlupd_d6 .= " '".$pubplace[$fila]."',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $edition[$fila] <> ""){	$sqlupd_d6 .= " '".$edition[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $escala[$fila] <> "")	{	$sqlupd_d6 .= " '".$escala[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $pubdate[$fila] <> ""){	$sqlupd_d6 .= " '".$pubdate[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $formato[$fila] <> ""){	$sqlupd_d6 .= " '".$formato[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $geoform[$fila] <> ""){	$sqlupd_d6 .= " '".$geoform[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $srccontr[$fila] <> ""){	$sqlupd_d6 .= " '".$srccontr[$fila]."',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $issue[$fila] <> "")	{	$sqlupd_d6 .= " '".$issue[$fila].	"',  "; }
							else 						{	$sqlupd_d6 .= " null,	";	}
							
							if  ( $onlink[$fila] <> "")	{	$sqlupd_d6 .= " '".$onlink[$fila].	"'  "; 	}
							else 						{	$sqlupd_d6 .= "null";						}
							
							$sqlupd_d6 .= " ) ";
							$sql_d6 =  pg_query($db, $sqlupd_d6);
							if (!$sql_d6) { exit("Error al insertar la informacion del div 6 tabla_d"); }
							
							$campo_origin 	= "h_origin0";
							$h_origin		=  $_POST[$campo_origin];
							
							foreach ($h_origin as $key => $value) 
							{
								if ($value <> "" ) 
								{
									$sql_origin =  "INSERT INTO autores_origen (id_origen, origin) VALUES ('" .$val_maxId. "','" .$value."')";
									$res_origin =  pg_query($db, $sql_origin);
									if (!$res_origin) { exit("Error al actualizar la información de autores del div 6"); }
								}
							}
						}
					}
				} // FIN foreach ($idorigen as $fila => $valor) 
				
				
			$diff_datos = array_diff($array_datos , $array_origen);
				
				if (count ($diff_datos) <> 0)
				{
					foreach ($diff_datos as $fila => $valor)
					{
						$delete_datos = pg_query ($db ,"DELETE FROM datos_origen WHERE id_origen = '".$diff_datos [$fila]."'");
						if (!$delete_datos) { exit("Error al eliminar datos"); }
						
						$delete_autores = pg_query ($db ,"DELETE FROM autores_origen WHERE id_origen = '".$diff_datos [$fila]."'");
						if (!$delete_datos) { exit("Error al eliminar autores_origen"); }
					}
				}
			} break;
			
			
			case "taxonomia":
			{
			  //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 7 >>>>>>>>>>>>>
				
				$taxon 		= $_POST["t_taxon"]; 
				$reino		= $_POST["t_reino"];
				$division 	= $_POST["t_division"];
				$clase 		= $_POST["t_clase"];
				$orden 		= $_POST["t_orden"];
				$familia 	= $_POST["t_familia"];
				$genero 	= $_POST["t_genero"];
				$especie 	= $_POST["t_especie"];
				$nomcom 	= $_POST["t_nombre_comun"];
				$idtax 		= $_POST["t_idtax"];
				
				
				$sql_DatosTaxonomia = pg_query($db, "SELECT id_taxon FROM taxonomia  WHERE dataset_id = '".$record_id."' ORDER BY id_taxon ASC");
				if (!$sql_DatosTaxonomia) { exit("Error al Buscar valores a la base de datos de Taxonomia"); }
				
				$array_taxonomia = array();
				$array_origenTaxonomia = array();
				
				if (pg_num_rows ($sql_DatosTaxonomia) <> "") {	while ($fila = pg_fetch_array($sql_DatosTaxonomia, null, PGSQL_ASSOC))	{	$array_taxonomia [] = $fila ["id_taxon"];	}}
				else { $array_taxonomia [] = 0;}
				
				$sql_buscaMaxTaxon = pg_query($db, "SELECT id_taxon FROM taxonomia  ORDER BY id_taxon DESC LIMIT 1");
				if (!$sql_buscaMaxTaxon) { exit("Error al Buscar el valor maximo del div 8 a la base de toxon&oacute;mia"); }
				
				$val_maxIdTaxon = 0;
				if (pg_num_rows ($sql_buscaMaxTaxon) <> "")	
				{			
					while ($fila = pg_fetch_array($sql_buscaMaxTaxon)) 
					{
						$val_maxIdTaxon = $fila [0]; 
						$val_maxIdTaxon = $val_maxIdTaxon + 1;
					}
				}
				else { $val_maxIdTaxon = $val_maxIdTaxon + 1; }
				
				
				foreach ($idtax as $fila => $valor)
				{
					if ($taxon [$fila] <> "")
					{
						if (is_numeric($valor))
						{
							$array_origenTaxonomia [] = $idtax[$fila];
							
							$sqlupd_d8  = "UPDATE taxonomia SET ";  
							$sqlupd_d8 .= "cobertura		= '".$taxon[$fila] 		."',";
							$sqlupd_d8 .= "reino 			= '".$reino[$fila] 		."',";
							$sqlupd_d8 .= "division			= '".$division[$fila] 	."',";
							$sqlupd_d8 .= "clase			= '".$clase[$fila]  	."',";
							$sqlupd_d8 .= "orden 			= '".$orden[$fila]  	."',";
							$sqlupd_d8 .= "familia			= '".$familia[$fila]  	."',";
							$sqlupd_d8 .= "genero			= '".$genero[$fila]  	."',";
							$sqlupd_d8 .= "especie			= '".$especie[$fila]  	."',";
							$sqlupd_d8 .= "nombre_comun		= '".$nomcom[$fila] 	."'";
							$sqlupd_d8 .= "WHERE id_taxon 	= '".$valor 			."'";
							
							$sql_d8 =  pg_query($db, $sqlupd_d8);
							if (!$sql_d8) { exit("Error al actualizar la información taxonomica del div 8"); }
							
							$campo_n =  "g_title".$valor; 
							$campo_p =  "g_publish".$valor;
							$campo_s =  "g_siglas".$valor;
							$campo_c =  "g_pubplace".$valor;
							$campo_e =  "g_edition".$valor;
							$campo_d =  "g_pubdate".$valor;
							$campo_r =  "g_sername".$valor;
							$campo_i =  "g_issue".$valor;
							$campo_id = "g_idtaxon".$valor;
							$campo_ia = "g_idautaxon".$valor;
							
							$nombrec 	= $_POST[$campo_n]; 
							$publish 	= $_POST[$campo_p]; 
							$siglas 	= $_POST[$campo_s]; 
							$pubplace 	= $_POST[$campo_c]; 
							$edition 	= $_POST[$campo_e]; 
							$pubdate 	= $_POST[$campo_d]; 
							$sername 	= $_POST[$campo_r]; 
							$issue 		= $_POST[$campo_i]; 
							$idtaxon 	= $_POST[$campo_id]; 
							$idautaxon = $_POST[$campo_ia]; 
							
							$sql_DatosTaxoncita = pg_query($db, "SELECT idau_taxon FROM taxon_cita  WHERE id_taxon = '".$valor."' ORDER BY idau_taxon ASC");
							if (!$sql_DatosTaxoncita) { exit("Error al Buscar valores a la base de datos de Taxon_cita"); }
							
							$array_taxon_cita = array();
							$array_origenTaxon_cita = array();
							
							if (pg_num_rows ($sql_DatosTaxoncita) <> ""){	while ($fila = pg_fetch_array($sql_DatosTaxoncita, null, PGSQL_ASSOC))	{	$array_taxon_cita [] = $fila ["idau_taxon"];}	}
							else			{$array_taxon_cita [] = 0; }
							
							 
							 $sql_buscaMaxTc = pg_query($db, "SELECT idau_taxon FROM taxon_cita  ORDER BY idau_taxon DESC LIMIT 1");
							 if (!$sql_buscaMaxTc) { exit("Error al Buscar el valor maximo del div 8 a la base de citas toxon&oacute;micas"); }
									
							 $val_maxIdTc = 0;
							 
							 if (pg_num_rows ($sql_buscaMaxTc) <> "")
							 {
								 while ($fila = pg_fetch_array($sql_buscaMaxTc)) 
								 {
									$val_maxIdTc = $fila [0]; 
									$val_maxIdTc = $val_maxIdTc + 1;
								 }
							 }
							
							 else { $val_maxIdTc = $val_maxIdTc + 1; }
							 
							 foreach ($idautaxon as $fila => $valor_c)
							 {
								if ($nombrec [$fila] <> "")
								{
									if (is_numeric($valor_c))
									{
										$array_origenTaxon_cita [] = $idautaxon[$fila];
										
										$sqlupd_d8tc  = "UPDATE taxon_cita SET ";  
										$sqlupd_d8tc .= "title			= '".$nombrec[$fila] 	."',";
										$sqlupd_d8tc .= "publish 		= '".$publish[$fila] 	."',";
										$sqlupd_d8tc .= "publish_siglas	= '".$siglas[$fila] 	."',";
										$sqlupd_d8tc .= "pubplace		= '".$pubplace[$fila]  	."',";
										$sqlupd_d8tc .= "edition 		= '".$edition[$fila]  	."',";
										$sqlupd_d8tc .= "pubdate		= '".$pubdate[$fila]  	."',";
										$sqlupd_d8tc .= "sername		= '".$sername[$fila]  	."',";
										$sqlupd_d8tc .= "issue			= '".$issue[$fila] 		."'";
										$sqlupd_d8tc .= "WHERE idau_taxon = '".$valor_c			."'";
										
										$sql_d8tc =  pg_query($db, $sqlupd_d8tc);
										if (!$sql_d8tc) { exit("Error al actualizar la informaci&oacute;n de citas taxonomicas del div 8"); }
										
										$campo_v = "z_origin".$valor."_".$valor_c;										
										
										/// ACTUALIZA LOS AUTORES
				
										$delete_autorestc =  pg_query($db, "DELETE FROM autores_taxon WHERE idau_taxon = '".$valor_c."'");
										$z_origin = $_POST[$campo_v]; 
										foreach ($z_origin as $key => $value) 
										{
											if ($value <> "" ) 
											{
												$sql_zorigin =  "INSERT INTO autores_taxon (idau_taxon, origin) VALUES ('" .$valor_c. "','" .$value."')";
												$res_zorigin =  pg_query($db, $sql_zorigin);
												if (!$res_zorigin) { exit("Error al actualizar la información de autores de taxon cita"); }
											}
										}
										
										
										
									} // FIN if (is_numeric($valor_c))
									
									
										
										
									if (!is_numeric($valor_c))
									{
										
										$sqlupd_d8tci  = "INSERT INTO taxon_cita (idau_taxon, id_taxon, title, publish, publish_siglas, pubplace, edition, pubdate, sername, issue) VALUES ( ";
										$sqlupd_d8tci .= " ".$val_maxIdTc.	" , ";
										$sqlupd_d8tci .= " ".$valor.		" , ";
										
										if  ( $nombrec[$fila] <> ""){	$sqlupd_d8tci .= " '".$nombrec[$fila].	"',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $publish[$fila] <> ""){	$sqlupd_d8tci .= " '".$publish[$fila].	"',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $siglas[$fila] <> "")	{	$sqlupd_d8tci .= " '".$siglas[$fila].	"',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $pubplace[$fila] <> ""){	$sqlupd_d8tci .= " '".$pubplace[$fila]."',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $edition[$fila] <> ""){	$sqlupd_d8tci .= " '".$edition[$fila].	"',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $pubdate[$fila] <> ""){	$sqlupd_d8tci .= " '".$pubdate[$fila].	"',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $sername[$fila] <> ""){	$sqlupd_d8tci .= " '".$sername[$fila].	"',  "; }
										else 						{	$sqlupd_d8tci .= " null,	";	}
										
										if  ( $issue[$fila] <> "")	{	$sqlupd_d8tci .= " '".$issue[$fila].	"'  "; 	}
										else 						{	$sqlupd_d8tci .= "null";						}
										
										$sqlupd_d8tci .= " ) ";
										$sql_dtci =  pg_query($db, $sqlupd_d8tci);
										if (!$sql_dtci) { exit("Error al insertar la informacion de citas taxon&oacute;micas en el div 7"); }
										
										$z_origin2 = "z_origin".$valor."_".$valor_c;
										$autores_tc = $_POST[$z_origin2]; 
		
										foreach ($autores_tc as $key => $value) 
										{
											if ($value <> "" ) 
											{
												
												$sql_zorigin2 =  "INSERT INTO autores_taxon (idau_taxon, origin) VALUES ('" .$val_maxIdTc. "','" .$value."')";
												$res_zorigin2 =  pg_query($db, $sql_zorigin2);
												if (!$res_zorigin2) { exit("Error al insertar autores de taxon cita"); }
											}
										}
									}// FIN if (!is_numeric($valor_c))
								}
								
							} // FIN foreach ($idautaxon as $fila => $valor_c)
							
							
							
							$diff_datosTaxocita = array_diff($array_taxon_cita , $array_origenTaxon_cita);
							if (count ($diff_datosTaxocita) <> 0)
							{
								foreach ($diff_datosTaxocita as $fila => $valor)
								{
									$delete_originTc 	=  pg_query($db, "DELETE FROM autores_taxon WHERE idau_taxon = '".$valor."'");
									if (!$delete_originTc) { exit("Error al eliminar autores de taxonomia"); }
									
									$delete_Tcita 		=  pg_query($db, "DELETE FROM taxon_cita 	WHERE idau_taxon = '".$valor."'");
									if (!$delete_Tcita) { exit("Error al eliminar citas de taxonomia"); }
								}
							}
							
						} // FIN  if (is_numeric($valor))
						
						if (!is_numeric($valor))
						{
							
							$sqlupd_d8taxon  = "INSERT INTO taxonomia (id_taxon, dataset_id, cobertura, reino, division, clase, orden, familia, genero, especie, nombre_comun) VALUES ( ";
							$sqlupd_d8taxon .= " ".$val_maxIdTaxon.	 " , ";
							$sqlupd_d8taxon .= " ".$record_id.		 " , ";
							$sqlupd_d8taxon .= " '".$taxon[$fila].	 "', "; 
							$sqlupd_d8taxon .= " '".$reino[$fila].	 "', "; 
							$sqlupd_d8taxon .= " '".$division[$fila]."', "; 
							$sqlupd_d8taxon .= " '".$clase[$fila].	 "', "; 
							$sqlupd_d8taxon .= " '".$orden[$fila].	 "', "; 
							$sqlupd_d8taxon .= " '".$familia[$fila]. "', "; 
							$sqlupd_d8taxon .= " '".$genero[$fila].	 "', "; 
							$sqlupd_d8taxon .= " '".$especie[$fila]. "', "; 
							$sqlupd_d8taxon .= " '".$nomcom[$fila].	 "'  "; 	
							$sqlupd_d8taxon .= " ) ";
							$sql_dtaxon =  pg_query($db, $sqlupd_d8taxon);
							if (!$sql_dtaxon) { exit("Error al insertar nueva informacion taxon&oacute;mica en el div 7"); }
							
							$campo_n =  "g_title".$valor; 
							$campo_p =  "g_publish".$valor;
							$campo_s =  "g_siglas".$valor;
							$campo_c =  "g_pubplace".$valor;
							$campo_e =  "g_edition".$valor;
							$campo_d =  "g_pubdate".$valor;
							$campo_r =  "g_sername".$valor;
							$campo_i =  "g_issue".$valor;
							$campo_id = "g_idtaxon".$valor;
							$campo_ia = "g_idautaxon".$valor;
							
							$nombrec 	= $_POST[$campo_n]; 
							$publish 	= $_POST[$campo_p]; 
							$siglas 	= $_POST[$campo_s]; 
							$pubplace 	= $_POST[$campo_c]; 
							$edition 	= $_POST[$campo_e]; 
							$pubdate 	= $_POST[$campo_d]; 
							$sername 	= $_POST[$campo_r]; 
							$issue 		= $_POST[$campo_i]; 
							$idtaxon 	= $_POST[$campo_id]; 
							$idautaxon 	= $_POST[$campo_ia]; 
							 
							 
							$sql_buscaMaxTcita = pg_query($db, "SELECT idau_taxon FROM taxon_cita  ORDER BY idau_taxon DESC LIMIT 1");
							if (!$sql_buscaMaxTcita) { exit("Error al Buscar el valor maximo del div 8 a la base de citas toxon&oacute;micas"); }
								
							$val_maxIdTcita = 0;
							
							if (pg_num_rows ($sql_buscaMaxTcita) <> "")
							{
								while ($fila = pg_fetch_array($sql_buscaMaxTcita)) 
								{
									$val_maxIdTcita = $fila [0]; 
									$val_maxIdTcita = $val_maxIdTcita + 1;
								}
							}
							
							else {$val_maxIdTcita = $val_maxIdTcita + 1;}
							
							//echo "val_maxIdTcit: $val_maxIdTcita";
							
							foreach ($idautaxon as $fila => $valor_c)
							{
								if ($nombrec [$fila] <> "")
								{
									$sqlupd_d8tci  = "INSERT INTO taxon_cita (idau_taxon, id_taxon, title, publish, publish_siglas, pubplace, edition, pubdate, sername, issue) VALUES ( ";
									$sqlupd_d8tci .= " ".$val_maxIdTcita.	" , ";
									$sqlupd_d8tci .= " ".$val_maxIdTaxon.		" , ";
									
									if  ( $nombrec[$fila] <> ""){	$sqlupd_d8tci .= " '".$nombrec[$fila].	"',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
										
									if  ( $publish[$fila] <> ""){	$sqlupd_d8tci .= " '".$publish[$fila].	"',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
										
									if  ( $siglas[$fila] <> "")	{	$sqlupd_d8tci .= " '".$siglas[$fila].	"',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
									
									if  ( $pubplace[$fila] <> ""){	$sqlupd_d8tci .= " '".$pubplace[$fila]."',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
										
									if  ( $edition[$fila] <> ""){	$sqlupd_d8tci .= " '".$edition[$fila].	"',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
										
									if  ( $pubdate[$fila] <> ""){	$sqlupd_d8tci .= " '".$pubdate[$fila].	"',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
										
									if  ( $sername[$fila] <> ""){	$sqlupd_d8tci .= " '".$sername[$fila].	"',  "; }
									else 						{	$sqlupd_d8tci .= " null,	";	}
										
									if  ( $issue[$fila] <> "")	{	$sqlupd_d8tci .= " '".$issue[$fila].	"'  "; 	}
									else 						{	$sqlupd_d8tci .= "null";						}
									
									$sqlupd_d8tci .= " ) ";
									$sql_dtci =  pg_query($db, $sqlupd_d8tci);
									if (!$sql_dtci) { exit("Error al insertar la informacion de citas taxon&oacute;micas en el div 7"); }
									
									$z_origin2 = "z_origin".$valor."_".$valor_c;
									$autores_tc = $_POST[$z_origin2]; 
		
									foreach ($autores_tc as $key => $value) 
									{
										if ($value <> "" ) 
										{
											
											$sql_zorigin2 =  "INSERT INTO autores_taxon (idau_taxon, origin) VALUES ('" .$val_maxIdTcita. "','" .$value."')";
											$res_zorigin2 =  pg_query($db, $sql_zorigin2);
											if (!$res_zorigin2) { exit("Error al insertar autores de taxon cita"); }
										}
									}
								}
							} // FIN foreach ($idautaxon as $fila => $valor_c)													
						} // FIN if (!is_numeric($valor))
						
						
						
					} // FIN if ($taxon [$fila] <> "")
				} // fin foreach ($idtax as $fila => $valor)
				
				$diff_datosTaxonomia = array_diff($array_taxonomia , $array_origenTaxonomia);
				
				if (count ($diff_datosTaxonomia) <> 0)
				{
					foreach ($diff_datosTaxonomia as $fila => $valor)
					{
						$sql_DatosTcita = pg_query($db, "SELECT idau_taxon FROM taxon_cita  WHERE id_taxon = '".$valor."' ORDER BY idau_taxon ASC");
						if (!$sql_DatosTcita) { exit("Error al Buscar valores a la base de datos de Taxon_cita"); }
						
						while ($fila = pg_fetch_array($sql_DatosTcita, null, PGSQL_ASSOC))	
						{	
							$delete_originTc 	=  pg_query($db, "DELETE FROM autores_taxon WHERE idau_taxon = '".$fila ["idau_taxon"]."'");
							if (!$delete_originTc) { exit("Error al eliminar autores de taxonomia"); }
							
							$delete_Tcita 		=  pg_query($db, "DELETE FROM taxon_cita 	WHERE idau_taxon = '".$fila ["idau_taxon"]."'");
							if (!$delete_Tcita) { exit("Error al eliminar citas de taxonomia"); }
						}
						
						
						$delete_datosTc = pg_query ($db ,"DELETE FROM taxonomia WHERE id_taxon = '".$valor."'");
						if (!$delete_datosTc) { exit("Error al eliminar datos de taxonomia"); }
					}
				}

			} break;
			
			case "estructuraRaster":
			{
					  //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 8 >>>>>>>>>>>>>
				$sqlupd8r = "UPDATE coberturas SET ";  
				$sqlupd8r .= "estructura_dato 	= '".$_POST['c_estructura_dato']	."',";
				$sqlupd8r .= "tipo_dato 		= '".$_POST['c_tipo_dato'] 			."',";
				$sqlupd8r .= "total_datos 		= '".$_POST['c_total_datos'] 		."' ";
				$sqlupd8r .= " WHERE record_id = '" .$record_id 					."'";
				
				$sql_div8r =  pg_query($db, $sqlupd8r);
				if (!$sql_div8r) { exit("Error al actualizar la información de informaci&oacute;n espacial del div 8"); }
		
				
				  /// SI LA ESTRUCTURA ES RASTER
				if ($_POST['c_estructura_dato'] == "Raster") 
				{
					$delete_raster = pg_query ($db ,"DELETE FROM raster WHERE record_id = '".$record_id."'");
					if (!$delete_raster) { exit("Error al eliminar datos raster del div 8"); } 
		
					$sqlupd_d8rast  = "INSERT INTO raster (record_id, nun_renglones, num_columnas, coor_x , coor_y, pixel_x, pixel_y) VALUES ( ";
					$sqlupd_d8rast .= " '".$record_id.					"', ";
					$sqlupd_d8rast .= " '".$_POST['r_nun_renglones'].	"', ";
					$sqlupd_d8rast .= " '".$_POST['r_num_columnas'].	"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_COOR_X'].			"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_COOR_Y'].			"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_pixel_X'].			"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_pixel_Y'].			"'  "; 	
					$sqlupd_d8rast .= " ) ";
					$sql_raster =  pg_query($db, $sqlupd_d8rast);
					if (!$sql_raster) { exit("Error al insertar la informacion raster en el div 8"); }
				}
			} break;
			
			case "proyeccion":
			{
			  	//<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 9 >>>>>>>>>>>>>
				$sqlupd9 = "UPDATE coberturas SET ";  
				$sqlupd9 .= "id_proyeccion 	= '".$_POST['c_id_proyeccion']	."',";
				$sqlupd9 .= "datum 			= '".$_POST['c_datum'] 			."',";
				$sqlupd9 .= "elipsoide 		= '".$_POST['c_elipsoide'] 		."' ";
				$sqlupd9 .= " WHERE record_id = '" .$record_id 				."'";
				
				$sql_div9 =  pg_query($db, $sqlupd9);
				if (!$sql_div9) { exit("Error al actualizar la información de Proyecci&oacute;n cartogr&aacute;fica del div 9"); }
				
				$sqlupd2 = "UPDATE coberturas SET ";  
				$sqlupd2 .= "area_geo 	= '".$_POST['c_area_geo'] 	."', ";
				$sqlupd2 .= "oeste 		= '".$_POST['c_oeste'] 		."', ";
				$sqlupd2 .= "este 		= '".$_POST['c_este'] 		."', ";
				$sqlupd2 .= "norte 		= '".$_POST['c_norte'] 		."', ";
				$sqlupd2 .= "sur 		= '".$_POST['c_sur'] 		."' ";
				$sqlupd2 .= " WHERE record_id = '" .$record_id 		."'";
				
				$sql_div2 =  pg_query($db, $sqlupd2);
				if (!$sql_div2) { exit("Error al actualizar la información del div 2"); }
				
				 //<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 8 >>>>>>>>>>>>>
				$sqlupd8r = "UPDATE coberturas SET ";  
				$sqlupd8r .= "estructura_dato 	= '".$_POST['c_estructura_dato']	."',";
				$sqlupd8r .= "tipo_dato 		= '".$_POST['c_tipo_dato'] 			."',";
				$sqlupd8r .= "total_datos 		= '".$_POST['c_total_datos'] 		."' ";
				$sqlupd8r .= " WHERE record_id = '" .$record_id 					."'";
				
				$sql_div8r =  pg_query($db, $sqlupd8r);
				if (!$sql_div8r) { exit("Error al actualizar la información de informaci&oacute;n espacial del div 8"); }
		
				
				  /// SI LA ESTRUCTURA ES RASTER
				if ($_POST['c_estructura_dato'] == "Raster") 
				{
					$delete_raster = pg_query ($db ,"DELETE FROM raster WHERE record_id = '".$record_id."'");
					if (!$delete_raster) { exit("Error al eliminar datos raster del div 8"); } 
		
					$sqlupd_d8rast  = "INSERT INTO raster (record_id, nun_renglones, num_columnas, coor_x , coor_y, pixel_x, pixel_y) VALUES ( ";
					$sqlupd_d8rast .= " '".$record_id.					"', ";
					$sqlupd_d8rast .= " '".$_POST['r_nun_renglones'].	"', ";
					$sqlupd_d8rast .= " '".$_POST['r_num_columnas'].	"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_COOR_X'].			"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_COOR_Y'].			"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_pixel_X'].			"', "; 
					$sqlupd_d8rast .= " '".$_POST['r_pixel_Y'].			"'  "; 	
					$sqlupd_d8rast .= " ) ";
					$sql_raster =  pg_query($db, $sqlupd_d8rast);
					if (!$sql_raster) { exit("Error al insertar la informacion raster en el div 8"); }
				}
				
			} break;
			
			case "atributos":
			{
				//<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 10 >>>>>>>>>>>>>
					$sqlupd10 = "UPDATE coberturas SET ";  
					$sqlupd10 .= "tabla 			= '".$_POST['c_tabla']			."',";
					$sqlupd10 .= "descrip_tabla 	= '".$_POST['c_descrip_tabla'] 	."' ";
					$sqlupd10 .= " WHERE record_id = '" .$record_id 				."'";
					
					$sql_div10 =  pg_query($db, $sqlupd10);
					if (!$sql_div10) { exit("Error al actualizar la información de del div 10"); }
					
					
					
					$nombrea = $_POST['a_nombre'];
					$descrpa = $_POST['a_descipcion_atributo'];
					$fuentea = $_POST['a_fuente'];
					$unidaa = $_POST['a_unidades'];
					$tipoa = $_POST['a_tipo'];
					
					$delete_atributos = pg_query ($db ,"DELETE FROM atributos WHERE dataset_id = '".$record_id."'");
					if (!$delete_atributos) { exit("Error al eliminar atributos del div 10"); } 
					
					foreach ($nombrea as $fila => $value) 
					{
						if ($value <> "" ) 
						{
							
							$sqlupd_d10  = "INSERT INTO atributos (dataset_id, nombre, descipcion_atributo, fuente, unidades, tipo) VALUES ( ";
							$sqlupd_d10 .= " ".$record_id.	" , ";
												
							if  ( $nombrea[$fila] <> ""){	$sqlupd_d10 .= " '".$nombrea[$fila]."',  "; }
							else 						{	$sqlupd_d10 .= " null,	";	}
												
							if  ( $descrpa[$fila] <> ""){	$sqlupd_d10 .= " '".$descrpa[$fila]."',  "; }
							else 						{	$sqlupd_d10 .= " null,	";	}
													
							if  ( $fuentea[$fila] <> ""){	$sqlupd_d10 .= " '".$fuentea[$fila]."',  "; }
							else 						{	$sqlupd_d10 .= " null,	";	}
													
							if  ( $unidaa[$fila] <> "")	{	$sqlupd_d10 .= " '".$unidaa[$fila]."',  "; }
							else 						{	$sqlupd_d10 .= " null,	";	}
												
							if  ( $tipoa[$fila] <> "")	{	$sqlupd_d10 .= " '".$tipoa[$fila].	"'  "; 	}
							else 						{	$sqlupd_d10 .= "null";		}
												
							$sqlupd_d10 .= " ) ";
							$sql_div10 =  pg_query($db, $sqlupd_d10);
							if (!$sql_div10) { exit("Error al insertar la informacion  de atributos en el div 10"); }
						}
					}
			} break;
			
			case "arbol":
			{
				//<<<<<<<<<<<<<< ACTUALIZA LOS DATOS DEL DIV 11 >>>>>>>>>>>>>
				if ($cv_principal == 28)
				{
					$sqlupd11 = "UPDATE coberturas SET ";  
					$sqlupd11 .= "clasificacion 	= '".$_POST['c_clasificacion']	."'";
					$sqlupd11 .= " WHERE record_id 	= '" .$record_id 				."'";
					
					$sql_div11 =  pg_query($db, $sqlupd11);
					if (!$sql_div11) { exit("Error al actualizar la información de del div 11"); }
				}			
			} break;
			
			default:
		}
		

			if ($sqlupd_c != "" ) {
				$mensajesAll = "Se ha registrado un colaborador.";} 
			else{	$mensajesAll = "El Metadato a sido actualizado.";}

		if ( $mensajesAll != "" ) 
		{
			echo "<form id=\"frm_guardar\" name=\"frm_guardar\" method=\"post\" action=\"Menu.php?id=$record_id\">";
				echo "<input type=\"hidden\" name=\"actualiza\" value=\"1\" />";
				echo "<input type=\"hidden\" name=\"msgs_actualiza\" value=\"$mensajesAll\" />";
			echo "</form>";
			echo "<script type=\"text/javascript\">";
				echo "document.frm_guardar.submit();";
			echo "</script>";
		}
	}// fin if DB	
} // fin else
?>
