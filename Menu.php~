<?php 

require_once('../shpRead/php-shapefile/src/ShapeFileAutoloader.php');
\ShapeFile\ShapeFileAutoloader::register();

use \ShapeFile\ShapeFile;
use \ShapeFile\ShapeFileException;


ob_start();

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
	require('PHP/conn.php');
	require('PHP/funciones.php');
	$db = conectar();
	if ($db)
	{
		$iden = $_SESSION['uid'];
		$password = $_SESSION['passw'];
		$fechaGuardada = $_SESSION["ultimoAcceso"];
		
		$ahora = date("Y-n-j H:i:s");  
       	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
		
		$sql = 'SELECT * FROM analistas where "idAnalista"='.$iden.';';
		$result = pg_query($db, $sql); 
		if (!$result) { exit("Error en la consulta"); } 
		
		if( $fila = pg_fetch_array($result) )
		$cv_principal = $fila['idAnalista']; 	
		$nombreUsuario = $fila['Persona'];
                $username = $fila['nom_user']; 
                $puesto = $fila['Puesto'];        
		
		if (empty($_GET["id"])) { $id=0;} 
		else { $id = $_GET["id"];}
	} //Cerrrar conexion a la BD
	 

    $nameFileSession = etiquetas("c_cobertura",$id , $cv_principal);

    $_SESSION['nameFileSession'] = $nameFileSession;


    $titleFileSession = etiquetas("c_nombre",$id , $cv_principal);

    $_SESSION['titleFileSession'] = $titleFileSession;

    $datumFileSession = etiquetas("c_datum",$id , $cv_principal);

    $_SESSION['datumFileSession'] = $datumFileSession;
    $_SESSION['nombreUsuario'] = $nombreUsuario;

    if ($nombreUsuario == 'Shareni Lara')
        {
$nom = 'slara';
}

else if ($nombreUsuario == 'ssocialsig')
        {
$nom = 'ssocialsig';
}

else if ($nombreUsuario == 'Verena Ekaterina Benítez')
        {
$nom = 'vbenitez';
}
else if ($nombreUsuario == 'Gustavo')
        {
$nom = 'CPR';
}
else if ($nombreUsuario == 'Estrella Cruz')
        {
$nom = 'ecruz';
}
else if ($nombreUsuario == 'Rocío López')
        {
$nom = 'rlopez';
}
else if ($nombreUsuario == 'Laura Herrera')
        {
$nom = 'oherrera';
}
else { 

    $nom = $nombreUsuario;
}

//Obtenemos el tiempo actual.
//$tiempo = time();

//$time = time();

//$tiempo_actual = date('Y-m-d  H:i:s', $time);
//$tiempo= date('H:i:s', $time);

//$strStart = $tiempo_actual;
//Tiempo de expira.
//$strEnd   = '2019-05-09 21:25';    

//Convierte la cadena en una variable de fecha.
//$dteStart = new DateTime($strStart);
//$dteEnd   = new DateTime($strEnd);

//Calculamos la diferencia 
//$dteDiff  = $dteStart->diff($dteEnd);    

//Salida de data.
//print $dteDiff->format("%H:%I:%S");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html >

  <head>
    <title>Módulo CBM</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
   <link rel="stylesheet" href="openLayers/v4.2.0/css/ol.css"  type="text/css"> 
    <link rel="stylesheet" href="CSS/style4.css" media="all" />
     <link href="CSS/jquery-ui.css" rel="stylesheet">
   <link rel="stylesheet" href="jquery/base/jquery.ui.core.css">
    <link rel="stylesheet" href="jquery/base/jquery.ui.dialog.css">
    <link rel="stylesheet" href="jquery/base/jquery.ui.button.css">
	  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css?family=Oswald:300,500,700" rel="stylesheet">
   <!--<link rel="stylesheet" href="https://openlayers.org/en/v4.2.0/css/ol.css" type="text/css"> -->
    
<!--	<script src="Javascript/jquery-3.2.1.min.js"></script>-->
<!--	<script src="https://openlayers.org/en/v4.2.0/build/ol.js" type="text/javascript"></script>-->
<script src="openLayers/v4.2.0/build/ol.js" type="text/javascript"></script>
	<script src="Javascript/jquery-1.7.1.min.js"></script>

<script src="https://d3js.org/d3.v3.min.js"></script>




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
<!--<script src="openLayers/v4.2.0/build/ol.js" type="text/javascript"></script>-->
<!--     <script>
      $(function(){
        $(document).tooltip();
      });

    </script>-->
   <!--  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<script type="text/javascript">
$(document).ready(function(){
	$('.error').hide();
	var fileExtension = "";
	$(':file').change(function(){
		var file = $("#userfile")[0].files[0];
		var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        var fileSize = file.size;
        var fileType = file.type;
		
		if(fileExtension == "txt")
		{
			var formData = new FormData($(".formulario")[0]);
			var message = ""; 
			
			$.ajax({
				 url: 'subir.php', 
				 type: 'POST', 
				 data: formData,
				 dataType : "json",
				 cache: false,
				 contentType: false,
				 processData: false,
				}).done(function(result) {
				
				//var output = "<h1>" + result.message + "</h1>";
				var output = "";
				$.each(result.vector.linea, function( i, obj ) {
					$("#selectVector").append('<option value='+ obj+'>'+ result.vector.name [i]+'</option>');
					
				});
				
				$.each(result.tif.linea, function( i, obj ) {
					$("#selectTif").append('<option value='+ obj+'>'+ result.tif.name [i]+'</option>');
					//output += obj + "<br>";
				});
				

				
				
				$("#contenido").html(output );
				});

			
  
		}
	});
	
	$('#descarga').click(function(){
		window.location = "ficheros/metadatos.sfx.exe";
	});
	
	
});	

//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}

function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'txt': 
            return true;
        break;
        default:
            return false;
        break;
    }
}
$(document).ready(function(){	

	


	$("#selectVector").change(function () {
    	$("#selectVector option:selected").each(function () {
			elegido=$(this).val();
			if(elegido != "")	
			{
				
				vectores(elegido);	

				
			}
			//alert(elegido);
		});
	});
	
	$("#selectTif").change(function () {
    	$("#selectTif option:selected").each(function () {
			elegido=$(this).val();
			if(elegido != "")	
			{	
				
				archivosTif(elegido);
			}
		});
	});
});

function archivosTif(nameTif) {
	var archivoTxt = $("#userfile").val();
	var fileName = archivoTxt.split("\\");
	var fileName = fileName[fileName.length-1];
	var dato = nameTif;
	var hoja = "tif";
	var dataString = {metadato : nameTif , fileMetadato : fileName, contenido : hoja}

		$.ajax({
		data: dataString,
		url: 'subir2.php', 
		type: "GET",
		dataType : "json",
		}).done(function(result) {
			//alert(result.tif);
				$("#c_datum").val("WGS_1984");
				$("#c_estructura_dato").val("Raster");
				$("#c_tipo_dato").val(result.tifDato);
				$("#c_total_datos").val(result.count);
				$("#c_elipsoide").val("GCS_WGS_1984");	
				$("#c_oeste").val(result.Xmin); 
				$("#c_sur").val(result.Ymin);
				$("#c_este").val(result.Xmax);
				$("#c_norte").val(result.Ymax);
				$("#c_id_proyeccion").val("Geográfica");
				$("#r_num_columnas").val(result.tifColunmas);
				$("#r_nun_renglones").val(result.tifRenglones);
				$("#r_pixel_X").val(result.tifPixelX);
				$("#r_pixel_Y").val(result.tifPixelY);
				$("#r_COOR_X").val(result.tifRasterX);
				$("#r_COOR_Y").val(result.tifRasterY);
				
				
			
		});
	//alert(nameMetadato);
}

function vectores(nameMetadato) {
	
	var archivoTxt = $("#userfile").val();
	var fileName = archivoTxt.split("\\");
	var fileName = fileName[fileName.length-1];
	var dato = nameMetadato;
	var hoja = "vectores";
	var dataString = {metadato : nameMetadato , fileMetadato : fileName , contenido : hoja}

		$.ajax({
		data: dataString,
		url: 'subir2.php', 
		type: "GET",
		dataType : "json",
				}).done(function(result) {
				$("#c_datum").val(result.datumName);
				$("#c_tipo_dato").val(result.geometry);
				$("#c_total_datos").val(result.count);
				$("#c_elipsoide").val(result.geogcssName);	
				$("#c_oeste").val(result.Xmin); 
				$("#c_sur").val(result.Ymin);
				$("#c_este").val(result.Xmax);
				$("#c_norte").val(result.Ymax);
				$("#c_id_proyeccion").val(result.proyeccion);
				
				if((result.geometry == 'Point') || (result.geometry =='Polygon') || (result.geometry =='Line String'))
				{
					$("#c_estructura_dato").val("Vector");
				}
				//$("#contenido").html(result.Xmin);
				$("#r_num_columnas").val("");
				$("#r_nun_renglones").val("");
				$("#r_pixel_X").val("");
				$("#r_pixel_Y").val("");
				$("#r_COOR_X").val("");
				$("#r_COOR_Y").val("");
			//	alert((result.geometry).length);
				
			
		});
	//alert(nameMetadato);
}
</script>

<script type="text/javascript">
var options = {
        color : ["red","green","blue"],
                    country : ["Spain","Germany","France"]
}

$(function(){
        var fillSecondary = function(){
                    var selected = $('#primary').val();
                            $('#secondary').empty();
                            options[selected].forEach(function(element,index){
                                            $('#secondary').append('<option value="'+element+'">'+element+'</option>');
                                                    });
                                }
            $('#primary').change(fillSecondary);
            fillSecondary();
});
</script>






<script type="text/javascript">

function habilitar(obj) {
  var hab;
//  frm=obj.id;
  num=obj.selectedIndex;
  if (num==1) hab=false;
  else if (num==2) hab=true;
  document.getElementById('c_nombre').disabled=hab;
  document.getElementById('tabla_1').disabled=hab;
  document.getElementById('autores').disabled=hab;
  document.getElementsByName('datos').disabled=hab;
}
</script>

<script type="text/javascript">

function habilitar() {
        var x = document.getElementById("boton_subir");
            x.disabled = false;
}


</script>

<script>
var customDialog = function (options) {
$('<div></div>').appendTo('body')
    .html('<div style="margin-top: 15px; font-weight: bold; text-align:center">' + options.message + '</div>')
.dialog({
modal: true,
title: options.title || 'Bienvenid@ <?php echo $nombreUsuario; ?>', zIndex: 10000, autoOpen: true,
width: 'auto', resizable: false,
buttons: {
Editar: function () {
$(this).dialog("close");
},
Crear: function () {
$("#dialog_nuevo" ).dialog( "open" );
},
Duplicar: function () {
$("#dialog_duplica" ).dialog( "open" );
},
},
close: function (event, ui) {
$(this).remove();
}
});
};
    </script>


    <script>

var thetime = '00:00:00';
// this would be something like:
// // var thetime = '<?=date('H:i:s');?>';
var arr_time = thetime.split(':');
var ss = arr_time[2];
var mm = arr_time[1];
var hh = arr_time[0];
//
var update_ss = setInterval(updatetime, 1000);
//
function updatetime() {
ss++;
if (ss < 10) {
ss = '0' + ss;
}
if (ss == 60) {
ss = '00';
mm++;
if (mm < 10) {
mm = '0' + mm;
}
if (mm == 60) {
mm = '00';
hh++;
if (hh < 10) {
hh = '0' + hh;
}
if (hh == 24) {
hh = '00';
}
$("#hours").html(2 - hh);
}
$("#minutes").html(60 - mm);
}
$("#seconds").html(60 - ss);
}


    </script>






</head>

<body>
<?php
if($id == 0) {echo "<script>$(document).ready(function(){ customDialog({message: '¿Qué desea hacer?</br>Crear registro, duplicar o continuar'}); });</script>";}?>
	<div id="hd">
    	<table width="1200px">
          <tr>
            <td width="20%" class="title"><span>
            <td width="60%" class="title"><span>
            <td width="20%" ><img src="CSS/images/logos2.png" width="800"></td>
			  <p class="txtN2"></p>
<!--<?php echo $iden ;?><br />
<?php echo $cv_principal;?>	
<?php echo $tooltipNomArchivo; ?> -->
			</span></td>
			  <p class="txtN2" style="text-align:center">Proyecto de Cooperación Triangular Fortalecimiento de capacidades para la gestión territorial sostenible del Corredor Biológico Mesoamericano en Guatemala</p>
			</span></td>
          </tr>
        </table>
    </div> <!-- FIN <div id="hd">-->
    <div id="nu">&nbsp;&nbsp; Hola <b><?php echo $nombreUsuario.",";?> </b>tu sesión expira en: <span id="hours">02</span>:<span id="minutes">00</span>:<span id="seconds">00</span> minutos.
<input style="float:right; background:url(CSS/images/cerrar_sesion_btn.png) no-repeat; width:150px; height:40px; border-radius: 15px; " type="button" id="cerrarSesion"><a href="manualTaller.pdf"> <input style="float:right; background:url(CSS/images/manual.jpeg) no-repeat; width:130px; height:43px; border-radius: 25px; " type="button" id="manual"></a></div>   
    <div id="cn">
		<div id="lf">
	    <!--	<div id="lf1">
 
                <input type="button" id="duplica" value="Duplicar Registro">
                <input type="button" id="nuevo" value="Crear Registro">
				<?php if ($cv_principal == 28) {echo 
                '<input type="button" id="borrar" value="Borrar Registro">'
				;}; ?>   
             <input type="button" id="cerrarSesion" value="Cerrar Sesi&oacute;n"> 
	      	
			</div> -->
            <div id="lf2" class="accordion">



	        	<p>Seleccione el registro a editar o revisar:</p>    
	        	<?php seleccion($id, $cv_principal);?>
            	<h1> Informaci&oacute;n b&aacute;sica </h1>
				<div style="display:none;">
                  <input type="button" onclick="cambiar.accion (1)" value="Datos Generales">
                  <!--<input type="button" onclick="cambiar.accion (2)" value="Ubicaci&oacute;n Geogr&aacute;fica">-->
                  <input type="button" onclick="cambiar.accion (3)" value="Restricciones">
                  <input type="button" onclick="cambiar.accion (4)" value="Palabras Clave">
                  <input type="button" onclick="cambiar.accion (5)" value="Ambiente de Trabajo">
	
				</div>






              <h1>Calidad de los datos</h1>
				<div style="display:none;">
                  <input type="button" onclick="cambiar.accion (6)" value="Calidad de los Datos">
                  <input type="button" onclick="cambiar.accion (7)" value="Taxonom&iacute;a">
				</div>








              <h1> Informaci&oacute;n espacial y atributos</h1>
				<div style="display:none;">
                	
                  <input type="button" onclick="cambiar.accion (9)" value="Datos  Espaciales">
                  <input type="button" onclick="cambiar.accion (10)" value="Atributos">
                  <?php if ($cv_principal == 28){?>
                  <input type="button" onclick="cambiar.accion (11)" value="Clasificaci&oacute;n y Analista">
				  <?php }?>	                   	
				</div>		

			  <h1> Cartograf&iacute;a</h1>  
				<div style="display:none;">
<!--                  <input type="button" id="zip" value="Subir zip">   Este botón está por si se necesita una ventana popup-->

<!--  Botones de Subir archivos, Registro de Colaboradores, Aprobar Metadatos  -->

                                 <?php if ($puesto == "Administrador de Metadatos" || $puesto == "administrador" || $puesto == "analista") {echo 
                 		'<input type="button" onclick="cambiar.accion (14)" value="Subir archivos">'                  
				;}; ?>   

                                 <?php if ($puesto == "Administrador de Metadatos" || $puesto == "analista") {echo 
                 		'<input type="button" onclick="cambiar.accion (15)" value="Plantilla">'                  
				;}; ?>   
                                 <?php if ($puesto == "Administrador de Metadatos" || $puesto == "analista") {echo 
                 		'<input type="button" onclick="cambiar.accion (16)" value="XML">'                  
				;}; ?>   
                                 
                                 <?php if ($puesto == "Administrador de Metadatos" || $puesto == "analista") {echo 
                 		'<input type="button" onclick="cambiar.accion (17)" value="SLD">'                  
				;}; ?>   
				<?php if ($puesto == "Administrador de Metadatos" || $puesto == "administrador" || $puesto == "analista") {echo 
				'<input type="button" onclick="cambiar.accion (12)" value="Registro de colaborador">'
				;}; ?>   
		
<!--                                 <?php if ($puesto == "administrador" || $puesto == "analista") {echo 
				'<input type="button" onclick="cambiar.accion (13)" value="Aprobar Metadato">'
				;}; ?>  Queda pendiente esta funcionalidad
<?php if ($cv_principal == 28){?> 

 Fin de botones de Subir archivos, Registro de Colaboradores, Aprobar Metadatos  

                <input type="button" onclick="cambiar.accion (11)" value="Clasificaci&oacute;n y Analista">

<?php }?>-->
   
                           
				</div>		







			  <h1>Registro de datos</h1>  
				<div id="lf1" style="display:none;">
       <!--     <div id="lf1">-->
 
                <input type="button" id="duplica" value="Duplicar Registro">
                <input type="button" id="nuevo" value="Crear Registro">
				<?php if ($cv_principal == 28) {echo 
                '<input type="button" id="borrar" value="Borrar Registro">'
				;}; ?>   
	      	
			</div> 



            </div> <!--FIN <div id="lf2" class="accordion">-->



        </div> <!--FIN <div id="lf">-->       
	</div> <!--FIN <div id="cn">-->
    <div id="rg">
    		<div id="validaError" class="error" ></div>
         	 <div style="display:block" id="div1" class="element">
             	<div id="contenido">
                    <form name="datos" method="POST" >
                      	<div id="autores">Autores: 		<?php  global $id;  tabla("x_origin","30px",$id , $cv_principal,"Autores"); ?>  </div><br />
							<table id="tabla_1" width="869">
                            	<tr> 
                                	<td width="180">&nbsp;</td>
									<td colspan="5" align="center"> 
                                            <?php
                                                 if( isset( $_POST['actualiza'] ) && $_POST['actualiza'] != '' ){echo "<font color=\"green\"><ul id=\"msgs_actualiza\">".$_POST['msgs_actualiza']."</ul></font>"; }
                                                 if( isset( $_POST['error'] ) && $_POST['error'] != '' ) 		{echo "<font color=\"red\"><ul id=\"msgs_actualiza\">".$_POST['msgs_error']."</ul></font>";       }
                                            ?>
                                                          
                                    </td>
                              </tr>
<p class="txtN1"><b>Información básica</b></p>
<br />
<h3>Datos Generales</h3>
                                 <tr >
                                    <td>T&iacute;tulo del mapa:</td>
                                    <td colspan="6"><?php 	$tooltipTitulo = "Título del mapa, el cual se motrará en el Geoportal. Aparece de forma automática al comenzar a editar, y corresponde al nombre del registro que dimos de alta.";
                                                 global $id; genera("c_nombre","extenso",$id , $cv_principal , "txt" , $tooltipTitulo);?></td>
                                 </tr>
                                 <tr >
                                    <td>Nombre del archivo:</td>
                                    <td colspan="6"><?php  	$tooltipNomArchivo = "Nombre del dato geoespacial o capa digital.Nombre del archivo que corresponde al dato geoespacial (capa digital). Este nombre no debe tener más de once caracteres y debe ser escrito en mayúsculas. Y debe contener en el sufijo las letras de la proyección. Por ejemplo: FNNGA01GW.)"; 
                                                 global $id;  genera("c_cobertura","extenso",$id , $cv_principal , "txt" , $tooltipNomArchivo); ?></td>
                                 </tr>
                                 <tr valign="top">
                                   	<td>Fecha de ingreso:</td>
                                    <td width="125"><?php 	$tooltipFechaIngres = "Fecha de captura de metadato";
                                                      		global $id;  genera("c_fecha_inicial","corto",$id , $cv_principal, "calendario" , $tooltipFechaIngres); ?></td>
                                                            
                                    <td width="166">Fecha de actualización:</td>
                                    <td width="125"><?php 	$tooltipFechaAct = "Fecha en la que se realiza una actualización o un duplicado del metadato. Ésta, en un principio, será la misma que la fecha de ingreso. Solo se modificará si se efectúa una actualización en el dato geoespacial, como la eliminación o adición de elementos geográficos, o eliminación o adición de atributos, por ejemplo. Nunca en los casos en los que se reinicie la edición de un registro por no haberse terminado o por correcciones ortográficas o de redacción del metadato.";
                                                      		global $id;  genera("c_fecha","corto",$id , $cv_principal, "calendario" , $tooltipFechaAct);?></td>
                                    <td width="120">Versi&oacute;n FGDC:</td>
                                    <td width="125" colspan="2"><?php $tooltipVerFGDC = "Versión del estándart de metadato geoespacial en base de la Federal Geographic Data Committee (FGDC). Se sugiere que sea 2.";
                                                                  global $id;  genera("c_version","corto",$id , $cv_principal, "numeros" , $tooltipVerFGDC);?></td>
            					</tr>
                           	</table>
                          	<table width="869">
                                <tr> 
                                	<td colspan="6"><h3>Cita de la informaci&oacute;n</h3></td>
                              	</tr>
                                <tr>
                                    <td width="180">Institución responsable:</td>
                                    <td colspan="6"><?php 	$tooltipInsti = "Es la institución responsable de publicar el dato geoespacial y puede ser la institución donde labora el responsable del proyecto, o bien la CONABIO. Queda a criterio del autor o autores la designación de dicha institución.";
                                                      		global $id;  genera("c_publish","extenso",$id , $cv_principal , "txt", $tooltipInsti); ?></td>
                              	</tr>
                                <tr>
                                    <td>Siglas de la instituci&oacute;n:</td>
                                    <td colspan="6"><?php 	$tooltipSigla = "Siglas de la institución designada por el autor o autores como la institución responsable de la publicación"; 
                                                      		global $id;  genera("c_publish_siglas","extenso",$id , $cv_principal , "txt" , $tooltipSigla);?></td>
                                </tr>
                                <tr>
                                     <td rowspan="3">Lugar de publicaci&oacute;n:</td>
                                     <td width="150">País:</td>
                                     <td width="15">&nbsp;</td>
                                     <td width="150">Estado:</td>
                                     <td width="15">&nbsp;</td>
                                     <td width="150">Municipio:</td>
                                     <td width="30">&nbsp;</td>
                                     <td width="150" colspan="2">Localidad:</td>
                                </tr>
                                <tr>
                                  <td><?php global $id;  selects("pais","147px",$id , $cv_principal); ?></td> 
                                  <td>&nbsp;</td>
                                  <td><?php global $id;  selects("estado","147px",$id , $cv_principal); ?></td>
                                  <td>&nbsp;</td>
                                  <td><?php global $id;  selects("municipio","147px",$id , $cv_principal); ?></td>
                                  <td>&nbsp;</td>
                                  <td colspan="2"><?php global $id;  selects("localidad","147px",$id , $cv_principal); ?></td>
                                </tr>
                                <tr>
                                     <td colspan="6"><div id="OTRO"  style="display: none;" class="element">
									 <?php  
									 		$tooltipOtro = ""; 
									 		global $id;  genera("c_pubplace","extenso",$id , $cv_principal , "txt", $tooltipOtro); ?> </div></td>
                              </tr>
                                 <tr>
                                    <td>Fecha de publicación:</td>
                                    <td><?php  	$tooltipFechaPub = "Fecha de elaboración o modificación de dato geoespacial";
                                          		global $id;  genera("c_pubdate","corto",$id , $cv_principal , "calendario" , $tooltipFechaPub); ?></td>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Versión:</td>
                                    <td><?php 	$tooltipVersion = "Es sinónimo de edición y como sucede con un libro la primera publicación corresponderá a la primera edición, por lo que el valor de este campo dependerá de la edición del dato geoespacial que se está publicando. Si es de primera vez, el valor será 1.";
                                          		global $id;  genera("c_edition","corto",$id , $cv_principal , "txt" , $tooltipVersion);  ?></td>
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
                                    <td><?php  	$tooltipClave = "Clave de proyecto asignada por CONABIO";
                                          		global $id;  genera("c_clave","corto",$id , $cv_principal , "txt", $tooltipClave);  ?> </td>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                
                                
                                 <tr valign="top">
                                     <td>Descripción del metadato:</td>
                                     <td colspan="6"><?php  $tooltipDescMetad = "Información complementaria a la cita del dato geoespacial";
                                                        	global $id;  genera("c_issue","95px",$id , $cv_principal , "txtarea", $tooltipDescMetad); ?></td>
                                 </tr>
                                 <tr valign="top">
                                     <td>Resumen:</td>
                                     <td colspan="6"><?php 	$tooltipResum = "Descripción breve del contenido, área cubierta y tema que representa el dato"; 
                                                       		global $id;  genera("c_resumen","95px",$id , $cv_principal , "txtarea" , $tooltipResum); ?></td>
                                 </tr>
                                 <tr valign="top">
                                     <td>Abstract:</td>
                                     <td colspan="6"><?php 	$tooltipAbst = "(Resumen en inglés) Opcional.";
                                                      		global $id;  genera("c_abstract","95px",$id , $cv_principal , "txtarea", $tooltipAbst);  ?></td>
                                 </tr>

<tr valign="top">
                                     <td>Cita:</td>
                                     <td colspan="6"><?php 	$tooltipCita = "Cita";
                                                      		global $id;  genera("c_cita","95px",$id , $cv_principal , "txtarea", $tooltipCita);  ?></td>
                                 </tr>



                                 <tr valign="top">
                                     <td>Objetivos generales:</td>
                                     <td colspan="6"><?php 	$tooltipObje = "Propósito de la creación del dato"; 
                                                       		global $id;  genera("c_objetivo","95px",$id , $cv_principal , "txtarea", $tooltipObje); ?></td>
                                 </tr>
                                 <tr valign="top">
                                     <td>Datos complementarios:</td>
                                     <td colspan="6"><?php 	$tooltipDatComp = "Información complementaria a cerca del dato"; 
                                                       		global $id;  genera("c_datos_comp","95px",$id , $cv_principal , "txtarea", $tooltipDatComp); ?></td>
                                </tr>
                         	</table>
                            <table width="869">
                            	<tr>
                                  	<td width="279">Tiempo comprendido:</td>
                                  	<td width="30">del: </td>
                                    <td width="138"><?php $tooltipTiempoB = "Información acerca del tiempo que se tomó para elaborar el dato geoespacial."; global $id;  genera("c_tiempo","corto",$id , $cv_principal , "calendario", $tooltipTiempoB); ?></td>
                                  	<td width="30">al:</td>
                                  	<td width="138"><?php $tooltipTiempoC = "Información acerca del tiempo que se tomó para elaborar el dato geoespacial."; global $id;  genera("c_tiempo2","corto",$id , $cv_principal , "calendario",  $tooltipTiempoC); ?></td>
                                  	<td width="226" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                  	<td >Nivel de avance:</td>
                                    <td colspan="6"> <?php 	$tooltipNive = "Grado de avance del dato geoespacial con base en los siguientes vocablos: planeado, en proceso o completo."; 
                                                       		global $id;  genera("c_avance","extenso",$id , $cv_principal , "txt" , $tooltipNive); ?> </td>
                                </tr>
                                <tr>
                                  	<td>Mantenimiento:</td>
                                  	<td colspan="6"> <?php  $tooltipMante = "Frecuencia de actualización del dato"; 
                                                       		global $id;  genera("c_mantenimiento","extenso",$id , $cv_principal, "txt" , $tooltipMante);  ?> </td>
                                </tr>
                                <tr>
                                  	<td>Tama&ntilde;o del dato geoespacial en MB: </td>
                                  	<td colspan="6"> <?php 	$tooltipTamañ = "Tamaño en megabytes del o los archivos que contiene el dato"; 
                                                        	global $id;  genera("c_tamano","extenso",$id , $cv_principal, "numeros" , $tooltipTamañ); ?> </td>
                                </tr>
                                <tr>
                                  	<td>Formato del dato geoespacial: </td>
                                  	<td colspan="6"> <?php 	$tooltipFormat = "Formato digital correspondiente a los lineamientos cartográficos estipulados por CONABIO"; 
                                                        	global $id;  genera("c_geoform","extenso",$id , $cv_principal, "txt" , $tooltipFormat); ?> </td>
                                </tr>
                                <tr>
                                  	<td>Ligas www:</td>
                                  	<td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                  	<td colspan="7"><?php  global $id;  tabla("l_liga_www","100px",$id , $cv_principal ,"Ligas_www"); ?></td>
                                 <tr>
                                    <td colspan="6">

                        <input type = "submit" value = "Guardar" id="datos" onclick = "this.form.action = 'guardar.php?hoja=datos&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'" />


 </td>
                                </tr>
       </tr>
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
                                    <td>&Aacute;rea geogr&aacute;fica:</td>
                                    <td colspan="3"><?php  // global $id;  genera("c_area_geo","100px",$id , $cv_principal , "txtarea"); ?></td>
                                </tr>
                                <tr >
                                    <td colspan="4"><h3>Coordenadas del extremo:</h3></td>
                                </tr>
                                <tr >
                                   	<td>Coordenadas del extremo oeste:</td>
                                    <td width="400"><?php // global $id;genera("c_oeste","corto",$id , $cv_principal, "numeros");?></td>
                                   	<td width="203" colspan="2">&nbsp;</td>
                        		</tr>
                                <tr >
                                   <td>Coordenadas del extremo este:</td>
                                   <td><?php // global $id;genera("c_este","corto",$id , $cv_principal, "numeros");?></td>
                                   <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr >
                                   <td>Coordenadas del extremo norte:</td>
                                   <td><?php // global $id;genera("c_norte","corto",$id , $cv_principal, "numeros");?></td>
                                   <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr >
                                   <td>Coordenadas del extremo sur:</td>
                                   <td><?php // global $id;genera("c_sur","corto",$id , $cv_principal, "numeros");?></td>
                                   <td colspan="2">&nbsp;</td>
                                </tr>
                           </table>
                    </form>
                </div>
             </div>
             <div id="div3"  class="element">
                <iframe name="div_3"  ></iframe>
                <div id="contenido"> 
                    <form name="datos" method="POST" target="div_3">
                        <input type = "submit" value = "Guardar"  id="restricciones" onclick = "this.form.action = 'guardar.php?hoja=restricciones&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr>
                                	<td>&nbsp;</td>
                                    <td>&nbsp;</td>
                            	</tr>
                                <tr>
<p class="txtN1"><b>Información básica</b></p>
                                   	<td colspan="2"><h3>Restricciones</h3></td>
                                </tr>
                                <tr>
                                   	<td width="107">Acceso:</td>
                                   	<td><?php  	$tooltipAcces = "Restricciones y prerrequisitos legales del acceso al dato";
                                          		global $id;genera("c_acceso","extenso",$id , $cv_principal , "txt" , $tooltipAcces);?></td>
                                </tr>
                                <tr>
                                   	<td>Uso:</td>
                                   	<td><?php 	$tooltipUso = "Restricciones y prerrequisitos legales del uso del dato";
                                          		global $id;genera("c_uso","extenso",$id , $cv_principal , "txt" , $tooltipUso);?></td>
                                </tr>
                                <tr>
                                  <td>Observaciones:</td>
                                  <td><?php $tooltipObser = "En este campo se puede agregar información adicional.";
                                        	global $id;genera("c_observaciones","extenso",$id , $cv_principal , "txt" , $tooltipObser);?></td>
                                </tr>
                           	</table>
                    </form>
                </div>
             </div>
             <div id="div4"  class="element">
                <iframe name="div_4"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_4">
                        <input type = "submit" value = "Guardar"  id="palabrasClave" onclick = "this.form.action = 'guardar.php?hoja=palabrasClave&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							 <table width="869">
                                 <tr >
                                   	<td width="107">&nbsp;</td>
                                    <td width="750">&nbsp;</td>
                        		</tr>
                                <tr valign="top">
<p class="txtN1"><b>Información básica</b></p>
                                   <td><h3>Temas:</h3>	</td>
                                   <td><?php  global $id;  tabla("m_Palabra_Clave","100px",$id , $cv_principal,"Temas",""); ?></td>
                                </tr>
                                <tr valign="top">
                                  <td><h3>Sitios:</h3></td>
                                  <td><?php  global $id;  tabla("s_Sitios_Clave","100px",$id , $cv_principal,"Sitios",""); ?></td>
                                </tr>
                           </table>
                           
                    </form>
                </div>
             </div> 
             <div id="div5"  class="element">
                <iframe name="div_5"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_5" >
                        <input type = "submit" value = "Guardar"  id="ambienteDeTrabajo" onclick = "this.form.action = 'guardar.php?hoja=ambienteDeTrabajo&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="200">&nbsp;</td>
                                    <td width="657">&nbsp;</td>
                        		</tr>
                                <tr >
<p class="txtN1"><b>Información básica</b></p>
                                   <td>Software y hardware:</td>
                                   <td><?php 	$tooltipSoft = "Programa de cómputo utilizado, incluyendo versión y equipo para elaboración del dato geoespacial";
                                        		global $id;  genera("c_software_hardware","extenso",$id , $cv_principal, "txt" , $tooltipSoft);  ?></td>
                                 </tr>
                                 <tr >
                                   <td>Sistema operativo:</td>
                                   <td><?php 	$tooltipSiste = "Nombre y versión del sistema operativo instalado en el equipo de cómputo empleado"; 
                                          		global $id;  genera("c_sistema_operativo","extenso",$id , $cv_principal, "txt" , $tooltipSiste); ?></td>
                                 </tr>
                                 <tr >
                                   <td>Requisitos t&eacute;cnicos:</td>
                                   <td><?php 	$tooltipRequis = "Especificaciones de software y hardware requerido para utilizar el dato, si es necesario"; 
                                          		global $id;  genera("c_tecnicos","extenso",$id , $cv_principal, "txt" , $tooltipRequis);  ?></td>
                                 </tr>
                                 <tr >
                                   <td>Ruta y nombre de archivo:</td>
                                   <td><?php 	$tooltipRuta = "Ruta en el que queda el archivo en el servidor de la CONABIO."; 
                                          		global $id;  genera("c_path","extenso",$id , $cv_principal, "txt", $tooltipRuta);  ?></td>
                                 </tr>
                           	</table>
                    </form>
                </div>
             </div>

             <div id="div12"  class="element">
                <iframe name="div_12"  ></iframe>

                <div id="contenido">

                    <form name="datos" method="POST" target="div_12">
                        <input type = "submit" value = "Guardar"  id="RegistroColaborador" onclick = "this.form.action = 'guardar.php?hoja=RegistroColaborador&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="200">&nbsp;</td>
                                    <td width="657">&nbsp;</td>
<p class="txtN1"><b>Cartografíá</b></p>
<br />
                                       <p class="txtN1">Registro de colaborador</p>
                        		</tr>
                                <tr >
                                   <td>Nombre</td>
                                   <td><input id="nombreColaborador" type="text" name="nombreCapturista" class="extenso"/>
</td>
                                 </tr>
                                <tr><td>Puesto</td>
                                    <td><select id="puestoColaborador" name="puestoCapturista">
                                 <?php if ($puesto == "Administrador de Metadatos") {echo 
                                 '<option value="Administrador de Metadatos">Administrador</option>
                                 <option value="capturista">Capturista</option>
                                 <option value="analista">Analista</option>';} 
                                       if ($puesto == "analista") {echo 
                                 '<option value="capturista">Capturista</option>';} ?>
                                    </select></td>
                                </tr>
 



                                <tr >
                                   <td>Login</td>
                                   <td><input id="userColaborador" type="text" name="userCapturista" class="extenso" />
</td>
                                 </tr>
                                 <tr >
                                   <td>Password</td>
                                   <td><input id="passColaborador" type="text" name="passCapturista" class="extenso" />
</td>
                                 </tr>
                                 <tr >
                                   <td>Correo</td>       <td><input id="correoColaborador" type="text" name="correoCapturista" class="extenso" />

</td>
                                 </tr>
                                <tr >
                                   <td>Tel&eacute;fono</td>
                                   <td><input type="text" name="telCapturista" class="extenso" />
</td>
                                 </tr>
                                <tr><td>Activo</td>
                                    <td><select name="activoCapturista">
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                    </select></td>
                                </tr>
                          	</table>
                    </form>
</div>
</div>


             <div id="div13"  class="element">
                <iframe name="div_13"  ></iframe>

                <div id="contenido">

                    <form name="datos" method="POST" target="div_13">
                        <input type = "submit" value = "Guardar"  id="aprobarMetadato" onclick = "this.form.action = 'guardar.php?hoja=aprobarMetadato&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="200">&nbsp;</td>
                                    <td width="657">&nbsp;</td>
                        		</tr>
                                <tr >
                                   <td>Responsable:</td>
                                   <td><?php echo $nombreUsuario; ?></td>
                                 </tr>
                                <tr><td>Puesto:</td>
                                   <td><?php echo $puesto;?></td>
                                </tr>

                                <tr><td>Fecha:</td>
                                   <td><?php $time = time(); echo date("d-m-Y (H:i:s)", $time); ?></td>
                                </tr>

                                <tr><td>Aprobar metadato:</td>
                                    <td><select name="activoCapturista">
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                    </select></td>
                                </tr>
                          	</table>
                    </form>
</div>
</div>

             <div id="div14"  class="element">

                <div id="contenido">

<div id="nameOfFile">
                                      <form>                                                  
<p class="txtN1"><b>Cartografíá</b></p>
<br />
                                       <p class="txtN1">Adjunta tu archivo: <?php echo $nameFileSession;?>.zip</p>
                                       </form>
                                      
  <form class="formulario_modulo_cbm" id="formulario_modulo_cbm" action="modulo_cbm.php"  method="post" enctype="multipart/form-data">
    <input id="boton_buscar" type="file" name="nameOfFile" accept=".zip" onclick="habilitar()">
	<input type="submit" id="boton_subir" name="boton_subir" value="Subir" access="application/zip" onclick="alert('Espera por favor, comienza la carga del archivo a los servidores de la CONABIO. En seguida coemnzará el proceso de configuración del shapefile. Proceso: 1/6')" disabled="true"  ;>                                       






<div style="padding:20px">	
  <div class="progreso">
    <div class="barra"></div >
    <div class="percentage">0%</div>
  </div>
  
  <div id="status_bar"></div>

</div>	

                                       
</div>
                                
<script src="jquery.form.js"></script>
                                       
<script>
(function() 
{
    
    var bar = $('.barra');
    var percent = $('.percentage');
    var status = $('#status_bar');
       
    $('.formulario_modulo_cbm').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
            // console.log(percentVal, position, total);
        },
        success: function() {
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
            var avance = percent.html(percentVal);
		
        },
        complete: function(xhr) {
            status.html(xhr.responseText);
//	mostrar(); //función que muestra el botón "Mostrar" en la visualización del mapa
        }
    }); 
})();       
</script>
  </form>

                                      <form>                                                  
<input id='NoOculto' style='display:block; margin-left:auto; margin-right:auto; width:270px;'  type="button" value="Mostrar Previsualización" disabled="true"> 
                                       </form>


<div id="map" class="map" ></div>
<script type="text/javascript">


var nombreDeCapa = '<?php echo $nameFileSession;?>';

if(nombreDeCapa){
    document.getElementById('NoOculto').disabled = false;
    document.getElementById('boton_buscar').disabled = false;
}


var layers = new ol.layer.Tile({
source: new ol.source.TileWMS({
url: 'http://ssig.conabio.gob.mx:2900/capas_cbm'+'/myworkspace/wms',
params: {'LAYERS': nombreDeCapa},

})});

var raster = new ol.layer.Tile({
source: new ol.source.OSM()
});

var map = new ol.Map({
layers: [raster, layers],
target: 'map',
controls:[],
view: new ol.View({
center: ol.proj.fromLonLat([-94.17,19.24]), 
zoom: 3
})
});


//Añadimos un control de zoom

//map.addControl(new ol.control.ZoomSlider()); 
//map.addControl(new ol.control.MousePosition({ numDigits: 2 }));
map.addControl(new ol.control.ScaleLine());


document.getElementById('NoOculto').onclick = function() { //Esta función hace que aparezca en cuanto se presiona el bótón. Se tiene que hacer así, sino no se ve el mapa
map.updateSize();
map.render();
map.renderSync();
}



</script>



</div>
</div>


             <div id="div15"  class="element">

                <div id="contenido">


<form>                                                  
<p class="txtN1"><b>Cartografía</b></p>
<br />
                                       <p class="txtN1">Generar Plantilla</p>
                                       </form>
                                      
  <form class="mapTemplate" id="mapTemplate" action="mapTemplate/mapTemplate.php"  method="post" enctype="multipart/form-data">
    <input type="submit" id="btn_mapTemplate" name="btn_mapTemplate" value="<?php echo $id;?>">   
                            <table width="869">
                            	<tr >
                                   	<td width="200">&nbsp;</td>
                                    <td width="657">&nbsp;</td>


<?php if($nom != $nombreUsuario){echo '<tr><td>Nombre de proyecto</td>
                                   <td><select id="nombreProy" name="nombreProy">
                                 <option value="conect_mang">conect_mang</option>
                                 <option value="jm001">jm001</option>
                                 <option value="jm002">jm002</option>
                                 <option value="jm003">jm003</option>
                                 <option value="jm004">jm004</option>
                                 <option value="jm005">jm005</option>
                                 <option value="jm006">jm006</option>
                                 <option value="jm007">jm007</option>
                                 <option value="jm008">jm008</option>
                                 <option value="jm009">jm009</option>
                                 <option value="jm010">jm010</option>
                                 <option value="jm011">jm011</option>
                                 <option value="jm013">jm012</option>
                                 <option value="jm014">jm014</option>
                                 <option value="jm015">jm015</option>
                                 <option value="jm016">jm016</option>
                                 <option value="jm017">jm017</option>
                                 <option value="jm018">jm018</option>
                                 <option value="mang01">mang01</option>
                                 <option value="jm019">jm019</option>
                                 <option value="jm022">jm022</option>
                                 <option value="jm024">jm024</option>
                                 <option value="jm025">jm025</option>
                                 <option value="jm027">jm027</option>
                                 <option value="jm031">jm031</option>
                                 <option value="jm032">jm032</option>
                                 <option value="jm033">jm033</option>
                                 <option value="jm034">jm034</option>
                                 <option value="jm035">jm035</option>
                                 <option value="jm036">jm036</option>
                                 <option value="jm037">jm037</option>
                                 <option value="jm039">jm039</option>
                                 <option value="jm040">jm040</option>
                                 <option value="jm041">jm041</option>
                                 <option value="jm042">jm042</option>
                                 <option value="jm043">jm043</option>
                                 <option value="jm044">jm044</option>
                                 <option value="jm050">jm050</option>
                                 <option value="jm052">jm052</option>
                                 <option value="jm053">jm053</option>
                                 <option value="jm055">jm055</option>
                                 <option value="jm056">jm056</option>
                                 <option value="jm057">jm057</option>
                                 <option value="jm058">jm058</option>
                                 <option value="jm061">jm061</option>
                                 <option value="jm065">jm065</option>
                                 <option value="jm068">jm068</option>
                                 <option value="jm071">jm071</option>
                                    </select></td>
                                </tr>
                                                       <tr><td>Tipo de proyecto</td>
                                   <td><select id="tipoProy" name="tipoProy">
                                 <option value="dist">Distribución</option>
                                 <option value="sitios">Sitios de recolecta</option>
                                 </tr>';

}?>
                                                       <tr><td>Software</td>
                                   <td><select id="software" name="software">
                                 <option value="arc">ArcGis</option>
                                 <option value="quantum">QuantumGis</option>
                                </tr>
 
                          	</table>
                    </form>
</div>

<form>
<p>Instrucciones:</p>
<p>1. Elige el proyecto que se te asignó.</p>
<p>2. Genera la plantilla. Ésta se descargará en tu máquina.</p>
<p>3. En tu QuantumGis (o ArcGis) abre tu consula de Python y ejecuta el script que acabas de descargar. Solo escribe correctamente el código que se muestra como en el ejemplo de abajo:</p>
</form>
<form>

<?php echo "<p class = 'txtN2'>execfile(r'C://Users//".$nom."//Desktop//nombre_del_archivo_que_descargaste.py')</p>" ?>
<p></p>
<p></p>
</form>




</div>

<!------------------------------Cierra zona de Generar xml    ---------------------->

             <div id="div16"  class="element">

                <div id="contenido">


<form>                                                  
<p class="txtN1"><b>Cartografía</b></p>
<br />
                                       <p class="txtN1">Generar XML</p>
                                       </form>
                                      
  <form class="mapTemplate" id="mapTemplate" action="map_xml/map_xml.php"  method="post" enctype="multipart/form-data">
  <input type="submit" id="btn_map_xml" name="btn_map_xml" value="<?php echo $id;?>">   
                    
<p>Mediante esta interfaz puedes descargar los tres archivos xml que acompañan la cartografía</p>
<p>que será incluida en el Geoportal de la CONABIO.</p>
<p>INEGI</p>
<p>xml 0.2</p>
<p>xml 3.0</p>


</form>
</div>


</div>

<!------------------------------Cierra zona de xml---------------------->



<!------------------------------Cierra zona de Generar sld    ---------------------->

             <div id="div17"  class="element">

                <div id="contenido">
                <div id="paleta_1">


<form>                                                  
<p class="txtN1"><b>SLD</b></p>
<br />
  <p class="txtN1">Generar SLD</p>
                                       </form>
                                      
  <form class="mapTemplate" id="mapTemplate" action="map_sld/map_xml.php"  method="post" enctype="multipart/form-data">
  <input type="submit" id="btn_map_xml" name="btn_map_xml" value="<?php echo $id;?>">   
                    

</form>
<div>
   <select id="primary">
      <option value="color">Color</option>
      <option value="country">Country</option>
   </select> 
   <select id="secondary">
   </select>
</div>


















<?php

$mapa = "/var/www/html/modulo_cbm/files/".$nameFileSession."/".$nameFileSession.".shp";
echo "<pre>";
try {
$ShapeFile = new ShapeFile($mapa);




////////////
    echo "<form>                                                  
<p class='txtN2'><b>Access a specific record</b></p>
                                       </form>";
//echo "esto es: ".$_GET['1']; 
// Check if provided index is valid
//if ($_GET['COV_ID'] > 0 && $_GET['COV_ID'] <= $ShapeFile->getTotRecords()) {
if (10<= $ShapeFile->getTotRecords()) {
    // Set the cursor to a specific record
//$ShapeFile->setCurrentRecord($_GET['COV_ID']);
$ShapeFile->setCurrentRecord(10);
// Read only one record
$ret = $ShapeFile->getRecord();
} else {
$ret = "Index not valid!";
}

print_r($ret);


//////////


 echo "Shape Type : ";
    echo $ShapeFile->getShapeType()." - ".$ShapeFile->getShapeType(ShapeFile::FORMAT_STR);
    echo "\n\n";
        
// Get number of Records
echo "Records : ";
echo $ShapeFile->getTotRecords();
echo "\n\n";

// Get Bounding Box
echo "Bounding Box : ";
print_r($ShapeFile->getBoundingBox());
echo "\n\n";

// Get DBF Fields
echo "DBF Fields : ";
print_r($ShapeFile->getDBFFields());
echo "\n\n";





////////






$valores = $ShapeFile->getDBFFields();
    $tabla = "";
for ($i = 0; $i < sizeof($valores); $i++) {
    $fila = (string)$valores[$i]['name'];
        $tabla .= "<tr><td style='border: 1px solid blue';>".$fila."</td><td style='border: 1px solid blue';></td></tr>";
}


//echo $tabla;
echo "<table style='border: 1px solid blue; padding: 15px; background-color: #e5efff;'><tr><th>Atributos</th><th>Color</th></tr>".$tabla."</table>";
///////////////////
    echo "<form>                                                  
<p class='txtN2'><b>Get shapefile info</b></p>
                                       </form>";

echo "Shape Type : ";
    echo $ShapeFile->getShapeType()." - ".$ShapeFile->getShapeType(ShapeFile::FORMAT_STR);
    echo "\n\n";
        
// Get number of Records
echo "Records : ";
echo $ShapeFile->getTotRecords();
echo "\n\n";

// Get Bounding Box
echo "Bounding Box : ";
print_r($ShapeFile->getBoundingBox());
echo "\n\n";

// Get DBF Fields
echo "DBF Fields : ";
print_r($ShapeFile->getDBFFields());
echo "\n\n";




//////////////////////////
    echo "<form>                                                  
<p class='txtN2'><b>Use foreach iterator</b></p>
                                       </form>";


    
// Sets default return format
$ShapeFile->setDefaultGeometryFormat(ShapeFile::GEOMETRY_WKT | ShapeFile::GEOMETRY_GEOJSON_GEOMETRY);

// Read all the records using a foreach loop
foreach ($ShapeFile as $i => $record) {
if ($record['dbf']['_deleted']) continue;
// Record number
echo "Record number: $i\n";
// Geometry
print_r($record['shp']);
// DBF Data
print_r($record['dbf']);

}






/////////////////////////////

} catch (ShapeFileException $e) {
    echo "</pre>";
    echo "<form>                                                  
<p class='txtN2'><b>El shape que estás solicitando no está disponible en el servidor, sólo está en el Geoserver. Por lo pronbto no se puede generar el SLD.</b></p>
                                       </form>";
}
echo "</pre>";
         ?>









<script>
 
 
 
 var svg = d3.select('#div17').append('svg')
                            .attr('width',320)
                            .attr('height',600);

 var x1 = 160,
     y1 = 150;  
     var c_color ;
     var color_is_choosed = false;
     var colors = [
     '#ff4422','#ee1166' ,'#9911bb' ,'#6633bb' ,'#3344bb' ,'#1199ff','#00aaff',
     '#00bbdd','#009988','#44bb44','#88cc44','#ccdd22','#ffee11','#ffcc00','#ff9900','#ff5500',
     '#775544','#999999','#828080','#444'];
      var palet= d3.select('svg');


 function deg_color(color){
  
  return d_color = [
     d3.hsl(color).darker(0.5),
     d3.hsl(color).darker(0.3),
     color,
     d3.hsl(color).brighter(0.5),
     d3.hsl(color).brighter(1)
   ]

}
 function draw_palet(){

    
    var palet_container = d3.select('svg').append('g').attr('id','palet_container');

     for(var i= 0; i<colors.length;i++){

      palet_container.append('g')
                     .attr('id','graphe_container'+i)
                     .attr('data-color',colors[i])
                     .attr('class','graphe_container');
      

      drawRect('#graphe_container'+i,x1,y1,5,5,145,20,'#fff','#ccc');                                  
      drawRect('#graphe_container'+i,x1+25,y1,4,4,20,20,deg_color(colors[i])[0],'','','color_rect color_rect0');
      drawRect('#graphe_container'+i,x1+50,y1,4,4,20,20,deg_color(colors[i])[1],'','','color_rect color_rect1'); 
      drawRect('#graphe_container'+i,x1+75,y1,4,4,20,20,deg_color(colors[i])[2],'','','color_rect color_rect2'); 
      drawRect('#graphe_container'+i,x1+100,y1,4,4,20,20,deg_color(colors[i])[3],'','','color_rect color_rect3');
      drawRect('#graphe_container'+i,x1+125,y1,4,4,20,20,deg_color(colors[i])[4],'','','color_rect color_rect4');
        
                    
     }
     drawButton();
      d3.selectAll('.color_rect').on('mouseover',mouseover);
      d3.selectAll('.color_rect').on('click',mouseClick);
 }          

 function mouseover(){
    var el = d3.select(this);
    var s_color = el.attr('fill');
                               
    setColor('#show_circle',s_color );
    d3.select('#color_code').text(s_color).attr('fill',s_color).attr('stroke',s_color); 
}
 function mouseClick(){
  
       p_color =d3.select(this.parentNode).attr('data-color');
       d3.select('#button_show_color').attr('fill',p_color);

       c_color= d3.select(this).attr('fill');
       choosed_palet.addColor(c_color);

}  

 function setColor(el,color){

    d3.select(el).transition().duration('200').attr('fill',color);
 }
 function drawGrapheText(x,y,id=null,value,s_color){
   var graphe = d3.select('svg').append('g').attr('id','text_graphe');
  
        graphe.append('text')
              .attr('id',id)
              .attr('x',x)
              .attr('y',y)
              .attr('stroke',s_color)
              .text(value);
        graphe.append('line')
              .attr('x1',x)
              .attr('y1',y+5)
              .attr('x2',x-20)
              .attr('stroke',s_color)
              .attr('y2',y+20);
       graphe.append('line')
              .attr('x1',x)
              .attr('y1',y+5)
              .attr('x2',x+50)
              .attr('stroke',s_color)
              .attr('y2',y+5);
 }



 function drawCircle(container,x,y,r,color=null,id=null){
     
    
   var ele = d3.select('svg').append('g');
   
   ele.append('circle')
             .attr('fill',color)
             .attr('id',id)
             .attr('cx',x)
             .attr('cy',y)
             .attr('stroke','#ccc')
             .attr('r',r);
  };

   function drawRect(container,x,y,rx,ry,width,height,color=null,stroke=null,id=null,classed=null){
     var ele;
      if(container == 'rect'){
        ele = d3.select('svg').append('g');
      }else{
        ele = d3.select('svg').select(container);
      }
      ele.append('rect') 
               .attr('id',id)
               .attr('class',classed)
               .attr('fill',color)
               .attr('stroke',stroke)
               .attr('x',x)
               .attr('y',y)
               .attr('rx',rx)
               .attr('ry',ry)
               .attr('width',width)
               .attr('height',height);
  }
  function drawButton(){

         
        drawCircle('svg',x1,y1+10,15,colors[colors.length-1],id="button_show_color");
         drawCircle('svg',x1,y1+10,10,'orange');
         drawCircle('svg',x1,y1+10,9,'white',id="button");
         d3.select('#button').on('click',buttonClicked);
  }

function buttonClicked(){
          // toggle_color('#button');
           toggle_palet();
           toggle_cirle();
           toggle_text_graphe();
           show_choosed_bar();
     };




function show_choosed_bar(){
  var last_g= colors.length-1;
  var last_color = colors[colors.length-1];
   var p_color = d3.select('#button_show_color').attr('fill');
   
    if( palet.attr('data-palet')=='on'){
      d3.selectAll('#graphe_container'+last_g).attr('data-color',last_color);
         for(var i = 0; i < 5;i++){
         
         d3.selectAll('#graphe_container'+last_g+'>.color_rect'+i).attr('fill',deg_color(last_color)[i]);
         
       }
    }else{
       d3.selectAll('#graphe_container'+last_g).attr('data-color',deg_color(p_color)[2]);
       for(var i = 0; i < 5;i++){
        d3.selectAll('#graphe_container'+last_g+'>.color_rect'+i).attr('fill',deg_color(p_color)[i]);
      }
    }
  
  
}


  



function toggle_color(el){
        var element = d3.select(el);
        var color = d3.select(el).attr('fill');
        if(color == 'white'){
         element.attr('fill','orange');
        }else{
          element.attr('fill','white');
        }
}

 drawCircle('circle',x1,y1+230,50,'#ccc',id='show_circle');
 drawGrapheText(x1+70,y1+200,'color_code','#cccccc','#ccc');

function toggle_cirle(){
 
       var palet= d3.select('svg'),
       circle = d3.select('#show_circle');

     if( palet.attr('data-palet')=='on'){
          circle.transition().duration(500).attr('r',50).attr("transform", "translate(0,0)");;
     }else{
          circle.transition().duration(500).attr('r',100).attr("transform", "translate(0," + -75 + ")");
     }
}
function toggle_text_graphe(){
 
       var palet= d3.select('svg'),
       text_graphe = d3.select('#text_graphe');

     if( palet.attr('data-palet')=='on'){
         text_graphe.transition().duration(500).attr("transform", "translate(0,0)");
     }else{
         text_graphe.transition().duration(500).attr("transform", "translate(0," + -150 + ")");
     }
}
function open_palet(){
  var step= 18;
    d3.select('svg').attr('data-palet','on');
   
     for(var i = 0; i <colors.length ;i++){
       d3.select('#graphe_container'+i)
       .transition()
      .duration(500).attr("transform", 'rotate('+i*step+' )');
    }

}
function close_palet(){

 var el =d3.selectAll('.graphe_container');
     
      el.transition()
      .duration(500)
      .attr("transform", 'rotate('+-90+')' );
 
       
}
function toggle_palet(){
    
     if( palet.attr('data-palet')=='on'){
         close_palet();
          
         palet.attr('data-palet','off');
     }else{
         open_palet();
         palet.attr('data-palet','on');
     }
}



draw_palet();
open_palet();







var choosed_palet = {
  container:d3.select('svg').append('g').attr('class','choosed_palet'),
  x:50,
  y:450,
  width:30,
  height:10,
  max_length:7,
  color :[],
 
  addColor:function(color){
    if(this.color.length<this.max_length){
       this.color.push(color);
      this.draw();
    }
   
  },
  removeColor:function(index){
    
   
    this.color.splice(index,1);
    
   this.draw();
  },
  draw:function(){
   this.container.html('');
    for(var i = 0; i <this.color.length;i++){
      
      this.container.append('rect').attr('x',this.x+(i*this.width))
                                  .attr('y',this.y)
                                  .attr('data_color_index',i)
                                  .attr('width',this.width)
                                  .attr('height',this.height)
                                  .attr('fill',this.color[i])
                                  .on('mouseover',mouseover)
                                  .on('dblclick',function(){ 
                                     var el=  d3.select(this);
                                     var index = el.attr("data_color_index");
                                    choosed_palet.removeColor(index);
                                    el.remove();

                                });
    }
  }
  
}

</script>

</div>
</div>

</div>

<!------------------------------Cierra zona de sld---------------------->





             <div id="div6"  class="element">
                <iframe name="div_6"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_6">
                        <input type = "submit" value = "Guardar"  id="calidadDeDatos" onclick = "this.form.action = 'guardar.php?hoja=calidadDeDatos&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="230">&nbsp;</td>
                                    <td width="627">&nbsp;</td>
                        		</tr>
                                <tr valign="top">
<p class="txtN1"><b>Calidad de los Datos</b></p>
                                   	<td>Metodolog&iacute;a:</td>
                                   	<td><?php  	$tooltipMetodo = "Tipo de investigación según el lugar de aplicación para obtener o generar los datos";
                                          		global $id;  genera("c_metodologia","extenso",$id , $cv_principal, "txt" , $tooltipMetodo); ?></td>
                                 </tr>
                                 <tr valign="top">
                                   	<td>Descripci&oacute;n de la metodolog&iacute;a:</td>
                                   	<td><?php  	$tooltipDescMet = "Se describe, de manera general, el o los métodos empleados en el proceso de elaboración del dato ";
                                          		global $id;  genera("c_descrip_metodologia","95px",$id , $cv_principal, "txtarea", $tooltipDescMet);  ?></td>
                                 </tr>
                                 <tr valign="top">
                                   	<td>Descripci&oacute;n del proceso:</td>
                                   	<td><?php  	$tooltipDescProc ="Describe ampliamente cómo se hizo el dato, explicando lo realizado en cada uno de los métodos empleados";
                                          		global $id;  genera("c_descrip_proceso","90px",$id , $cv_principal, "txtarea" , $tooltipDescProc);?></td>
                                 </tr>
                                 <tr >
                                   	<td colspan="2"><h3>Referencia de los datos originales</h3></td>
                                 </tr>
                           	</table>
                            <?php   global $id;  tabla_d("corto",$id , $cv_principal, "Datos" ); ?>
                	</form>
               	</div>
             </div>
             <div id="div7"  class="element">
                <iframe name="div_7"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_7">
                        <input type = "submit" value = "Guardar"  id="taxonomia" onclick = "this.form.action = 'guardar.php?hoja=taxonomia&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr >
                                   	<td width="230">&nbsp;</td>
                                    <td width="627">&nbsp;</td>
                        		</tr>
                                 <tr >
<p class="txtN1"><b>Calidad de los Datos</b></p>
                                   	<td colspan="2"><h3>TAXONOM&Iacute;A:</h3></td>
                                 </tr>
                                 <tr >
                                   	<td width="230"></td>
                                    <td width="627">&nbsp;</td>
                        		</tr>
                           	</table>
                            
                            <?php  global $id;  tabla_t("extenso","corto",$id , $cv_principal, "Taxonom&iacute;a"); ?>
                            
                	</form>
               	</div>
             </div>
             <div id="div8"  class="element">
                <iframe name="div_8"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_8">
                        <input type = "submit" value = "Guardar"  id="estructuraRaster" onclick = "this.form.action = 'guardar.php?hoja=estructuraRaster&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869">
                            	<tr>
                                	<td>&nbsp;</td>
                                    <td width="697">&nbsp;</td>
   								</tr>
                                <tr>
                                   	<td colspan="2"><h3>Informaci&oacute;n espacial: </h3> </td>
                                </tr>
                                <tr>
                                   	<td width="160">Estructura del dato:</td>
                               	  <td><?php  // global $id;  genera("c_estructura_dato","extenso",$id , $cv_principal, "txt"); ?></td>
                                </tr>
                                <tr>
                                   	<td>Tipo del dato:</td>
                                   	<td><?php  // global $id;  genera("c_tipo_dato","extenso",$id , $cv_principal, "txt"); ?></td>
                                </tr>
                                <tr>
                                  <td>N&uacute;mero total del dato:</td>
                                  <td><?php  // global $id;  genera("c_total_datos","extenso",$id , $cv_principal, "numeros"); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2"><h3>Si la estructura es raster : </h3></td>
                                </tr>
                           	</table>
                            <table width="962" border="10">
                            	<tr>
                                  	<td width="150"><p>N&uacute;mero de renglones:</p></td>
                                  	<td width="150"><p>N&uacute;mero de columnas:</p></td>
                                  	<td width="150"><p>Tama&ntilde;o del pixel de X en metros:</p></td>
                                  	<td width="150"><p>Tama&ntilde;o del pixel de Y en metros:</p></td>
                                  	<td width="150"><p>Coordenada X del origen del raster:</p></td>
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
                <iframe name="div_9"  ></iframe>
             		<div id="contenido">
                    <form name="datos" method="POST" class="formulario" target="div_9" >
                        <input type = "submit" value = "Guardar"  id="proyeccion" onclick = "this.form.action = 'guardar.php?hoja=proyeccion&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
<table width="867" border="0">
  <tr>
    <td ><input type="button" value="Descargar ejecutable" id="descarga"/></td>
    <td colspan="2" ><input name="userfile" type="file" class="box" id="userfile" /></td>
    <td align="center">&nbsp;</td>
<p class="txtN1"><b>Información espacial y atributos</b></p>
<br />
  </tr>
  <tr>
    <td colspan="2" ><h3>Información espacial:</h3></td>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr  valign="top">
    <td width="237">Estructura del dato:</td>
    <td width="272"><?php  $tooltipEstruc ="Se especifica la estructura del dato geoespacial (Vector o Raster).";
								  			  global $id;  genera("c_estructura_dato","extenso",$id , $cv_principal, "txt",$tooltipEstruc); ?></td>
    <td width="145">Archivos shp</td>
    <td width="195"><select name="selectVector" id="selectVector">
      <option value="">Seleccione un archivo</option>
    </select></td>
  </tr>
  <tr valign="top">
    <td>Tipo del dato:</td>
    <td><?php  	$tooltipDato = "Representado por: puntos, líneas y polígonos (si la estructura es vectorial); y píxel (si la estructura es raster).";
												 global $id;  genera("c_tipo_dato","extenso",$id , $cv_principal, "txt", $tooltipDato); ?></td>
    <td>Archivos raster</td>
    <td><select name="selectTif" id="selectTif">
      <option value="">Seleccione un archivo</option>
    </select></td>
  </tr>
  <tr valign="top">
    <td>N&uacute;mero total del dato:</td>
    <td><?php  	$tooltiNumpDato = "Total de elementos si es vectorial, y si es raster se debe multiplicar las columnas por renglones.";
								  				 global $id;  genera("c_total_datos","extenso",$id , $cv_principal, "numeros", $tooltiNumpDato); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" ><h3>Coordenadas del extremo:</h3></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="237">Coordenadas del extremo oeste:</td>
    <td width="272"><?php 	$tooltipOeste="Coordenadas extremas del área geográfica que ocupa el dato geoespacial (oeste, este, norte y sur) y definido por el programa utilizado para su elaboración. Los valores indican la extensión del dato sobre la superficie de la tierra mediante coordenadas geográficas (grados decimales). Ejemplo: Oeste: -117.12; Este: -103.08; Norte: 32.64; y Sur: 22.87.l";
															 global $id;genera("c_oeste","corto",$id , $cv_principal, "numeros", $tooltipOeste);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Coordenadas del extremo este:</td>
    <td><?php 	$tooltipEste = "Coordenadas extremas del área geográfica que ocupa el dato geoespacial (oeste, este, norte y sur) y definido por el programa utilizado para su elaboración. Los valores indican la extensión del dato sobre la superficie de la tierra mediante coordenadas geográficas (grados decimales). Ejemplo: Oeste: -117.12; Este: -103.08; Norte: 32.64; y Sur: 22.87.l";
								   				 global $id;genera("c_este","corto",$id , $cv_principal, "numeros", $tooltipEste);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Coordenadas del extremo norte:</td>
    <td><?php	$tooltipNorte="Coordenadas extremas del área geográfica que ocupa el dato geoespacial (oeste, este, norte y sur) y definido por el programa utilizado para su elaboración. Los valores indican la extensión del dato sobre la superficie de la tierra mediante coordenadas geográficas (grados decimales). Ejemplo: Oeste: -117.12; Este: -103.08; Norte: 32.64; y Sur: 22.87.l";
								   				 global $id;genera("c_norte","corto",$id , $cv_principal, "numeros", $tooltipNorte);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Coordenadas del extremo sur:</td>
    <td><?php 	$tooltipSur="Coordenadas extremas del área geográfica que ocupa el dato geoespacial (oeste, este, norte y sur) y definido por el programa utilizado para su elaboración. Los valores indican la extensión del dato sobre la superficie de la tierra mediante coordenadas geográficas (grados decimales). Ejemplo: Oeste: -117.12; Este: -103.08; Norte: 32.64; y Sur: 22.87.l";
								   				 global $id;genera("c_sur","corto",$id , $cv_principal, "numeros", $tooltipSur);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" ><h3>Proyecci&oacute;n cartogr&aacute;fica:</h3></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Datum horizontal:</td>
    <td><?php   $tooltipHoriz = "WGS84, de acuerdo con los lineamientos cartográficos."; global $id;  genera("c_datum","30px",$id , $cv_principal , "txt",  $tooltipHoriz); ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Nombre del elipsoide:</td>
    <td><?php   $tooltipElip = "WGS84, de acuerdo con los lineamientos cartográficos."; global $id;  genera("c_elipsoide","30px",$id , $cv_principal , "txt", $tooltipElip); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Proyecci&oacute;n cartogr&aacute;fica</td>
    <td><?php   $tooltipCar = "Este dato tiene que ser un número entero";  global $id;  genera("c_id_proyeccion","10px",$id , $cv_principal, "txt",  $tooltipCar) ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top">
    <td>&Aacute;rea geogr&aacute;fica:</td>
    <td colspan="3"><?php 	$tooltipGeografica = "Descripción textual breve de la distribución geográfica del dato geoespacial";
															 global $id;  genera("c_area_geo","100px",$id , $cv_principal , "txtarea", $tooltipGeografica); ?></td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" ><h3>Si la estructura es raster :</h3></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>N&uacute;mero de renglones:</td>
    <td><?php  $tooltipNumReng = "Número total de renglones a lo largo del eje Y."; global $id;  genera("r_nun_renglones","13px",$id , $cv_principal, "numeros",$tooltipNumReng); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>N&uacute;mero de columnas:</td>
    <td><?php  $tooltipNumCol = "Número total de columnas a lo largo del eje X."; global $id;  genera("r_num_columnas","13px",$id , $cv_principal, "numeros",$tooltipNumCol); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tama&ntilde;o del pixel de X en metros:</td>
    <td><?php  $tooltipPixX = "Resolución espacial, en metros, del pı́xel sobre el eje X."; global $id;  genera("r_pixel_X","15px",$id , $cv_principal, "numeros",$tooltipPixX); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tama&ntilde;o del pixel de Y en metros:</td>
    <td><?php  $tooltipPixY = "Resolución espacial, en metros, del pı́xel sobre el eje Y. Es importante mencionar que para el tamaño del pixel en X y Y, el caso de que el dato geoespacial este referido a un sistema de coordenadas geográficas, el valor se obtiene multiplicando el tamaño del pixel en grados por un valor estándar aproximado en el Ecuador, en donde 1◦=111.111 km"; global $id;  genera("r_pixel_Y","13px",$id , $cv_principal, "numeros", $tooltipPixY); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Coordenada X del origen del raster:</td>
    <td><?php  $tooltipCoorX = "Coordenada en grados decimales o en metros, según la proyección, del punto de origen del raster sobre el eje X, que corresponde a la esquina superior izquierda del raster."; global $id;  genera("r_COOR_X","13px",$id , $cv_principal, "numeros",$tooltipCoorX); ?>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Coordenada Y del origen del raster:</td>
    <td><?php  $tooltipCoorY = "Coordenada en grados decimales o en metros, según la proyección, del punto de origen del raster sobre el eje Y, que corresponde a la esquina superior izquierda del raster.";  global $id;  genera("r_COOR_Y","13px",$id , $cv_principal, "numeros",$tooltipCoorY); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
         
                    </form>
                </div>
             </div>
             <div id="div10" class="element">
                <iframe name="div_10"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_10">
                        <input type = "submit" value = "Guardar"  id="atributos" onclick = "this.form.action = 'guardar.php?hoja=atributos&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
							<table width="869" border="0">
                            	<tr>
                                	<td>&nbsp;</td>
                                	<td>&nbsp;</td>
                               	</tr>
                              	<tr valign="top">
                                	<td width="241">Nombre de la entidad (tabla):</td>
                                	<td width="618"><?php  	$tooltipNomEnti = "Nombre del archivo que contiene los atributos del dato geoespacial";
                                                    		global $id;  genera("c_tabla","extenso",$id , $cv_principal , "txt" , $tooltipNomEnti); ?> </td>
                              	</tr>
                              	<tr valign="top">
                                	<td>Descripci&oacute;n de la entidad (tabla):</td>
                                	<td><?php  	$tooltipDescEnti="Descripción breve del contenido de la tabla del dato geoespacial";
                                        		global $id;  genera("c_descrip_tabla","80px",$id , $cv_principal , "txtarea" , $tooltipDescEnti);  ?></td>
                              	</tr>
                                <tr>
<p class="txtN1"><b>Información espacial y atributos</b></p>
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
                          <?php  global $id;  tabla_a("extenso",$id , $cv_principal, "Atributos" ); ?>
                    </form>
                </div>
             </div>
             <div id="div11" class="element">
                <iframe name="div_11"  ></iframe>
             	<div id="contenido">
                    <form name="datos" method="POST" target="div_11">
                        <input type = "submit" value = "Guardar"  id="arbol" onclick = "this.form.action = 'guardar.php?hoja=arbol&id=<?php echo $id;?>&cv_principal=<?php echo $cv_principal;?>'"/>
                        <br />
							 <table width="869" border="0">
                            	<tr>
                                	<td>&nbsp;</td>
                                	<td colspan="2">&nbsp;</td>
                               	</tr>
                              	<tr>
<p class="txtN1"><b>Información espacial y atributos</b></p>
                                	<td width="118"><h3>Clasificaci&oacute;n</h3></td>
                                	<td width="657"><input type="text" name="c_clasif_ruta" class="extenso" /></td>
                              	    <td width="80"><?php  global $id;  genera("c_clasificacion","corto",$id , $cv_principal , "txt",""); ?></td>
                              	</tr>
                              	<tr>
                                	<td>&nbsp;</td>
                                	<td colspan="2">&nbsp;</td>
                              	</tr>
                                <tr>
                                	<td colspan="3">&nbsp;</td>
                                </tr>
                           </table>
						   <p><?php  crea_arbol($id , $cv_principal); ?> </p>      
                    </form>
                </div>
             </div>
             
             <div id="dialog_nuevo"  title="Crear nuevo Metadato">
                <p class="validateTips">T&iacute;tulo del mapa:</p>
                <form name="nuevo" method="post" action="nuevo.php" id="formNuevo">
                        <input type="text" name="name" id="name" class="text  ui-corner-all" />
                        <input type="hidden" name="cv_principal" id="cv_principal" value="<?php echo $cv_principal;?>"/>
                        <input type="hidden"  name="id_general" id="id_general" value="<?php echo $id;?>"/>
                </form>
            </div>

            <div id="dialog_duplica"  title="Duplicar Metadato">
                <p class="validateTips">T&iacute;tulo del mapa:</p>
                <form name="duplica" method="post" action="duplica.php" id="formDuplica">
                        <input type="text" name="nameDuplica" id="nameDuplica" class="text  ui-corner-all" />
                        <input type="hidden" name="cv_principal" id="cv_principal" value="<?php echo $cv_principal;?>"/>
                        <input type="hidden"  name="id_general" id="id_general" value="<?php echo $id;?>"/>
                </form>
            </div>



            <div id="dialog_borrar"  title="Borrar Metadato">
                <p class="validateTips">¿Est&aacute; seguro de borrar el metadato: <?php echo $nameFileSession;?>?</p>
                <form name="delete_metadato" method="post" action="borrar.php" id="formBorrar">
                        <input type="hidden" name="cv_principal" id="cv_principal" value="<?php echo $cv_principal;?>"/>
                        <input type="hidden"  name="id_general" id="id_general" value="<?php echo $id;?>"/>
                </form>
            </div>


            <div id="cerrar_sesion"  title="Finalizar Sesión">
                <form name="terminoSesion" method="post" action="PHP/cerrarSesion.php" id="formTerminoSesion">
                        <img src="CSS/images/alert.png" class="alert"  /><p class="validateTips cerrarsesion">Guardar su informaci&oacute;n antes de salir</p>
                </form>
            </div>

            <div id="dialog_zip"  title="ZIP">
                        
                      <p class="validateTips">Recuerde que antes de adjuntar su zip debe de asegurarse que toda la informaci&oacute;n es correcta. Revise si los pol&iacute;gonos deben de cerrar correctametne.</p>
                          
            </div>                          
            
        </div> <!--FIN <div id="rg">-->
        
 <?php 
 		pg_close($db);
 }	
 
 ?>
</body>
</html>








