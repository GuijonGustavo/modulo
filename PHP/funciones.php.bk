<?php  
require_once("java/Java.inc"); 
require_once('sentencias.php');
ini_set("display_errors", "on");
if (empty($_GET["id"])) { $id=0;} 
else { $id = $_GET["id"];}

// ---------------------<<<<<< FUNCIÓN SELECCIÓN PARA RECUPERAR LOS CAMPOS DE NOMBRE Y ID DE LA TABLA DE COBERTURAS >>>>>>>-------------------------
function seleccion($id, $cv_principal )
{
 	global $id;
 	$db = conectar();
  	if ($db)
   	{
		if ($cv_principal == 28)
		{
			$consulta = sql("seleccion",0, $cv_principal , 0);
			$result = pg_query($db, $consulta [0]);
		}
		if ($cv_principal <> 28)
		{
			$consulta = sql("seleccion",0, $cv_principal , 0);
			$result = pg_query($db, $consulta [1]);
		}
		
		
		if (!$result) { exit("Error en la consulta"); } 
		else 
		{   
//			echo "<select name= \"seleccion\" style=\"width:250px\" id= \"seleccion\" onchange=\"location.href='../metadatos_c/Menu.php?id=' + this.value\">";
			echo "<select name= \"seleccion\" style=\"width:250px\" id= \"seleccion\" onchange=\"location.href='../modulo_cbm/Menu.php?id=' + this.value\">";
			echo "<option value=\"0\">Seleccione el Metadato</option>";
			while ($fila = pg_fetch_object($result))
			{ 
				if ($fila->record_id == $id) { echo  "<option selected value=$fila->record_id>$fila->nombre</option>"; } 
				else { echo  "<option value=$fila->record_id>$fila->nombre</option>";}
			}
			echo  "</select>";
		}	
	}
	pg_close($db);
  }
 
 
 // ---------------------<<<<<< FUNCIÓN GENERA LOS SELECTS >>>>>>>-------------------------	 

function selects($campo,$tamano,$id , $cv_principal)
{
	global $id;
	$cat = catalogos();
	$db = conectar();
	if($id)
	{
		if ($cv_principal == 28)
		{
			$sql_claves = sql("claves",$id,$cv_principal,0);
			$res_claves	= pg_query($db, $sql_claves [1]);
		}
		if ($cv_principal <> 28)
		{
			$sql_claves = sql("claves",$id,$cv_principal,0);
			$res_claves	= pg_query($db, $sql_claves [0]);
		}
			
		if (!$res_claves) { exit("Error en la consulta"); }		
		
		while ($fila = pg_fetch_array($res_claves))	
		{	
			$cve_estado = $fila [0];
			$cve_munici = $fila [1];
			$cve_locali = $fila [2];
			$pubplace = $fila [3];						
			$cve_pais = $fila [4];
		}
		
		if($campo == "pais")
		{
			
			echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambio$campo(this.value)\">";
			echo "<option value=\"\">Seleccione un $campo</option>";
			
			$sql_select = sql($campo , $id , $cv_principal , 0);
			$res_select = pg_query($cat, $sql_select [1]);
			
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				if ($clave == $cve_pais) {echo  "<option selected  value=\"$clave\">$nombre</option>";}
				else { echo  "<option value=\"$clave\"> $nombre</option>";}
			} 
			echo  "</select>";
		}
	
	
		if($campo == "estado")
		{
			if ($cve_pais <> 3 && $cve_pais <> "")
			{
					
			echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambio$campo(this.value)\" disabled = \disabled\">";
			echo "<option value=\"\">Seleccione un $campo</option>";
			
			$sql_select = sql($campo , $id , $cv_principal , 0);
			$res_select = pg_query($cat, $sql_select [1]);
			
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				if ($clave == $cve_estado) {echo  "<option selected  value=\"$clave\">$nombre</option>";}
				else { echo  "<option value=\"$clave\"> $nombre</option>";}
			} 
			echo  "</select>";
			
            }
		
			
			else
			{
				echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambioestado(this.value)\" disabled = \"disabled\">";
				echo "<option value=\"\">Seleccione un $campo</option>";
				echo  "</select>";
			}
			
		}

		if($campo == "municipio")
		{
			if ($cve_estado <> 33 && $cve_estado <> "")
			{
				
				
				echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambiomunicipio(this.value)\" disabled = \"disabled\">";
				echo "<option value=\"\">Seleccione un $campo</option>";
				
				$sql_campo = sql($campo,$id,$cv_principal,$cve_estado);
				$res_campo	= pg_query($cat, $sql_campo [1]);
				if (!$res_campo) { exit("Error en la consulta"); }
				
				
				while ($fila = pg_fetch_array($res_campo))
				{
					$clave	= $fila [0];
					$nombre = $fila [1];
					
					if ($clave == $cve_munici) {echo  "<option selected  value=\"$clave\">$nombre</option>";}
					else { echo  "<option value=\"$clave\">$nombre</option>";}
				} 
				echo  "</select>";
			}
			
			else
			{
				echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambiomunicipio(this.value)\" disabled = \"disabled\">";
				echo "<option value=\"\">Seleccione un $campo</option>";
				echo  "</select>";
			}
			
		}
		
		if($campo == "localidad")
		{
			if($cve_munici)
			{
				$sql_campo = sql($campo,$id,$cv_principal,$cve_munici);
				$res_campo	= pg_query($cat, $sql_campo [1]);
				if (!$res_campo) { exit("Error en la consulta"); }
				if (pg_num_rows ($res_campo))
				{
					echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\"  disabled = \"disabled\">";
					echo "<option value=\"\">Seleccione un $campo</option>";
					while ($fila = pg_fetch_array($res_campo))
					{
						$clave	= $fila [0];
						$nombre = $fila [1];
						
						if ($clave == $cve_locali) {echo  "<option selected  value=\"$clave\">$nombre</option>";}
						else { echo  "<option value=\"$clave\">$nombre</option>";}
					}
					echo  "</select>";
				}
				
				if (pg_num_rows ($res_campo) == 0)
				{
					echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\"  >";
					echo  "<option value=\"\" selected >Sin Localidad</option>";
					echo  "</select>";
				}
			}
			else
			{
				echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\"  disabled = \"disabled\">";
				echo "<option value=\"\">Seleccione una $campo</option>";
				echo  "</select>";
			}
			
		}
		
		
	}
	else
	{
		if ($cv_principal == 28)
		{
			$sql_claves = sql("claves",$id,$cv_principal,0);
			$res_claves	= pg_query($db, $sql_claves [1]);
		}
		if ($cv_principal <> 28)
		{
			$sql_claves = sql("claves",$id,$cv_principal,0);
			$res_claves	= pg_query($db, $sql_claves [0]);
		}
			
		if (!$res_claves) { exit("Error en la consulta"); }		



	
		if($campo == "pais")
		{
			
			echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambio$campo(this.value)\">";
			echo "<option value=\"\">Seleccione un $campo</option>";
			
			$sql_select = sql($campo , $id , $cv_principal , 0);
			$res_select = pg_query($cat, $sql_select [1]);
			
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				if ($clave == $cve_pais) {echo  "<option selected  value=\"$clave\">$nombre</option>";}
				else { echo  "<option value=\"$clave\"> $nombre</option>";}
			} 
			echo  "</select>";
		}
		
	
		if($campo == "estado")
		{
			
			echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambio$campo(this.value)\">";
			echo "<option value=\"\">Seleccione un $campo</option>";
			
			$sql_select = sql($campo , $id , $cv_principal , 0);
			$res_select = pg_query($cat, $sql_select [1]);
			
			while ($fila = pg_fetch_array($res_select))
			{
				$clave	= $fila [0];
				$nombre = $fila [1];
				if ($clave == $cve_estado) {echo  "<option selected  value=\"$clave\">$nombre</option>";}
				else { echo  "<option value=\"$clave\"> $nombre</option>";}
			} 
			echo  "</select>";
		}
		if($campo == "municipio")
		{
			echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\" onChange=\"cambiomunicipio(this.value)\" disabled = \"disabled\">";
			echo "<option value=\"\">Seleccione un $campo</option>";
			echo  "</select>";
		}
		
		if($campo == "localidad")
		{
			echo "<select name= \"$campo\" id= \"$campo\" style=\"width:$tamano\"  disabled = \"disabled\">";
			echo "<option value=\"\">Seleccione una $campo</option>";
			echo  "</select>";
		}
	}
}

 	
// ---------------------<<<<<< FUNCIÓN GENERAR COLABORADORES >>>>>>>-------------------------
//function generaColaborador($id, $name, $class)
//{

//							echo  "<input type=\"text\" name=\"$name\"  id=\"$id\" class = \"$class\" onKeyPress=\"javascript:return validarCampos(event)\"/>";


//}



	
	
// ---------------------<<<<<< FUNCIÓN GENERA PARA RECUPERAR LOS CAMPOS DE LA TABLA DE COBERTURAS >>>>>>>-------------------------
function genera($campo, $class, $id , $cv_principal, $tipo , $toolTip)
{
	global $id;
	$cat = catalogos();
	$db = conectar();
	if($db)
	{
		if ($id)
		{
			if ($cv_principal == 28)
			{
				$sql_genera = sql($campo,$id , $cv_principal , 0);
				$res_genera = pg_query($db, $sql_genera [0]);
			}
			if ($cv_principal <> 28)
			{
				$sql_genera = sql($campo,$id , $cv_principal , 0);
				$res_genera = pg_query($db, $sql_genera [2]);
			}
			
			if (!$res_genera) { exit("Error en la consulta"); } 
			
			
			if (pg_num_rows($res_genera) <> 0)
			{
			
				while ($fila = pg_fetch_array($res_genera, null, PGSQL_ASSOC)) { foreach ($fila as $valor_genera) { $val = $valor_genera;}}
				
				if($tipo == "txt")
				{	
					if($val <> "")	
					{	
						if( $toolTip != "")
						{
							echo  "<input type=\"text\" name=\"$campo\"  id=\"$campo\" value= \"$val\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";
							echo "<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
						}
						else
						{
							echo  "<input type=\"text\" name=\"$campo\"  id=\"$campo\" value= \"$val\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";
						}
					}
					else 			
					{ 
						if($toolTip != "")
						{
							echo  " <input type=\"text\" name=\"$campo\"  id=\"$campo\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";
							echo"<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
						}
						else
						{
							echo  " <input type=\"text\" name=\"$campo\"  id=\"$campo\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";	
						}						
											
					}
				}	 
				
				if($tipo == "calendario")
				{	
					if($val <> "")	
					{	
						if( $toolTip != "")
						{
							echo  " <input type=\"text\" name=\"$campo\" value= \"$val\" id=\"$campo\" class = \"$class\"/><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
						}
						else
						{
							echo  " <input type=\"text\" name=\"$campo\" value= \"$val\" id=\"$campo\" class = \"$class\"/>";	
						}
					}
					else
					{
						if ($toolTip != "")
						{
							echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\"/><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>"; 
						}	
						else
						{
							echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\"/>"; 
						}
					}		
					 			
				}
				
				if($tipo == "numeros")
				{
					if ($val <> "")
					{	
						if( $toolTip != "")
						{
							echo  "<input type=\"text\" name=\"$campo\" id=\"$campo\" value= \"$val\" class = \"$class\" onKeyPress=\"javascript:return validarNro(event)\"/>";
							echo "<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";
						}
						else
						{
							echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" value= \"$val\" class = \"$class\" onKeyPress=\"javascript:return validarNro(event)\"/>";
						}
					}
							
					else 
					{
						if($toolTip != "")
						{	
							 echo  " <input type=\"text\" name=\"$campo\"  id=\"$campo\" class = \"$class\" onKeyPress=\"javascript:return validarNro(event)\"/>";					
						}
						else
						{ 	
							echo  " <input type=\"text\" name=\"$campo\"  id=\"$campo\" class = \"$class\" onKeyPress=\"javascript:return validarNro(event)\"/>";					
						}
					}	
				}

				if($tipo == "txtarea")
				{	
					if($val <> "" )
					{	
						if( $toolTip != "")
						{
							echo  " <textarea name=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\">$val</textarea><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
						}
						else
						{
							echo  " <textarea name=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\">$val</textarea>";
						}
					}
					else
					{
						if ($toolTip != "")
						{ 	
							echo  " <textarea name=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\"></textarea><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
						}
						else
						{
							echo  " <textarea name=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\"></textarea>";
						}	
					} 			
				}
			}	
			else
			{
				if($tipo == "txt")			
				{		
					if($toolTip != "")	 
					{ 
						echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";
						echo  "<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
					}
					else 				 { echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";	}
				}
	
				if($tipo == "calendario")
				{
					if($toolTip != "")		{ echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\"/><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";   }
					else					{ echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\"/>";  }
				}
				
	
				if($tipo == "numeros")
				{
					if($toolTip != "")		{ 	echo "<input type=\"text\" name=\"$campo\"  id=\"$campo\" onKeyPress=\"javascript:return validarNro(event)\" class = \"$class\"/>";
												echo"<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";}
					else 					{ echo "<input type=\"text\" name=\"$campo\" id=\"$campo\" onKeyPress=\"javascript:return validarNro(event)\" class = \"$class\"/>";}
				}			
	
				if($tipo == "txtarea")		
				{
					if($toolTip != "")		
					{ 
						echo " <textarea name=\"$campo\" id=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\"></textarea><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>"; 
					}
					else{ echo " <textarea name=\"$campo\" id=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\"></textarea>";  }
				}	
			}			
		}
		else 
		{ 
			if($tipo == "txt")			
			{		
				if($toolTip != "")	 
				{ 
					echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";
					echo "<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";	
				}
				else 				 { echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\" list=\"$campo\" onKeyPress=\"javascript:return validarCampos(event)\"/>";	}
			}

			if($tipo == "calendario")
			{
				if($toolTip != "")		{ echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\"/><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";   }
				else					{ echo  " <input type=\"text\" name=\"$campo\" id=\"$campo\" class = \"$class\"/>";  }
			}
			

			if($tipo == "numeros")
			{
				if($toolTip != "")		{ 	echo "<input type=\"text\" name=\"$campo\"  id=\"$campo\" onKeyPress=\"javascript:return validarNro(event)\" class = \"$class\"/>";
											echo "<img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>";}
				else 					{ echo "<input type=\"text\" name=\"$campo\"  id=\"$campo\" onKeyPress=\"javascript:return validarNro(event)\" class = \"$class\"/>";}
			}			

			if($tipo == "txtarea")		
			{
				if($toolTip != "")		
				{ 
					echo " <textarea name=\"$campo\" id=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\"></textarea><img title =\"$toolTip\"src=\"CSS/images/icono-ayuda.png\"/>"; 
				}
				else{ echo " <textarea name=\"$campo\" id=\"$campo\" rows=\"3\" cols=\"98\" onKeyPress=\"javascript:return validarCampos(event)\"></textarea>";  }
			}	

				
		}
	}// FIN DB
	
	if ($campo <> "c_nombre" && $campo <> "c_cobertura" && $campo <> "c_publish" && $campo <> "c_publish_siglas" && $campo <> "c_pubplace")
	{	
		$datalist = sql($campo,$id , $cv_principal , 0);
		$resdata = pg_query($db, $datalist [1]);
		echo  "<datalist id=\"$campo\">"; while ($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $var) { echo  "<option value=\"$var\">";	}	}echo  "</datalist>";
	}
	
	if ($campo == "c_publish" ||  $campo == "c_publish_siglas" ||  $campo == "c_pubplace") 
	{	

		$datalist = sql($campo,$id , $cv_principal , 0);
		$resdata = pg_query($cat, $datalist [1]);
		echo  "<datalist id=\"$campo\">"; while ($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $var) { echo  "<option value=\"$var\">";	}	}echo  "</datalist>";
		
	}
 } 
 
 	
// ---------------------<<<<<< FUNCIÓN ETIQUETAS>>>>>>>-------------------------

function etiquetas($campo, $id , $cv_principal)
{
    
	global $id;

	$db = conectar();
	if($db)
	{

		if ($id)
		{     
			if ($cv_principal == 28)
			{
				$sql_genera = sql($campo,$id , $cv_principal , 0);
				$res_genera = pg_query($db, $sql_genera [0]);
			}
			if ($cv_principal <> 28)
			{
				$sql_genera = sql($campo,$id , $cv_principal , 0);
				$res_genera = pg_query($db, $sql_genera [2]);
			}
			
			if (!$res_genera) { exit("Error en la consulta"); } 
			
			
			if (pg_num_rows($res_genera) <> 0)
                {      

				while ($fila = pg_fetch_array($res_genera, null, PGSQL_ASSOC)) { foreach ($fila as $valor_genera) { $val = $valor_genera;}}
                
                    return $val;

			}	
		}
	}// FIN DB

 } 
 




// ---------------------<<<<<< FUNCIÓN TABLA  QUE IMPRIME LOS RESULTADOS DE AUTORES, LIGAS, TEMAS, Y SITIOS>>>>>>>------------------------- 
function tabla($campo,$tamano,$id , $cv_principal ,$tema )
{
   $campo_v = $campo."[]";
   echo  "<div id=$tema>";
   	if ($tema == 'Autores') {echo  "<table id=$tema width=\"280\" border=\"0\">";}
	if ($tema == 'Ligas_www' || $tema =='Temas' || $tema =='Sitios') {echo  "<table id=$tema width=\"700\" border=\"0\">";}
	else {echo  "<table id=$tema >";}
   		echo  "<thead>";
   			echo  "<tr>";
   				echo  "<th>  </th>";
   			echo  "</tr>";
   		echo  "</thead>";
   		echo  "<tbody>";
			global $id;
			$db = conectar();
			if ($db) 
			{
				if($id)	
				{
				
					if ($cv_principal == 28)
					{
						$sql_tabla = sql($campo,$id , $cv_principal , 0);
						$res_tabla = pg_query($db, $sql_tabla [0]);
					}
					if ($cv_principal <> 28)
					{
						$sql_tabla = sql($campo,$id , $cv_principal , 0);
						$res_tabla = pg_query($db, $sql_tabla [2]);
					}
			

					if (!$res_tabla) { exit("Error en la consulta"); } 
					else
					{
						while ($fila = pg_fetch_array($res_tabla, null, PGSQL_ASSOC)) 
						{ 
							foreach ($fila as $valor_tabla) 
							{ 						
								echo  "<tr>";
									echo  "<td><input type=\"text\" name=\"$campo_v\" value= \"$valor_tabla\" list=\"$campo\" size=\"$tamano\" class=\"clsAnchoTotal\"/></td>" ; 
									echo  "<td align=\"left\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
								echo  "</tr>";
							}
						}
						pg_free_result($res_tabla);
						echo  "<tr>";
							echo  "<td><input type=\"text\" name=\"$campo_v\" list=\"$campo\" size=\"$tamano\" class=\"clsAnchoTotal\"/></td>";
							echo  "<td align=\"left\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
						echo  "</tr>"; 				
					}
				}// FIN ID
				else
				{
					echo  "<tr>";
						echo  "<td><input type=\"text\" name=\"$campo_v\" list=\"$campo\" size=\"$tamano\" class=\"clsAnchoTotal\"/></td>";
						echo  "<td align=\"left\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
					echo  "</tr>";
				}

				$datalist = sql($campo,$id , $cv_principal , 0);
				$resdata = pg_query($db, $datalist [1]);
				echo  "<datalist id=\"$campo\">"; while ($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $var) { echo  "<option value=\"$var\">";	}	} echo  "</datalist>";
			} // FIN DB
		pg_close($db);	
	
	echo  "</tbody>";
		echo  "<tfoot>";
			echo  "<tr>";
				echo  "<td colspan=\"4\" align=\"right\">";
					echo  "<input type=\"button\" value=\"Agregar $tema\" class=\"clsAgregarFila\">";
				echo  "</td>";
			echo  "</tr>";
		echo  "</tfoot>";
	echo  "</table>";
  echo  "</div>";			
  }	
  
  
// ---------------------<<<<<< FUNCIÓN TABLA_D  QUE IMPRIME LOS RESULTADOS DE REFERENCIA DE LOS DATOS ORIGINALES >>>>>>>------------------------- 
function tabla_d($class,$id , $cv_principal ,$tema)
{
	 $nombre = "d_nombre"; 
	 $publish = "d_publish";
	 $siglas = "d_siglas";
	 $pubplace = "d_pubplace";
	 $edition = "d_edition";
	 $escala = "d_escala";
	 $pubdate = "d_pubdate";
	 $formato = "d_formato";
	 $geoform = "d_geoform";
	 $srccontr = "d_srccontr";
	 $issue = "d_issue";
	 $onlink = "d_onlink";
	 $idorigen = "d_idorigen";
	 
	 $campo_n = $nombre."[]";
	 $campo_p = $publish."[]";
	 $campo_s = $siglas."[]";
	 $campo_c = $pubplace."[]";
	 $campo_e = $edition."[]";
	 $campo_l = $escala."[]";
	 $campo_d = $pubdate."[]";
	 $campo_f = $formato."[]";
	 $campo_g = $geoform."[]";
	 $campo_r = $srccontr."[]";
	 $campo_i = $issue."[]";
	 $campo_o = $onlink."[]";
	 $campo_id = $idorigen."[]";
	 $tamano_id = "8px";

echo  "<div id=$tema>";
	echo  "<table id=$tema border=\"10\" width=\"2350\">";   
		echo  "<thead>";
			echo  "<tr>";
				echo  "<th width=\"252\">Titulo del Dato</th>";
				echo  "<th width=\"234\">Institución Responsable</th>";
				echo  "<th width=\"144\">Siglas de la Institución</th>";
				echo  "<th width=\"144\">Lugar de Publicación</th>";
				echo  "<th width=\"144\">Versión</th>";
				echo  "<th width=\"144\">Escala</th>";
				echo  "<th width=\"144\">Fecha de Publicación</th>";
				echo  "<th width=\"144\">Formato del Dato Geoespacial</th>";
				echo  "<th width=\"144\">Tipo de Dato Geoespacial</th>";
				echo  "<th width=\"326\">Informacion</th>";
				echo  "<th width=\"144\">Otros</th>";
				echo  "<th width=\"144\">Links</th>";
				echo  "<th></th>";
				echo  "<th width=\"144\">Autores</th>";
				echo  "<th></th>";
				echo  "</tr>";
			echo  "</thead>";
			echo  "<tbody >"; 
			global $id;
    		$db = conectar();
			if ($db) 
			{
				if ($id)
				{
				
					if ($cv_principal == 28)
					{
						$sql_tabla_d = sql($nombre,$id , $cv_principal , 0);
						$res_tabla_d = pg_query($db, $sql_tabla_d[0]);
					}
					if ($cv_principal <> 28)
					{
						$sql_tabla_d = sql($nombre,$id , $cv_principal , 0);
						$res_tabla_d = pg_query($db, $sql_tabla_d[13]);
					}
					
					
					if (!$res_tabla_d) { exit("Error en la consulta"); }
					
					if (pg_num_rows ($res_tabla_d))
					{
						//echo pg_num_rows ($res_tabla_d);
						
						
						
						while ($fila = pg_fetch_array($res_tabla_d, NULL, PGSQL_ASSOC))
						{
							 
							 $val_n 	= $fila ['nombre'];
							 $val_p 	= $fila ['publish'];
							 $val_s 	= $fila ['publish_siglas'];
							 $val_c 	= $fila ['pubplace'];
							 $val_e 	= $fila ['edition'];
							 $val_l 	= $fila ['escala_original'];
							 $val_d 	= $fila ['pubdate'];
							 $val_f 	= $fila ['formato_original'];
							 $val_g 	= $fila ['geoform'];
							 $val_r 	= $fila ['srccontr'];
							 $val_i 	= $fila ['issue'];
							 $val_o 	= $fila ['onlink'];
							 $val_id	= $fila ['id_origen'];
								 
							 echo  "<tr>";
								 echo  "<td><input type=\"text\" name=\"$campo_n\" value= \"$val_n\" list=\"$nombre\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_p\" value= \"$val_p\" list=\"$publish\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_s\" value= \"$val_s\" list=\"$siglas\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_c\" value= \"$val_c\" list=\"$pubplace\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_e\" value= \"$val_e\" list=\"$edition\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_l\" value= \"$val_l\" list=\"$escala\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_d\" value= \"$val_d\" list=\"$pubdate\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_f\" value= \"$val_f\" list=\"$formato\"  class=\"$class\"/></td>";					  
								 echo  "<td><input type=\"text\" name=\"$campo_g\" value= \"$val_g\" list=\"$geoform\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_r\" value= \"$val_r\" list=\"$srccontr\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_i\" value= \"$val_i\" list=\"$issue\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_o\" value= \"$val_o\" list=\"$onlink\"  class=\"$class\"/></td>";
								 echo  "<td><input type=\"hidden\" name=\"$campo_id\" value= \"$val_id\" list=\"$idorigen\"  class=\"clsAnchoTotal\"/></td>";
								 tabla_da($val_id , $cv_principal);	
									 
								echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
							echo  "</tr>"; 
						} // FIN WHILE

					} //FIN PG_NUM_ROWS
					
					$val_id = 0;
					echo  "<tr>";
						echo  "<td><input type=\"text\" name=\"$campo_n\" list=\"$nombre\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_p\" list=\"$publish\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_s\" list=\"$siglas\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_c\" list=\"$pubplace\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_e\" list=\"$edition\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_l\" list=\"$escala\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_d\" list=\"$pubdate\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_f\" list=\"$formato\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_g\" list=\"$geoform\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_r\" list=\"$srccontr\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_i\" list=\"$issue\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_o\" list=\"$onlink\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"hidden\" name=\"$campo_id\" value= \"$val_id\" list=\"$idorigen\"  class=\"$class\"/></td>";
						
						tabla_da($val_id , $cv_principal);				  
						echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
					echo  "</tr>";
					
				} // FIN ID
				else
				{
					$val_id = 0;
					echo  "<tr>";
						echo  "<td><input type=\"text\" name=\"$campo_n\" list=\"$nombre\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_p\" list=\"$publish\" class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_s\" list=\"$siglas\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_c\" list=\"$pubplace\" class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_e\" list=\"$edition\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_l\" list=\"$escala\"   class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_d\" list=\"$pubdate\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_f\" list=\"$formato\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_g\" list=\"$geoform\"  class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_r\" list=\"$srccontr\" class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_i\" list=\"$issue\" class=\"$class\"/></td>";
						echo  "<td><input type=\"text\" name=\"$campo_o\" list=\"$onlink\" s class=\"$class\"/></td>";
						echo  "<td><input type=\"hidden\" name=\"$campo_id\" value= \"$val_id\" list=\"$idorigen\"  class=\"$class\"/></td>";
						
						tabla_da($val_id , $cv_principal);				  
						echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
					echo  "</tr>";
				}	// fin else
			} // FIN DB
				   
			   		
		   	$datalist = sql($nombre,$id , $cv_principal , 0);
			$resdata = pg_query($db, $datalist [1]);
			echo  "<datalist id=\"$nombre\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_n) { echo  "<option value=\"$valor_n\">";	}	} echo  "</datalist>";
			
			$resdata = pg_query($db, $datalist [2]);
			echo  "<datalist id=\"$publish\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_p) { echo  "<option value=\"$valor_p\">";	}	} echo  "</datalist>";
			
			$resdata = pg_query($db, $datalist [3]);
			echo  "<datalist id=\"$siglas\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_s) { echo  "<option value=\"$valor_s\">";	}	} echo  "</datalist>";
			
			$resdata = pg_query($db, $datalist [4]);
			echo  "<datalist id=\"$pubplace\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_c) { echo  "<option value=\"$valor_c\">";	}	} echo  "</datalist>";
			
			$resdata = pg_query($db, $datalist [5]);
			echo  "<datalist id=\"$edition\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_e) { echo  "<option value=\"$valor_e\">";	}	} echo  "</datalist>";
			
			$resdata = pg_query($db, $datalist [6]);
			echo  "<datalist id=\"$escala\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_l) { echo  "<option value=\"$valor_l\">";	}	} echo  "</datalist>";
			
			$resdata = pg_query($db, $datalist [7]);
			echo  "<datalist id=\"$pubdate\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_d) { echo  "<option value=\"$valor_d\">";	}	} echo  "</datalist>";	
				
			$resdata = pg_query($db, $datalist [8]);
			echo  "<datalist id=\"$formato\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_f) { echo  "<option value=\"$valor_f\">";	}	} echo  "</datalist>";	
		
			$resdata = pg_query($db, $datalist [9]);
			echo  "<datalist id=\"$geoform\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_g) { echo  "<option value=\"$valor_g\">";	}	} echo  "</datalist>";	
			
			$resdata = pg_query($db, $datalist [10]);
			echo  "<datalist id=\"$srccontr\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_r) { echo  "<option value=\"$valor_r\">";	}	} echo  "</datalist>";	
			
			$resdata = pg_query($db, $datalist [11]);
			echo  "<datalist id=\"$issue\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_i) { echo  "<option value=\"$valor_i\">";	}	} echo  "</datalist>";	
			
			$resdata = pg_query($db, $datalist [12]);
			echo  "<datalist id=\"$onlink\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_o) { echo  "<option value=\"$valor_o\">";	}	} echo  "</datalist>";	
			
		pg_close($db);	   					  
			echo  "</tbody>";
			echo  "<tfoot>";
				echo  "<tr>";
					echo  "<td colspan=\"5\" align=\"right\">";
						echo  "<input type=\"button\" value=\"Agregar Datos\" class=\"clsAgregarFilad\">";
					echo  "</td>";
				echo  "</tr>";
			echo  "</tfoot>";
	echo  "</table>";
echo  "</div>";
 }
 
 
 // ---------------------<<<<<< FUNCIÓN TABLA_DA  QUE ES MANDADA A LLAMAR DE LA TABLA_D E IMPRIME LOS AUTORES DE LA REFERENCIA DE LOS DATOS ORIGINALES >>>>>>>------------------------- 
function tabla_da($val_ido , $cv_principal)
{
	$campo = "h_origin";
  	$tamano = "30px";
  	$teema = "Autores";
  	$campo_v = $campo."".$val_ido."[]";
    
  	echo  "<td>";
  		echo  "<div id=$teema>";
  			echo  "<table id=$teema>";
  				echo  "<thead>";
  					echo  "<tr>";
  						echo  "<th>  </th>";
  					echo  "</tr>";
  				echo  "</thead>";
  				echo  "<tbody>";
					global $id;
   					$db = conectar();
  					if ($db) 
					{
						$sql_tabla_da = sql($campo,$val_ido , $cv_principal , 0);
						$res_tabla_da = pg_query($db, $sql_tabla_da[0]);
						if (!$res_tabla_da) { exit("Error en la consulta"); } 
						else
						{
							if (pg_num_rows ($res_tabla_da))
							{
								while ($fila = pg_fetch_array($res_tabla_da, null, PGSQL_ASSOC)) 
								{ 
									foreach ($fila as $valor_tabla_da) 
									{ 
										echo  "<tr>";
											echo  "<td><input type=\"text\" name=\"$campo_v\" value= \"$valor_tabla_da\" list=\"$campo\" size=\"$tamano\" class=\"clsAnchoTotal\"/></td>" ;
											echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
										echo  "</tr>";
									}
								}
								echo  "<tr>";
									echo  "<td><input type=\"text\" name=\"$campo_v\" list=\"$campo\" size=\"$tamano\" class=\"clsAnchoTotal\"/></td>" ;
								  	echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
								echo  "</tr>";
							}// FIN PG_NUM_ROWS	
							else
							{
								echo  "<tr>";
									echo  "<td><input type=\"text\" name=\"$campo_v\" list=\"$campo\" size=\"$tamano\" class=\"clsAnchoTotal\"/></td>" ;
								  	echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
								echo  "</tr>";
							}
						}
						$datalist = sql($campo,$val_ido , $cv_principal , 0);
						$resdata = pg_query($db, $datalist [1]);
						echo  "<datalist id=\"$campo\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor) { echo  "<option value=\"$valor\">";	}	} echo  "</datalist>";	
					}// FIN  DB			
					pg_close($db);
	  			echo  "</tbody>";
 	  			echo  "<tfoot>";
	    			echo  "<tr>";
	     				echo  "<td colspan=\"1\" align=\"right\">";
  	       					echo  "<input type=\"button\" value=\"Agregar Autores\" class=\"clsAgregarFila\">";
   	     				echo  "</td>";
					echo  "</tr>";
	  			echo  "</tfoot>";
			echo  "</table>";
  		echo  "</div>";
	echo "</td>";
  }
 

////<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< FUNCION TABLA_T QUE GENERA LOS CAMPOS DE LA PRIMER TABLA DE TAXONOMIA >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

function tabla_t($extenso,$corto,$id , $cv_principal ,$tema)
{
	$taxon 		= "t_taxon"; 
 	$reino		= "t_reino";
 	$division 	= "t_division";
 	$clase 		= "t_clase";
 	$orden 		= "t_orden";
 	$familia 	= "t_familia";
 	$genero 	= "t_genero";
 	$especie 	= "t_especie";
 	$nomcom 	= "t_nombre_comun";
 	$idtax 		= "t_idtax";
 
 	$tcampo_t = $taxon."[]";
	$tcampo_r = $reino."[]";
	$tcampo_d = $division."[]";
	$tcampo_c = $clase."[]";
	$tcampo_o = $orden."[]";
	$tcampo_f = $familia."[]";
	$tcampo_g = $genero."[]";
	$tcampo_e = $especie."[]";
	$tcampo_n = $nomcom."[]";
	$tcampo_it = $idtax."[]";					
 	$tamano_id ="10px";
 
echo  "<div id=$tema>";
 echo  "<table width=\"2000\" id=$tema border=\"1\">";  
  echo  "<thead>";
   echo  "<tr>";
	 echo  "<th width=\"350\">Taxon</th>";
	 echo  "<th width=\"1561\">Cita</th>";		
   echo  "</tr>";
  echo  "</thead>";
  echo  "<tbody>";
  
 $db = conectar();
	if ($db)
	{
		if($id)
		{
		
		
			if ($cv_principal == 28)
			{
				$sql_tabla_t = sql("t_taxon",$id , $cv_principal , 0);
				$res_tabla_t = pg_query($db, $sql_tabla_t[0]);
			}
			if ($cv_principal <> 28)
			{
				$sql_tabla_t = sql("t_taxon",$id , $cv_principal , 0);
				$res_tabla_t = pg_query($db, $sql_tabla_t[10]);
			}
					

			if (!$res_tabla_t) { exit("Error en la consulta"); }
			else
			{
				while ($fila = pg_fetch_array($res_tabla_t, null, PGSQL_ASSOC))
				{
					$val_t 	= $fila ['cobertura'];
					$val_rt = $fila ['reino'];
					$val_d 	= $fila ['division'];
					$val_c 	= $fila ['clase'];
					$val_o 	= $fila ['orden'];
					$val_f 	= $fila ['familia'];
					$val_g 	= $fila ['genero'];
					$val_e 	= $fila ['especie'];
					$val_n	= $fila ['nombre_comun'];
					$val_it = $fila ['id_taxon'];
								
							
					echo  "<tr>";
					echo  "<td>"; 
					echo  "</tr>";
					echo  "</td>"; 
					echo  "<tr>";
					echo  "<td>";
					echo  "<table  width=\"350\">";
				echo  "<tr>";
				echo "<td width=\"140\" align=\"right\">Cobertura general:</td width=\"198\"> <td> 
																			<input type=\"text\" name=\"$tcampo_t\" class=\"$corto\"  list=\"$taxon\" 	 id= \"$taxon\"    value= \"$val_t\" onChange=\"generaReino(this.value)\"/></td> </tr>";
				echo  "<tr><td align=\"right\">Reino:</td><td>				<input type=\"text\" name=\"$tcampo_r\" class=\"$corto\"  list=\"$reino\"    id= \"$reino\"    value= \"$val_rt\" onChange=\"generaDivision(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">División o fila:</td><td>	<input type=\"text\" name=\"$tcampo_d\" class=\"$corto\"  list=\"$division\" id= \"$division\" value= \"$val_d\" onChange=\"generaClase(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">Clase:</td><td>				<input type=\"text\" name=\"$tcampo_c\" class=\"$corto\"  list=\"$clase\"  	 id= \"$clase\"    value= \"$val_c\" onChange=\"generaOrden(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">Orden:</td><td>				<input type=\"text\" name=\"$tcampo_o\" class=\"$corto\"  list=\"$orden\"  	 id= \"$orden\"    value= \"$val_o\" onChange=\"generaFamilia(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">Familia:</td><td>			<input type=\"text\" name=\"$tcampo_f\" class=\"$corto\"  list=\"$familia\"  id= \"$familia\"  value= \"$val_f\" onChange=\"generaGenero(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">Género:</td><td>				<input type=\"text\" name=\"$tcampo_g\" class=\"$corto\"  list=\"$genero\"   id= \"$genero\"   value= \"$val_g\" onChange=\"generaEspecie(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">Especie:</td><td>			<input type=\"text\" name=\"$tcampo_e\" class=\"$corto\"  list=\"$especie\"  id= \"$especie\"  value= \"$val_e\" onChange=\"generaNombre(this.value)\"/></td></tr>";
				echo  "<tr><td align=\"right\">Nombre común:</td><td>		<input type=\"text\" name=\"$tcampo_n\" class=\"$corto\"  list=\"$nomcom\"   id= \"$nomcom\"	value= \"$val_n\" /></td></tr>";
				echo  "<td><input type=\"hidden\" name=\"$tcampo_it\" value= \"$val_it\"  class=\"$corto\"/></td>"; // hidden
			echo  "</table>";
					echo  "</td>";
					echo  "<td>";  		
					tabla_tc($corto ,$val_it,"CITA TAXONOMICA",$cv_principal);	
					echo  "</td>";
					echo  "<td width=\"1\">";
					
					echo  "<td align=\"center\" width=\"32\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>"; 
					echo  "</td>";
					echo  "</tr>";
						
				} // fin while
			} // FIN ELSE
		} // FIN ID
	} // FIN DB	
	
	 $cat = catalogos();
	 $datalist = sql("t_taxon",$id , $cv_principal , 0);
	
		echo  "<tr>";
		echo  "<td>";
		echo  "<table  width=\"350\">";
			echo  "<tr>";
			echo "<td width=\"140\" align=\"right\">Cobertura general:</td width=\"198\"> <td> 
																		<input type=\"text\" name=\"$tcampo_t\" class=\"$corto\"  list=\"$taxon\" 	 id= \"$taxon\"    onChange=\"generaReino(this.value)\"/></td> </tr>";
			echo  "<tr><td align=\"right\">Reino:</td><td>				<input type=\"text\" name=\"$tcampo_r\" class=\"$corto\"  list=\"$reino\"    id= \"$reino\"    onChange=\"generaDivision(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">División o fila:</td><td>	<input type=\"text\" name=\"$tcampo_d\" class=\"$corto\"  list=\"$division\" id= \"$division\" onChange=\"generaClase(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">Clase:</td><td>				<input type=\"text\" name=\"$tcampo_c\" class=\"$corto\"  list=\"$clase\"  	 id= \"$clase\"    onChange=\"generaOrden(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">Orden:</td><td>				<input type=\"text\" name=\"$tcampo_o\" class=\"$corto\"  list=\"$orden\"  	 id= \"$orden\"    onChange=\"generaFamilia(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">Familia:</td><td>			<input type=\"text\" name=\"$tcampo_f\" class=\"$corto\"  list=\"$familia\"  id= \"$familia\"  onChange=\"generaGenero(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">Género:</td><td>				<input type=\"text\" name=\"$tcampo_g\" class=\"$corto\"  list=\"$genero\"   id= \"$genero\"   onChange=\"generaEspecie(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">Especie:</td><td>			<input type=\"text\" name=\"$tcampo_e\" class=\"$corto\"  list=\"$especie\"  id= \"$especie\"  onChange=\"generaNombre(this.value)\"/></td></tr>";
			echo  "<tr><td align=\"right\">Nombre común:</td><td>		<input type=\"text\" name=\"$tcampo_n\" class=\"$corto\"  list=\"$nomcom\"   id= \"$nomcom\"	/></td></tr>";
			echo  "<td><input type=\"hidden\" name=\"$tcampo_it\" value= \"t0\"  class=\"$corto\"/></td>"; // hidden
		echo  "</table>";
		echo  "</td>";
		echo  "<td>";
			tabla_tc($corto,"t0","Cita Taxon&oacute;mica",$cv_principal);
		echo  "</td>";
		echo  "<td width=\"1\">";
		
		echo  "<td align=\"center\" width=\"32\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
		echo  "</td>";
		echo  "</tr>"; 	
		
		
		
		$datalist = sql("t_taxon",$id , $cv_principal , 0);
		$resdata = pg_query($cat, $datalist [1]);
		echo  "<datalist id=\"$taxon\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_t) { echo  "<option value=\"$valor_t\">";	}	} echo  "</datalist>";
				
		echo "<p id=\"listReino\"></p>";
		echo "<p id=\"listDivision\"></p>";
		echo "<p id=\"listClase\"></p>";
		echo "<p id=\"listOrden\"></p>";
		echo "<p id=\"listFamilia\"></p>";
		echo "<p id=\"listGenero\"></p>";
		echo "<p id=\"listEspecie\"></p>";
		echo "<p id=\"listNombre\"></p>";
		
	pg_close($db);						  					  
  echo "</tbody>";
  echo  "<tfoot>";
   echo  "<tr>";
	echo  "<td colspan=\"1\" align=\"right\">";
	 echo  "<input type=\"button\" value=\"Agregar $tema\" class=\"clsAgregarFilat\">";
	echo  "</td>";
   echo  "</tr>"; 
  echo  "</tfoot>";
 echo  "</table>";
 
echo  "</div>";
 }



function datosTaxonomicos ($variable , $clasificacion)
{
	$cat = catalogos();
	$db = conectar();
}



////<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< FUNCION TABLA TC      QUE GENERA LOS CAMPOS DE LA SEGUNDA TABLA DE LA "TAXONOMIA_CITA" >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

function tabla_tc($corto,$validt,$tema ,$cv_principal)
{

	 $nombrec 	= "g_title".$validt; 
	 $publish 	= "g_publish".$validt;
	 $siglas 	= "g_siglas".$validt;
	 $pubplace 	= "g_pubplace".$validt;
	 $edition 	= "g_edition".$validt;
	 $pubdate 	= "g_pubdate".$validt;
	 $sername 	= "g_sername".$validt;
	 $issue 	= "g_issue".$validt;
	 $idtaxon 	= "g_idtaxon".$validt;
	 $idautaxon = "g_idautaxon".$validt;
	 
	 
	$campo_n = $nombrec."[]";
	$campo_p = $publish."[]";
	$campo_s = $siglas."[]";
	$campo_c = $pubplace."[]";
	$campo_e = $edition."[]";
	$campo_d = $pubdate."[]";
	$campo_r = $sername."[]";
	$campo_i = $issue."[]";
	$campo_id = $idtaxon."[]";
	$campo_ia = $idautaxon."[]";
	$tamano_id = "8px";
									
									
	 
	echo  "<div id=$tema>";
		echo  "<table id=$tema width=\"1550\">";
			echo  "<thead>";
				echo  "<tr>";
					echo  "<th width=\"244\">Título</th>";
					echo  "<th width=\"244\">Institución</th>";
					echo  "<th width=\"144\">Siglas</th>";
					echo  "<th width=\"144\">Lugar</th>";
					echo  "<th width=\"144\">Versión</th>";
					echo  "<th width=\"144\">Fecha</th>";
					echo  "<th width=\"144\">clave</th>";
					echo  "<th width=\"144\">Descripción</th>";
					echo  "<th>   </th>";
					echo  "<th>   </th>";
					echo  "<th>   </th>";
					echo  "<th width=\"69\">Autores</th>";
				echo  "</tr>";
			echo  "</thead>";
			echo  "<tbody>";
					$db = conectar();
			    	if ($db) 
					{
						if($validt <> "t0")
						{
							$sql_tabla_tc = sql("g_taxonc",$validt,$cv_principal , 0);
							$res_tabla_tc = pg_query($db, $sql_tabla_tc[0]);
							if (!$res_tabla_tc) { exit("Error en la consulta"); }
							else
							{
								while ($fila = pg_fetch_array($res_tabla_tc, null, PGSQL_ASSOC))
								{
									$val_n 	= $fila ['title'];
									$val_p 	= $fila ['publish'];
									$val_s 	= $fila ['publish_siglas'];
									$val_c 	= $fila ['pubplace'];
									$val_e 	= $fila ['edition'];
									$val_d 	= $fila ['pubdate'];
									$val_r 	= $fila ['sername'];
									$val_i 	= $fila ['issue'];
									$val_id = $fila ['id_taxon'];
									$val_ia = $fila ['idau_taxon'];
									
									//echo "<br> idau_taxon: ".$val_ia;

									
																		
									echo  "<tr>";
										echo  "<td><input type=\"text\" name=\"$campo_n\" value= \"$val_n\" list=\"$nombrec\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_p\" value= \"$val_p\" list=\"$publish\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_s\" value= \"$val_s\" list=\"$siglas\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_c\" value= \"$val_c\" list=\"$pubplace\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_e\" value= \"$val_e\" list=\"$edition\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_d\" value= \"$val_d\" list=\"$pubdate\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_r\" value= \"$val_r\" list=\"$sername\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"text\" name=\"$campo_i\" value= \"$val_i\" list=\"$issue\"  class=\"$corto\"/></td>";
										echo  "<td><input type=\"hidden\" name=\"$campo_id\" value= \"$val_id\" list=\"$idtaxon\"  class=\"$corto\"/></td>";  //hidden
										echo  "<td><input type=\"hidden\" name=\"$campo_ia\" value= \"$val_ia\" list=\"$idautaxon\"  class=\"$corto\"/></td>"; //hidden
										echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
										tabla_ta($corto ,$val_ia,$validt,$cv_principal);
									echo  "</tr>";
								}// fin del ciclo while
							} // fin pg_num_rows
						}
					}
					echo  "<tr>";
								 echo  "<td><input type=\"text\" name=\"$campo_n\" list=\"$nombrec\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_p\" list=\"$publish\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_s\" list=\"$siglas\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_c\" list=\"$pubplace\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_e\" list=\"$edition\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_d\" list=\"$pubdate\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_r\" list=\"$sername\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"text\" name=\"$campo_i\" list=\"$issue\"  class=\"$corto\"/></td>";
								 echo  "<td><input type=\"hidden\" name=\"$campo_id\" value= \"t0\" list=\"$idtaxon\"  class=\"$corto\"/></td>";  //hidden
								 echo  "<td><input type=\"hidden\" name=\"$campo_ia\" value= \"a0\" list=\"$idautaxon\"  class=\"$corto\"/></td><br>"; //hidden
								 echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
								 tabla_ta($corto ,"a0",$validt,$cv_principal);
					echo  "</tr>";
					
		$datalist = sql("g_taxonc",$validt,$cv_principal , 0);
		$resdata = pg_query($db, $datalist [1]);
		echo  "<datalist id=\"$nombrec\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_n) { echo  "<option value=\"$valor_n\">";	}	} echo  "</datalist>";
				
		$resdata = pg_query($db, $datalist [2]);
		echo  "<datalist id=\"$publish\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_p) { echo  "<option value=\"$valor_p\">";	}	} echo  "</datalist>";
				
		$resdata = pg_query($db, $datalist [3]);
		echo  "<datalist id=\"$siglas\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_s) { echo  "<option value=\"$valor_s\">";	}	} echo  "</datalist>";
				
		$resdata = pg_query($db, $datalist [4]);
		echo  "<datalist id=\"$pubplace\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_c) { echo  "<option value=\"$valor_c\">";	}	} echo  "</datalist>";
				
		$resdata = pg_query($db, $datalist [5]);
		echo  "<datalist id=\"$edition\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_e) { echo  "<option value=\"$valor_e\">";	}	} echo  "</datalist>";
				
		$resdata = pg_query($db, $datalist [6]);
		echo  "<datalist id=\"$pubdate\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_d) { echo  "<option value=\"$valor_d\">";	}	} echo  "</datalist>";
				
		$resdata = pg_query($db, $datalist [7]);
		echo  "<datalist id=\"$sername\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_r) { echo  "<option value=\"$valor_r\">";	}	} echo  "</datalist>";	
				
		$resdata = pg_query($db, $datalist [8]);
		echo  "<datalist id=\"$issue\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_i) { echo  "<option value=\"$valor_i\">";	}	} echo  "</datalist>";	
					pg_close($db);  	
					
						
			echo  "</tbody>";
			echo  "<tfoot>";
				echo  "<tr>";
					echo  "<td colspan=\"9\" align=\"right\">";
						echo  "<input type=\"button\" value=\"Agregar $tema\" class=\"clsAgregarFilatc\">";
					echo  "</td>";
				echo  "</tr>";
			echo  "</tfoot>";
		echo  "</table>";
	echo  "</div>";
 }


////<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< FUNCION TABLA TA      QUE GENERA LOS CAMPOS DE LA TERCERA TABLA DE LA "TAXONOMIA_CITA"/AUTORES >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

function tabla_ta($corto ,$val_ido,$validt,$cv_principal)
{


  $campo = "z_origin".$validt."_".$val_ido;
  $tamano = "30px";
  $teema = "Autores";
  $campo_v = $campo."[]";

	//echo "<br>".$validt;
  
  echo  "<td>";   
	echo  "<div id=$teema>";
		echo  "<table id=$teema>";
			echo  "<thead>";
				echo  "<tr>";
					echo  "<th>  </th>";
				echo  "</tr>";
			echo  "</thead>";
			echo  "<tbody>";
					$db = conectar();
					if ($db) 
					{
						if ($val_ido <> "a0")
						{
							$sql_tabla_ta = sql("z_origin",$val_ido,$cv_principal , 0);
							$res_tabla_ta = pg_query($db, $sql_tabla_ta[0]);
							if (!$res_tabla_ta) { exit("Error en la consulta"); }
							else
							{
								while ($fila = pg_fetch_array($res_tabla_ta, null, PGSQL_ASSOC))
								{
									foreach ($fila as $valor) 
									{
										echo  "<tr>";
										  	echo  "<td><input type=\"text\" name=\"$campo_v\" value= \"$valor\" list=\"$campo\"  class=\"$corto\"/></td>";
											echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
										echo  "</tr>"; 
									}	
								}// fin while
							}// fin else
						}
					}
					echo  "<tr>";
						echo  "<td><input type=\"text\" name=\"$campo_v\" list=\"$campo\"  class=\"$corto\"/></td>";
						echo  "<td align=\"right\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
					echo  "</tr>";
					
		$datalist = sql("z_origin",$val_ido,$cv_principal , 0);
		$resdata = pg_query($db, $datalist [1]);
		echo  "<datalist id=\"$campo\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor) { echo  "<option value=\"$valor\">";	}	} echo  "</datalist>";
				
			echo  "</tbody>";
			echo  "<tfoot>";
				echo  "<tr>";
					echo  "<td colspan=\"1\" align=\"right\">";
						echo  "<input type=\"button\" value=\"Agregar Autores\" class=\"clsAgregarFila\">";
					echo  "</td>";
				echo  "</tr>";
			echo  "</tfoot>";
		echo  "</table>";
	  echo  "</div>";
echo "</td>";
 }

// ---------------------<<<<<< FUNCIÓN TABLA_A  QUE IMPRIME LOS ATRIBUTOS DEL APARTADO DE INFORMACIÓN ESPACIAL >>>>>>>------------------------- 
function tabla_a($class,$id,  $cv_principal ,$tema)
{
	 $nombre = "a_nombre"; 
	 $descrp = "a_descipcion_atributo";
	 $fuente = "a_fuente";
	 $unida = "a_unidades";
	 $tipo = "a_tipo";

	$campo_n = $nombre."[]";
	$campo_d = $descrp."[]";
	$campo_f = $fuente."[]";
	$campo_u = $unida."[]";
	$campo_t = $tipo."[]";
	 
  	echo  "<div id=$tema>";
		echo  "<table id=$tema width=\"1269\">";
			echo  "<thead>";
				echo  "<tr>";
					echo  "<th width=\"352\">  </th>";
				echo  "</tr>";
			echo  "</thead>";
			echo  "<tbody>";
			
			global $id;
   			$db = conectar();
  			if ($db) 
			{
				if($id)	
				{
				
					if ($cv_principal == 28)
					{
						$sql_tabla_a = sql($nombre,$id , $cv_principal , 0);
						$res_tabla_a = pg_query($db, $sql_tabla_a[0]);
					}
					if ($cv_principal <> 28)
					{
						$sql_tabla_a = sql($nombre,$id , $cv_principal , 0);
						$res_tabla_a = pg_query($db, $sql_tabla_a[6]);
					}
			
			
					if (!$res_tabla_a) { exit("Error en la consulta"); }
					if (pg_num_rows ($res_tabla_a))
					{
						while ($fila = pg_fetch_array($res_tabla_a, NULL, PGSQL_ASSOC))
						{
							$val_n = $fila ['nombre'];
							$val_d = $fila ['descipcion_atributo'];
							$val_f = $fila ['fuente'];
							$val_u = $fila ['unidades'];
							$val_t = $fila ['tipo'];
								
							echo  "<tr>";
							  echo  "<td><input type=\"text\" name=\"$campo_n\" value= \"$val_n\" list=\"$nombre\"  class=\"$class\"/></td>";
							  echo  "<td width=\"396\"><input type=\"text\" name=\"$campo_d\" value= \"$val_d\" list=\"$descrp\"  class=\"$class\"/></td>";
							  echo  "<td width=\"202\"><input type=\"text\" name=\"$campo_f\" value= \"$val_f\" list=\"$fuente\"  class=\"$class\"/></td>";
							  echo  "<td width=\"153\"><input type=\"text\" name=\"$campo_u\" value= \"$val_u\" list=\"$unida\"  class=\"$class\"/></td>";
							  echo  "<td width=\"121\"><input type=\"text\" name=\"$campo_t\" value= \"$val_t\" list=\"$tipo\"  class=\"$class\"/></td>";
							  echo  "<td align=\"right\" width=\"17\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
							echo  "</tr>";
						}// FIN WHILE
					} // FIN PG_NUM_ROWS
					echo  "<tr>";
						echo  "<td><input type=\"text\" name=\"$campo_n\" list=\"$nombre\"  class=\"$class\"/></td>";
						echo  "<td width=\"396\"><input type=\"text\" name=\"$campo_d\" list=\"$descrp\"  class=\"$class\"/></td>";
						echo  "<td width=\"202\"><input type=\"text\" name=\"$campo_f\" list=\"$fuente\"  class=\"$class\"/></td>";
						echo  "<td width=\"153\"><input type=\"text\" name=\"$campo_u\" list=\"$unida\"  class=\"$class\"/></td>";
						echo  "<td width=\"121\"><input type=\"text\" name=\"$campo_t\" list=\"$tipo\"  class=\"$class\"/></td>";
						echo  "<td align=\"right\" width=\"17\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
					echo  "</tr>";
				} // FIN ID
				else 
				{
					echo  "<tr>";
						echo  "<td><input type=\"text\" name=\"$campo_n\" list=\"$nombre\"  class=\"$class\"/></td>";
						echo  "<td width=\"396\"><input type=\"text\" name=\"$campo_d\" list=\"$descrp\"  class=\"$class\"/></td>";
						echo  "<td width=\"202\"><input type=\"text\" name=\"$campo_f\" list=\"$fuente\"  class=\"$class\"/></td>";
						echo  "<td width=\"153\"><input type=\"text\" name=\"$campo_u\" list=\"$unida\"  class=\"$class\"/></td>";
						echo  "<td width=\"121\"><input type=\"text\" name=\"$campo_t\" list=\"$tipo\"  class=\"$class\"/></td>";
						echo  "<td align=\"right\" width=\"17\"><input type=\"image\" src=\"CSS/images/borrar.png\" class=\"clsEliminarFila\"></td>";
					echo  "</tr>";
				}
						
						
				$datalist = sql($nombre,$id, $cv_principal , 0);
				$resdata = pg_query($db, $datalist [1]);
				echo  "<datalist id=\"$nombre\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_n) { echo  "<option value=\"$valor_n\">";	}	} echo  "</datalist>";
						
				$resdata = pg_query($db, $datalist [2]);
				echo  "<datalist id=\"$descrp\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_d) { echo  "<option value=\"$valor_d\">";	}	} echo  "</datalist>";
						
				$resdata = pg_query($db, $datalist [3]);
				echo  "<datalist id=\"$fuente\">"; 	while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_f) { echo  "<option value=\"$valor_f\">";	}	} echo  "</datalist>";
					
				$resdata = pg_query($db, $datalist [4]);
				echo  "<datalist id=\"$unida\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_u) { echo  "<option value=\"$valor_u\">";	}	} echo  "</datalist>";
						
				$resdata = pg_query($db, $datalist [5]);
				echo  "<datalist id=\"$tipo\">"; while 	($fila = pg_fetch_array($resdata, null, PGSQL_ASSOC))	{	foreach ($fila as $valor_t) { echo  "<option value=\"$valor_t\">";	}	} echo  "</datalist>";	
			} // FIN DB
			pg_close($db);  
			
			echo  "</tbody>";
			echo  "<tfoot>";
				echo  "<tr>";
					echo  "<td colspan=\"5\" align=\"right\">";
						echo  "<input type=\"button\" value=\"Agregar $tema\" class=\"clsAgregarFila\">";
					echo  "</td>";
				echo  "</tr>";
			echo  "</tfoot>";
		echo  "</table>";
	echo  "</div>";
 }


////<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<  FUNCION CREA ARBOL >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
function crea_arbol($id , $cv_principal)
{
	$db = conectar();
	if ($db) 
	{
		if($id)
		{
			$sql_arbol = sql("carga_arbol",$id , $cv_principal , 0);
			$res_arbol = pg_query($db, $sql_arbol[0]);
			if (!$res_arbol) { exit("Error en la consulta"); }
			else
			{
				while ($fila = pg_fetch_array($res_arbol, null, PGSQL_ASSOC))
				{
					foreach ($fila as $valor) 
					{
						$val = $valor;			
					}
				}// fin while
				$res_arbol2 = pg_query($db, $sql_arbol[1]);
				if (!$res_arbol2) { exit("Error en la consulta"); }
				else
				{	  
					echo "<ul id=\"tt\" class=\"easyui-tree\" data-options=\"lines:true\">";
						echo "<li id =\"0\"> <span>Acervo</span>";
							echo "<ul>";
								echo "<ul>";
											$niv = array(0,0,0,0,0,0,0);
	 									$cla = array("vvvvv","vvvvv","vvvvv","vvvvv","vvvvv","vvvvv");
										while ( $fila = pg_fetch_row($res_arbol2, null, PGSQL_ASSOC))
										{
											
											if ( $niv[5] <> 0 and $fila ['idNivel6'] == '')
											{ 
												echo "</ul>";
												echo "</li>";
												$niv[5] = 0;
											} 
											if ( $niv[4] <> $fila ['idNivel5'] and $niv[5] <> 0)
											{ 
												echo "</ul>";
												echo "</li>";
												$niv[5] = 0;
											}	
											if ( $niv[3] <> $fila ['idNivel4'] and $niv[4] <> 0)
											{ 
												echo "</ul>";
												echo "</li>";
												$niv[4] = 0;
											}	
											if ( $niv[2] <> $fila ['idNivel3'] and $niv[3] <> 0)
											{ 
												echo "</ul>";
												echo "</li>";
												$niv[3] = 0;
											}	
											if ( $niv[1] <> $fila ['idnivel2'] and $niv[2] <> 0)
											{ 
												echo "</ul>";
												echo "</li>";
												$niv[2] = 0;
											}
											if ( $niv[0] <> $fila ['idNivel1'])
											{ 
												echo "</ul>";
												echo "</li>";
												$niv[1] = 0;
											}
																						
											$n_n[0] = $fila ['idNivel1'];
											$n_v[0] = $fila ['Nivel1'];
											$n_n[1] = $fila ['idnivel2']; 
											$n_v[1] = $fila ['Nivel2'];
											$n_n[2] = $fila ['idNivel3'];
											$n_v[2] = $fila ['Nivel3'];
											$n_n[3] = $fila ['idNivel4'];
											$n_v[3] = $fila ['Nivel4'];
											$n_n[4] = $fila ['idNivel5'];
											$n_v[4] = $fila ['Nivel5'];
											$n_n[5] = $fila ['idNivel6'];
											$n_v[5] = $fila ['Nivel6'];
											$niv[6] = $fila ['id'];
											
											if (($niv[0] <> $n_n[0]) or ($cla[0] <> $n_v[0]))   
											{
												 $cla[0] = $n_v[0];
												 $niv[0] = $n_n[0];
												 echo "<li id=\"$n_v[0]\" data-options=\"state:'closed'\">";
												 echo "<span>$n_v[0]</span>";
												 echo "<ul>";
											}  												
											if (($niv[1] <> $n_n[1]) or ($cla[1] <> $n_v[1]))
											{
												 $cla[1] = $n_v[1];
												 $niv[1] = $n_n[1];
											 
												if ($n_n[2] > 0) 
												{
													echo "<li id=\"$n_v[1]\" data-options=\"state:'closed'\">";
													echo "<span>$n_v[1]</span>";
													echo "<ul>";
												}  
												else 
												{
													echo "<li id=\"$niv[6]\">";
													echo "<span><a href=\"#\" style=\"text-decoration:none;color:black;\" ondblclick=\"getSelected()\">$n_v[1]</a></span>";
													echo  "</li>";
												} 
											}
											
											if ($n_n[2] > 0) 
											{
												if (($niv[2] <> $n_n[2]) or ($cla[2] <> $n_v[2]))
												{
													$cla[2] = $n_v[2];
													$niv[2] = $n_n[2];
											 
													if ($n_n[3] > 0) 
													{
														echo "<li id=\"$n_v[2]\" data-options=\"state:'closed'\">";
														echo "<span>$n_v[2]</span>";
														echo "<ul>";
													}  
													else 
													{
														echo "<li id=\"$niv[6]\">";
														echo "<span><a href=\"#\" style=\"text-decoration:none;color:black;\" ondblclick=\"getSelected()\">$n_v[2]</a></span>";
														echo  "</li>";
													} 			  											  
												}  
												if ($n_n[3] > 0) 
												{	
													if (($niv[3] <> $n_n[3]) or ($cla[3] <> $n_v[3]))
													{
														$cla[3] = $n_v[3];
														$niv[3] = $n_n[3];
								
														if ($n_n[4] > 0) 
														{
															echo "<li id=\"$n_v[3]\" data-options=\"state:'closed'\">";
															echo "<span>$n_v[3]</span>";
															echo "<ul>";
														}  
														else 
														{
															echo "<li id=\"$niv[6]\">";
															echo "<span><a href=\"#\" style=\"text-decoration:none;color:black;\" ondblclick=\"getSelected()\">$n_v[3]</a></span>";
															echo  "</li>";
														} 			  									
													}  
													if ($n_n[4] > 0) 
													{
														if (($niv[4] <> $n_n[4]) or ($cla[4] <> $n_v[4]))
														{
															$cla[4] = $n_v[4];
															$niv[4] = $n_n[4];
									
															if ($n_n[5] > 0) 
															{
																echo "<li id=\"$n_v[4]\" data-options=\"state:'closed'\">";
																echo "<span>$n_v[4]</span>";
																echo "<ul>";
															}  
															else 
															{
																echo "<li id=\"$niv[6]\">";
																echo "<span><a href=\"#\" style=\"text-decoration:none;color:black;\" ondblclick=\"getSelected()\">$n_v[4]</a></span>";
																echo  "</li>";
															}  
									 
														}  
														if ($n_n[5] > 0) 
														{   
															if (($niv[5] <> $n_n[5]) or ($cla[5] <> $n_v[5]))
															{
																$cla[5] = $n_v[5];
																$niv[5] = $n_n[5];
																echo "<li id=\"$niv[6]\">";
																echo "<span><a href=\"#\" style=\"text-decoration:none;color:black;\" ondblclick=\"getSelected()\">$n_v[5]</a></span>";
																echo  "</li>";
															}  
														}
													} 	
												}  	
											}													
										}// FIN WHILE
								echo "</ul>";
							echo "</ul>";
						echo "</li>";
					echo "</ul>";
					echo "<script language=\"javascript\">";
					echo "window.onload = function() { expandTo('$val'); } ";
					echo "</script>";
				}// fin del segundo else
			}// fin del primer else			
		}// fin id
	}// fin db	
}


?>
