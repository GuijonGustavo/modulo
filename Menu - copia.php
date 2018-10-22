<?php 
 session_start();
if ( ! ($_SESSION['autenticado'] == 'SI' && isset($_SESSION['uid'])) )
{

		echo "<form name=\"error\"  id=\"frm_error\" method=\"post\" action=\"index.php\">";
			echo "<input type=\"hidden\" name=\"actualiza_error\" value=\"1\" />";
			echo "<input type=\"hidden\" name=\"msg_error\" value=\"FAVOR DE INICIAR SESSION\">";
		echo "</form>";
		echo "<script type=\"text/javascript\"> ";
			echo "document.error.submit();";
		echo "</script>";

}
else
{
	ini_set("display_errors", "on");
	header('Content-Type: text/html; charset=utf-8'); 
	require('PHP/funciones.php');
	$db = conectar();
	if ($db)
	{
		$iden = $_SESSION['uid'];
		$password = $_SESSION['passw'];
		$fechaGuardada = $_SESSION["ultimoAcceso"];
		
		$ahora = date("Y-n-j H:i:s");  
       	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
		
		
		if($tiempo_transcurrido >= 1800) 
        {   
			session_start();
			session_unset();
			session_destroy(); 
			 
          	$mensajesAll = "SU SESSION HA FINALIZADO.";
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
		
		else{  $_SESSION["ultimoAcceso"] = $ahora;          }   
		
		$sql = 'SELECT * FROM analistas where "idAnalista"='.$iden.';';
		$result = pg_query($db, $sql); 
		if (!$result) { exit("Error en la consulta"); } 
		
		if( $fila = pg_fetch_array($result) )
		$cv_principal = $fila['idAnalista']; 	
		$nombreUsuario = $fila['Persona'];
		$username = $fila['nom_user']; 		
		
		if (empty($_GET["id"])) { $id=0;} 
		else { $id = $_GET["id"];}
	} //Cerrrar conexion a la BD
	 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html >

  <head>
    <title>Menu</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="CSS/style2.css" media="all" />
    <link href="CSS/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="jquery/base/jquery.ui.core.css">
    <link rel="stylesheet" href="jquery/base/jquery.ui.dialog.css">
    <link rel="stylesheet" href="jquery/base/jquery.ui.button.css">
    
    
	<script src="Javascript/jquery-1.7.1.min.js"></script>
	<script src="Javascript/javascript.js"></script>
	<script src="Javascript/jquery.easyui.min.js"></script>
    <script src="Javascript/jquery.ui.datepicker-es.js"></script>
    <script src="Javascript/jquery-ui-1.10.4.custom.js"></script>
    <script src="jquery/ui/jquery.ui.core.js"></script>
	<script src="jquery/ui/jquery.ui.widget.js"></script>
	<script src="jquery/ui/jquery.ui.position.js"></script>
	<script src="jquery/ui/jquery.ui.button.js"></script>
	<script src="jquery/ui/jquery.ui.dialog.js"></script>
	<script src="ajax.js"></script>
  	<script src="Javascript/scriptMetadatos.js"></script>
	
     <script>
      $(function(){
        $(document).tooltip();
      });

    </script>

</head>
<body>
	<div id="hd">
    	<table>
          <tr>
            <td width="20%"><img src="CSS/images/conabio_03.png"></td>
            <td><span>
			  <p class="txtN1"> Direcci&oacute;n General de Geom&aacute;tica</p>
              <p class="txtN2">Subcoordinaci&oacute;n de Sistemas de Informaci&oacute;n Geogr&aacute;fica</p>
			</span></td>
          </tr>
        </table>
	</div> <!-- FIN <div id="hd">-->
    <div id="nu">Bienvenido <b><?php echo $nombreUsuario; ?></b></div>
    <div id="cn">
		<div id="lf">
	    	<div id="lf1">
            	<input type="button" id="nuevo" value="Nuevo Registro">
                <input type="button" id="duplica" value="Duplicar Registro">
                <input type="button" id="cerrarSesion" value="Cerrar Sesi&oacute;n">
	      	</div> 
          	<div id="lf2" class="accordion">
	        	<p><img src="CSS/images/vineta.png"> Seleccione el Registro a Editar o Revisar</p>    
	        	<?php seleccion($id, $cv_principal);?>
            	<h1> Informaci&oacute;n B&aacute;sica </h1>
				<div>
                  <input type="button" onclick="cambiar.accion (1)" value="Datos Generales">
                  <input type="button" onclick="cambiar.accion (2)" value="Ubicaci&oacute;n Geogr&aacute;fica">
                  <input type="button" onclick="cambiar.accion (3)" value="Restricciones">
                  <input type="button" onclick="cambiar.accion (4)" value="Palabras Clave">
                  <input type="button" onclick="cambiar.accion (5)" value="Ambiente de Trabajo">
				</div>
			  <h1>Calidad de los Datos</h1>
				<div style="display:none;">
                  <input type="button" onclick="cambiar.accion (6)" value="Calidad de los Datos">
                  <input type="button" onclick="cambiar.accion (7)" value="Taxonom&iacute;a">
				</div>
			  <h1> Informaci&oacute;n Espacial y Atributos</h1>
				<div style="display:none;">
                	
                  <input type="button" onclick="cambiar.accion (8)" value="Datos  Espaciales">
                  <input type="button" onclick="cambiar.accion (9)" value="Proyecci&oacute;n Cartogr&aacute;fica">
                  <input type="button" onclick="cambiar.accion (10)" value="Atributos">
                  <?php if ($cv_principal == 28){?>
                  <input type="button" onclick="cambiar.accion (11)" value="Clasificaci&oacute;n y Analista">
				  <?php }?>	                   	
				</div>			
	      	</div> <!--FIN <div id="lf2" class="accordion">-->
        </div> <!--FIN <div id="lf">-->       
	</div> <!--FIN <div id="cn">-->
    <div id="rg" >
    		<div id="validaError" class="error" ></div>
         	 <div style="display:block " id="div1" class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="datos" onclick = "this.form.action = 'guardar.php?hoja=datos&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
                      	<div id="autores">Autores: 		<?php  global $id;  tabla("x_origin","30px",$id , $cv_principal,"Autores"); ?>  </div><br />
							<table width="869">
                            	<tr> 
                                	<td width="180">&nbsp;</td>
									<td colspan="5" align="center"> 
                                            <?php
                                                 if( isset( $_POST['actualiza'] ) && $_POST['actualiza'] != '' ){echo "<font color=\"green\"><ul id=\"msgs_actualiza\">".$_POST['msgs_actualiza']."</ul></font>"; }
                                                 if( isset( $_POST['error'] ) && $_POST['error'] != '' ) 		{echo "<font color=\"red\"><ul id=\"msgs_actualiza\">".$_POST['msgs_error']."</ul></font>";       }
                                            ?>
                                                          
                                    </td>
                                 </tr>
                                 <tr >
                                    <td>T&iacute;tulo del Mapa:</td>
                                    <td colspan="6"><?php 	$tooltipTitulo = "Título del mapa";
                                                      		global $id; genera("c_nombre","extenso",$id , $cv_principal , "txt" , $tooltipTitulo);?></td>
                                 </tr>
                                 <tr >
                                    <td>Nombre del Archivo:</td>
                                    <td colspan="6"><?php  	$tooltipNomArchivo = "Nombre del dato geoespacial o capa digital";
                                                      		global $id;  genera("c_cobertura","extenso",$id , $cv_principal , "txt" , $tooltipNomArchivo); ?></td>
                                 </tr>
                                 <tr >
                                   	<td>Fecha de Ingreso:</td>
                                    <td width="125"><?php 	$tooltipFechaIngres = "Fecha de captura de metadato";
                                                      		global $id;  genera("c_fecha_inicial","corto",$id , $cv_principal, "calendario" , $tooltipFechaIngres); ?></td>
                                                            
                                    <td width="166">Fecha de Actualizaci&oacute;n:</td>
                                    <td width="125"><?php 	$tooltipFechaAct = "";
                                                      		global $id;  genera("c_fecha","corto",$id , $cv_principal, "calendario" , $tooltipFechaAct);?></td>
                                    <td width="120">Versi&oacute;n FGDC:</td>
                                    <td width="125" colspan="2"><?php $tooltipVerFGDC = "";
                                                                  global $id;  genera("c_version","corto",$id , $cv_principal, "numeros" , $tooltipVerFGDC);?></td>
            					</tr>
                           	</table>
                          	<table width="869">
                                <tr> 
                                	<td colspan="6"><h3>Cita de la Informaci&oacute;n</h3></td>
                              	</tr>
                                <tr>
                                    <td width="180">Instituci&oacute;n Responsable:</td>
                                    <td colspan="6"><?php 	$tooltipInsti = "";
                                                      		global $id;  genera("c_publish","extenso",$id , $cv_principal , "txt", $tooltipInsti); ?></td>
                              	</tr>
                                <tr>
                                    <td>Siglas de la Instituci&oacute;n:</td>
                                    <td colspan="6"><?php 	$tooltipSigla = ""; 
                                                      		global $id;  genera("c_publish_siglas","extenso",$id , $cv_principal , "txt" , $tooltipSigla);?></td>
                                </tr>
                                <tr>
                                     <td rowspan="3">Lugar de publicaci&oacute;n:</td>
                                     <td width="190">Estado:</td>
                                     <td width="30">&nbsp;</td>
                                     <td width="205">Municipio:</td>
                                     <td width="30">&nbsp;</td>
                                     <td width="206" colspan="2">Localidad:</td>
                                </tr>
                                <tr>
                                  <td><?php global $id;  selects("estado","196px",$id , $cv_principal); ?></td>
                                  <td>&nbsp;</td>
                                  <td><?php global $id;  selects("municipio","196px",$id , $cv_principal); ?></td>
                                  <td>&nbsp;</td>
                                  <td colspan="2"><?php global $id;  selects("localidad","196px",$id , $cv_principal); ?></td>
                                </tr>
                                <tr>
                                     <td colspan="6"><div id="OTRO"  style="display: none;" class="element">
									 <?php  
									 		$tooltipOtro = ""; 
									 		global $id;  genera("c_pubplace","extenso",$id , $cv_principal , "txt", $tooltipOtro); ?> </div></td>
                                 </tr>
                                 <tr>
                                    <td>Fecha de publicaci&oacute;n:</td>
                                    <td><?php 	$tooltipFechaPub = "Fecha de elaboración o modificación de dato geoespacial";
                                          		global $id;  genera("c_pubdate","corto",$id , $cv_principal , "calendario" , $tooltipFechaPub);?></td>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Versi&oacute;n:</td>
                                    <td><?php 	$tooltipVersion = "Sinónimo de edición";
                                          		global $id;  genera("c_edition","corto",$id , $cv_principal , "txt" , $tooltipVersion); ?></td>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Escala:</td>
                                    <td><?php 	$tooltipEscala = "Escala del dato escrita como una razón";
                                          		global $id;  genera("c_escala","corto",$id , $cv_principal , "numeros" , $tooltipEscala); ?> </td>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Clave:</td>
                                    <td><?php 	$tooltipClave = "Clave de proyecto asignada por CONABIO";
                                          		global $id;  genera("c_clave","corto",$id , $cv_principal , "txt", $tooltipClave); ?> </td>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                
                                
                                 <tr>
                                     <td>Descripci&oacute;n del Metadato</td>
                                     <td colspan="6"><?php 	$tooltipDescMetad = "Información complementaria a la cita del dato geoespacial";
                                                        	global $id;  genera("c_issue","95px",$id , $cv_principal , "txtarea", $tooltipDescMetad);  ?></td>
                                 </tr>
                                 <tr>
                                     <td>Resumen :</td>
                                     <td colspan="6"><?php 	$tooltipResum = "Descripción breve del contenido, área cubierta y tema que representa el dato"; 
                                                       		global $id;  genera("c_resumen","95px",$id , $cv_principal , "txtarea" , $tooltipResum); ?></td>
                                 </tr>
                                 <tr >
                                     <td>Abstract :</td>
                                     <td colspan="6"><?php 	$tooltipAbst = "";
                                                      		global $id;  genera("c_abstract","95px",$id , $cv_principal , "txtarea", $tooltipAbst);  ?></td>
                                 </tr>
                                 <tr >
                                     <td>Objetivos Generales:</td>
                                     <td colspan="6"><?php 	$tooltipObje = "Propósito de la creación del dato"; 
                                                       		global $id;  genera("c_objetivo","95px",$id , $cv_principal , "txtarea", $tooltipObje); ?></td>
                                 </tr>
                                 <tr>
                                     <td>Datos Complementarios:</td>
                                     <td colspan="6"><?php 	$tooltipDatComp = "Información complementaria a cerca del dato"; 
                                                       		global $id;  genera("c_datos_comp","95px",$id , $cv_principal , "txtarea", $tooltipDatComp); ?></td>
                                </tr>
                         	</table>
                            <table width="869">
                            	<tr>
                                  	<td width="279">Tiempo comprendido:</td>
                                  	<td width="30">del: </td>
                                  	<td width="138"><?php  global $id;  genera("c_tiempo","corto",$id , $cv_principal , "calendario",  ""); ?></td>
                                  	<td width="30">al:</td>
                                  	<td width="138"><?php global $id;  genera("c_tiempo2","corto",$id , $cv_principal , "calendario",  ""); ?></td>
                                  	<td width="226" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  	<td >Nivel de Avance:</td>
                                  	<td colspan="6"> <?php 	$tooltipNive = ""; 
                                                       		global $id;  genera("c_avance","extenso",$id , $cv_principal , "txt" , $tooltipNive);  ?> </td>
                                </tr>
                                <tr>
                                  	<td>Mantenimiento:</td>
                                  	<td colspan="6"> <?php  $tooltipMante = "Frecuencia de actualización del dato"; 
                                                       		global $id;  genera("c_mantenimiento","extenso",$id , $cv_principal, "txt" , $tooltipMante);  ?> </td>
                                </tr>
                                <tr>
                                  	<td> Tama&ntildeo del Dato Geoespacial en MB: </td>
                                  	<td colspan="6"> <?php 	$tooltipTamañ = "Tamaño en megabytes del o los archivos que contiene el dato"; 
                                                        	global $id;  genera("c_tamano","extenso",$id , $cv_principal, "numeros" , $tooltipTamañ); ?> </td>
                                </tr>
                                <tr>
                                  	<td> Formato del Dato Geoespacial: </td>
                                  	<td colspan="6"> <?php 	$tooltipFormat = "Formato digital correspondiente a los lineamientos cartográficos estipulados por CONABIO"; 
                                                        	global $id;  genera("c_geoform","extenso",$id , $cv_principal, "txt" , $tooltipFormat); ?> </td>
                                </tr>
                                <tr>
                                  	<td>Ligas WWW:</td>
                                  	<td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                  	<td colspan="7"><?php  global $id;  tabla("l_liga_www","100px",$id , $cv_principal ,"Ligas_www"); ?></td>
                                </tr>
                          	</table>
					</form>
                </div>
             </div>
             <div id="div2"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="ubicacion" onclick = "this.form.action = 'guardar.php?hoja=ubicacion&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr> 
                                	<td width="250">&nbsp;</td>
									<td colspan="2" align="center"></td>
                        		</tr>
                                <tr >
                                    <td>&Aacute;rea Geogr&aacute;fica:</td>
                                    <td colspan="3"><?php  // global $id;  genera("c_area_geo","100px",$id , $cv_principal , "txtarea"); ?></td>
                                </tr>
                                <tr >
                                    <td colspan="4"><h3>Coordenadas del Extremo:</h3></td>
                                </tr>
                                <tr >
                                   	<td>Coordenadas del Extremo Oeste:</td>
                                    <td width="400"><?php // global $id;genera("c_oeste","corto",$id , $cv_principal, "numeros");?></td>
                                   	<td width="203" colspan="2">&nbsp;</td>
                        		</tr>
                                <tr >
                                   <td>Coordenadas del Extremo Este:</td>
                                   <td><?php // global $id;genera("c_este","corto",$id , $cv_principal, "numeros");?></td>
                                   <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr >
                                   <td>Coordenadas del Extremo Norte:</td>
                                   <td><?php // global $id;genera("c_norte","corto",$id , $cv_principal, "numeros");?></td>
                                   <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr >
                                   <td>Coordenadas del Extremo Sur:</td>
                                   <td><?php // global $id;genera("c_sur","corto",$id , $cv_principal, "numeros");?></td>
                                   <td colspan="2">&nbsp;</td>
                                </tr>
                           </table>
                    </form>
                </div>
             </div>
             <div id="div3"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="restricciones" onclick = "this.form.action = 'guardar.php?hoja=restricciones&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr>
                                	<td>&nbsp;</td>
                                    <td>&nbsp;</td>
                            	</tr>
                                <tr>
                                   	<td colspan="2"><h3>Restricciones</h3></td>
                                </tr>
                                <tr>
                                   	<td width="107">Acceso:</td>
                                   	<td><?php // global $id;genera("c_acceso","extenso",$id , $cv_principal , "txt");?></td>
                                </tr>
                                <tr>
                                   	<td>Uso:</td>
                                   	<td><?php // global $id;genera("c_uso","extenso",$id , $cv_principal , "txt");?></td>
                                </tr>
                                <tr>
                                  <td>Observaciones:</td>
                                  <td><?php // global $id;genera("c_observaciones","100px",$id , $cv_principal , "txtarea");?></td>
                                </tr>
                           	</table>
                    </form>
                </div>
             </div>
             <div id="div4"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="palabrasClave" onclick = "this.form.action = 'guardar.php?hoja=palabrasClave&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							 <table width="869">
                                 <tr >
                                   	<td width="107">&nbsp;</td>
                                    <td width="750">&nbsp;</td>
                        		</tr>
                                <tr >
                                   <td><h3>Temas:</h3>	</td>
                                   <td><?php // global $id;  tabla("m_Palabra_Clave","100px",$id , $cv_principal,"Temas"); ?></td>
                                </tr>
                                <tr >
                                  <td><h3>Sitios:</h3></td>
                                  <td><?php // global $id;  tabla("s_Sitios_Clave","100px",$id , $cv_principal,"Sitios"); ?></td>
                                </tr>
                           </table>
                           
                    </form>
                </div>
             </div> 
             <div id="div5"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="ambienteDeTrabajo" onclick = "this.form.action = 'guardar.php?hoja=ambienteDeTrabajo&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="200">&nbsp;</td>
                                    <td width="657">&nbsp;</td>
                        		</tr>
                                <tr >
                                   <td>Software y Hardware:</td>
                                   <td><?php // global $id;  genera("c_software_hardware","extenso",$id , $cv_principal, "txt"); ?></td>
                                 </tr>
                                 <tr >
                                   <td>Sistema Operativo:</td>
                                   <td><?php // global $id;  genera("c_sistema_operativo","extenso",$id , $cv_principal, "txt"); ?></td>
                                 </tr>
                                 <tr >
                                   <td>Requisitos T&eacute;cnicos:</td>
                                   <td><?php // global $id;  genera("c_tecnicos","extenso",$id , $cv_principal, "txt"); ?></td>
                                 </tr>
                                 <tr >
                                   <td>Ruta y nombre de Archivo:</td>
                                   <td><?php // global $id;  genera("c_path","extenso",$id , $cv_principal, "txt"); ?></td>
                                 </tr>
                           	</table>
                    </form>
                </div>
             </div>
             <div id="div6"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="calidadDeDatos" onclick = "this.form.action = 'guardar.php?hoja=calidadDeDatos&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="230">&nbsp;</td>
                                    <td width="627">&nbsp;</td>
                        		</tr>
                                <tr >
                                   	<td>Metodolog&iacute;a:</td>
                                   	<td><?php  // global $id;  genera("c_metodologia","extenso",$id , $cv_principal, "txt"); ?></td>
                                 </tr>
                                 <tr >
                                   	<td>Descripci&oacute;n de la Metodolog&iacute;a:</td>
                                   	<td><?php  // global $id;  genera("c_descrip_metodologia","95px",$id , $cv_principal, "txtarea"); ?></td>
                                 </tr>
                                 <tr >
                                   	<td>Descripci&oacute;n del Proceso:</td>
                                   	<td><?php  // global $id;  genera("c_descrip_proceso","90px",$id , $cv_principal, "txtarea");?></td>
                                 </tr>
                                 <tr >
                                   	<td colspan="2"><h3>Referencia de los Datos Originales</h3></td>
                                 </tr>
                           	</table>
                            <?php  // global $id;  tabla_d("corto",$id , $cv_principal, "Datos" ); ?>
                	</form>
               	</div>
             </div>
             <div id="div7"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="taxonomia" onclick = "this.form.action = 'guardar.php?hoja=taxonomia&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="230">&nbsp;</td>
                                    <td width="627">&nbsp;</td>
                        		</tr>
                                 <tr >
                                   	<td colspan="2"><h3>TAXONOMIA:</h3></td>
                                 </tr>
                                 <tr >
                                   	<td width="230"></td>
                                    <td width="627">&nbsp;</td>
                        		</tr>
                           	</table>
                            
                            <?php // global $id;  tabla_t("extenso","corto",$id , $cv_principal, "Taxonom&iacute;a"); ?>
                            
                	</form>
               	</div>
             </div>
             <div id="div8"  class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="estructuraRaster" onclick = "this.form.action = 'guardar.php?hoja=estructuraRaster&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr>
                                	<td>&nbsp;</td>
                                    <td width="697">&nbsp;</td>
   								</tr>
                                <tr>
                                   	<td colspan="2"><h3>Informaci&oacute;n Espacial: </h3> </td>
                                </tr>
                                <tr>
                                   	<td width="160">Estructura del Dato:</td>
                               	  <td><?php  // global $id;  genera("c_estructura_dato","extenso",$id , $cv_principal, "txt"); ?></td>
                                </tr>
                                <tr>
                                   	<td>Tipo del Dato:</td>
                                   	<td><?php  // global $id;  genera("c_tipo_dato","extenso",$id , $cv_principal, "txt"); ?></td>
                                </tr>
                                <tr>
                                  <td>Numero total del Dato:</td>
                                  <td><?php  // global $id;  genera("c_total_datos","extenso",$id , $cv_principal, "numeros"); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><h3>Si la estructura es Raster : </h3></td>
                                </tr>
                           	</table>
                            <table width="962" border="10">
                            	<tr>
                                  	<td width="150"><p>Numero de renglones:</p></td>
                                  	<td width="150"><p>Numero de columnas:</p></td>
                                  	<td width="150"><p>Tama&ntilde;o del pixel de X en metros:</p></td>
                                  	<td width="150"><p>Tama&ntilde;o del pixel de Y en metros:</p></td>
                                  	<td width="150"><p>Coordenada X del  origen del raster:</p></td>
                                  	<td width="154"><p>Coordenada Y del origen del raster:</p></td>
                                </tr>
                                <tr>
                                  	<td align="center"><p><?php   // global $id;  genera("r_nun_renglones","15px",$id , $cv_principal, "numeros"); ?>	</p></td>
                                  	<td align="center"><p><?php   // global $id;  genera("r_num_columnas","15px",$id , $cv_principal, "numeros"); ?>		</p></td>
                                  	<td align="center"><p><?php   // global $id;  genera("r_pixel_X","15px",$id , $cv_principal, "numeros"); ?>			</p></td>
                                  	<td align="center"><p><?php   // global $id;  genera("r_pixel_Y","15px",$id , $cv_principal, "numeros"); ?>       	</p></td>
                                  	<td align="center"><p><?php   // global $id;  genera("r_COOR_X","15px",$id , $cv_principal, "numeros"); ?>        	</p></td>
                                  	<td align="center"><p><?php   // global $id;  genera("r_COOR_Y","15px",$id , $cv_principal, "numeros"); ?>        	</p></td>
                                </tr>	
                            </table>	
                    </form>
                </div>
             </div>
             <div id="div9"  class="element">
             		<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="proyeccion" onclick = "this.form.action = 'guardar.php?hoja=proyeccion&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
                        	<table width="869">
                            	<tr>
                                	<td width="160">&nbsp;</td>
                                    <td colspan="2">&nbsp;</td>
   								</tr>
                           	</table>
                            
                            
							<h3>Proyecci&oacute;n Cartogr&aacute;fica: <?php  // global $id;  genera("c_id_proyeccion","10px",$id , $cv_principal, "txt"); ?> </h3>	
			  &nbsp;&nbsp;&nbsp;Id  &nbsp;  Sistema-coorde  &nbsp;&nbsp;&nbsp;  Siglas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Paralelo1 &nbsp; Paralelo2 &nbsp;&nbsp; md &nbsp; Latorigen &nbsp; Falso Este &nbsp; Falso Norte
		            <script   type="text/javascript">
		              document.getElementsByName("c_id_proyeccion")[0].style.display = "none";
		                var proyec = [ 
			              " &nbsp;   1   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                      Conica_ INEGI  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   17.50  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   29.50   &nbsp;&nbsp;&nbsp;&nbsp;                                                                                                                                                                       -102   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          12   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                 2500000  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
			              " &nbsp;   2   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    UTM 11         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    -117   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                      500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   3   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    UTM 12         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    -111   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                      500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   4   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    UTM 13         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    -105   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                      500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   5   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    UTM 14         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    -99    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   6   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    UTM 15         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    -93    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   7   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    UTM 16         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    -87    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   8   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Geografica   &nbsp;&nbsp;&nbsp;&nbsp;                                                          Geografica     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    500000   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
					      " &nbsp;   9   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Plana        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                  Conica_CONABIO  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                          17.50  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   29.50  &nbsp;&nbsp;&nbsp;&nbsp;                                                                                                                                                                        -102   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     0    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                          2000000  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               0   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"];
				        var idp = document.getElementsByName("c_id_proyeccion")[0].value;	
					
		              document.write("<select name= proyeccion id=proyeccion size=9  onchange='c_id_proyeccion.value = this.value'>");
			            for (i=1;i<=9;i++) {
			              if (idp == i ) {
				          document.write("<option  value='"+ i + "' selected >" + proyec[i-1] + "</option>");
				          }
				        else {
			   	          document.write("<option value='"+ i + "'> <pre>" +   proyec[i-1] + "</pre> </option>");
				             }
                           }
                      document.write("</select >");
		            </script>
                      <table >
                        <tr>
                          <td>Datum Horizontal:</td>
                          <td> <?php  // global $id;  genera("c_datum","30px",$id , $cv_principal , "txt"); ?> </td>
                        </tr>
                        <tr>
                          <td>Nombre del Elipsoide:</td>
                          <td> <?php  // global $id;  genera("c_elipsoide","30px",$id , $cv_principal , "txt"); ?> </td>
                        </tr>
                      </table>  
                    </form>
                </div>
             </div>
             <div id="div10" class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="atributos" onclick = "this.form.action = 'guardar.php?hoja=atributos&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869" border="0">
                            	<tr>
                                	<td>&nbsp;</td>
                                	<td>&nbsp;</td>
                               	</tr>
                              	<tr>
                                	<td width="241">Nombre de la Entidad (Tabla):</td>
                                	<td width="618"><?php  // global $id;  genera("c_tabla","extenso",$id , $cv_principal , "txt"); ?> </td>
                              	</tr>
                              	<tr>
                                	<td>Descripci&oacute;n de la Entidad (Tabla):</td>
                                	<td><?php  // global $id;  genera("c_descrip_tabla","80px",$id , $cv_principal , "txtarea"); ?></td>
                              	</tr>
                                <tr>
                                	<td colspan="2"><h3>Atributos</h3></td>
                                </tr>
                           </table>
                           <table width="1249" border="1">
                           		<tr>
                                    <td width="350" align="center">Nombre:</td>
                                    <td width="395" align="center">Descripci&oacute;n:</td>
                                    <td width="200" align="center">Fuente:</td>
                                    <td width="150" align="center">Unidades de medida:</td>
                                    <td width="120" align="center">Tipo de dato:</td>
                          		</tr>
                          </table>
                          <?php  // global $id;  tabla_a("extenso",$id , $cv_principal, "Atributos" ); ?>
                    </form>
                </div>
             </div>
             <div id="div11" class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                        <input type = "submit" value = "Guardar"  id="arbol" onclick = "this.form.action = 'guardar.php?hoja=arbol&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
                        <br />
							 <table width="869" border="0">
                            	<tr>
                                	<td>&nbsp;</td>
                                	<td colspan="2">&nbsp;</td>
                               	</tr>
                              	<tr>
                                	<td width="118"><h3>Clasificaci&oacute;n</h3></td>
                                	<td width="657"><input type="text" name="c_clasif_ruta" class="extenso" /></td>
                              	    <td width="80"><?php  // global $id;  genera("c_clasificacion","corto",$id , $cv_principal , "txt"); ?></td>
                              	</tr>
                              	<tr>
                                	<td>&nbsp;</td>
                                	<td colspan="2">&nbsp;</td>
                              	</tr>
                                <tr>
                                	<td colspan="3">&nbsp;</td>
                                </tr>
                           </table>
						   <p><?php  // crea_arbol($id , $cv_principal); ?> </p>      
                    </form>
                </div>
             </div>
             
             <div id="dialog_nuevo"  title="Crear nuevo Metadato">
                <p class="validateTips">T&iacute;tulo del Mapa:</p>
                <form name="nuevo" method="post" action="nuevo.php" id="formNuevo">
                        <input type="text" name="name" id="name" class="text  ui-corner-all" />
                        <input type="hidden" name="cv_principal" id="cv_principal" value="<?php echo $cv_principal;?>"/>
                        <input type="hidden"  name="id_general" id="id_general" value="<?php echo $id;?>"/>
                </form>
            </div> 
            
            <div id="dialog_duplica"  title="Duplicar Metadato">
                <p class="validateTips">T&iacute;tulo del Mapa:</p>
                <form name="duplica" method="post" action="duplica.php" id="formDuplica">
                        <input type="text" name="nameDuplica" id="nameDuplica" class="text  ui-corner-all" />
                        <input type="hidden" name="cv_principal" id="cv_principal" value="<?php echo $cv_principal;?>"/>
                        <input type="hidden"  name="id_general" id="id_general" value="<?php echo $id;?>"/>
                </form>
            </div>
            
            <div id="cerrar_sesion"  title="Finalizar Sesion">
                <form name="terminoSesion" method="post" action="PHP/cerrarSesion.php" id="formTerminoSesion">
                        <img src="CSS/images/alert.jpg" class="alert"  /><p class="validateTips">Guardar su Informaci&oacute;n <br />Antes de salir</p>
                </form>
            </div>
            
        </div> <!--FIN <div id="rg">-->
        
 <?php 
 		pg_close($db);
 }	
 
 ?>
</body>
</html>
