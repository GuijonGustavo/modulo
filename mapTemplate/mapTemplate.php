<?php

ob_start();
session_start();

$id = $_POST['btn_mapTemplate'];

require('../PHP/conn.php');
	$db = conectar();
	if ($db)
	{
		$sql = 'SELECT * FROM coberturas where record_id='.$id.';';
		$result = pg_query($db, $sql); 
		if (!$result) { $error = "Error en la consulta"; } 
		if( $fila = pg_fetch_array($result) )
            $cobertura = $fila['cobertura']; 
        $cobertura = strtolower($cobertura);
		$cita = $fila['cita']; 	
		$fecha_inicial = $fila['fecha_inicial']; 	
		$nombre = $fila['nombre']; 	
}	





$nombreUsuario = $_SESSION['nombreUsuario'];

$tipo_proy = $_POST['tipoProy'];
$nom_proy = $_POST['nombreProy'];


        list($tipoProy, $baseProy) = split('[_]', $nom_proy);


$tipo_soft = $_POST['software'];

//Este script comienza como todo array desde cero, y el ciclo foreach agrega un lugar de mas. Con esto indicar el lugar n quedara en el lugar n+2

if ($nombreUsuario == "Rocío López"){
    $nombreUsuario = "Rocio Lopez";
}
$usuario_proy = explode(" ", $nombreUsuario);

//$numero_proy = explode("jm", $nom_proy);

//$numeral = $numero_proy[1];


if ($tipo_soft == "arc"){


$fichero = 'mapTemplate.py';
//$dir = date("Y-m-d")."_".date("H:i:s")."_".$fichero;
$dir = date("Y-m-d")."_".$usuario_proy[0]."_".$nom_proy."_".$tipo_proy.".py";

copy($fichero,$dir);



if ($tipo_proy == dist){

    $lista_shapes = "lista_shapes = os.listdir(r'T:\\\\jm\\\\".$nom_proy."\\\\dist\\\\shp')";
    $layer = "    newlayer1 = arcpy.mapping.Layer(r'T:\\\\jm\\\\".$nom_proy."\\\\dist\\\\'+shapefile+'')";
    $desc = "    desc = arcpy.Describe(r'T:\\\\jm\\\\".$nom_proy."\\\\dist\\\\'+shapefile+'')";
    $conn = "conn = pg.connect(dbname='dist_".$nom_proy."', user='postgres', passwd='sig123456', host='200.12.166.29')";

} 


if ($tipo_proy == sitios){

    $lista_shapes = "lista_shapes = os.listdir(r'T:\\\\jm\\\\".$nom_proy."\\\\sitios\\\\shp')";
    $layer = "    newlayer1 = arcpy.mapping.Layer(r'T:\\\\jm\\\\".$nom_proy."\\\\sitios\\\\'+shapefile+'')";
    $desc = "    desc = arcpy.Describe(r'T:\\\\jm\\\\".$nom_proy."\\\\sitios\\\\'+shapefile+'')";
    $conn = "conn = pg.connect(dbname='sitios_".$nom_proy."', user='postgres', passwd='sig123456', host='200.12.166.29')";
}







switch($nombreUsuario)
{
case "Gustavo":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\png\\\\'+filename+'.png', resolution = 300)";


    $lista_shapes = "lista_shapes = os.listdir(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\shp\\\\shp')";
    $layer = "    newlayer1 = arcpy.mapping.Layer(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\shp\\\\'+shapefile+'')";
    $desc = "    desc = arcpy.Describe(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\shp\\\\'+shapefile+'')";
   // $simbolo = "        symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $simbolo_dp = "            symbologyLayer = (r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\simb\\\\'+filename+'.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'C:\\\\Users\\\\CPR\\\\Desktop\\\\plantilla\\\\simb\\\\'+filename+'.lyr')";
    $conn = "conn = pg.connect(dbname='metadatos', user='postgres', passwd='geosig0-2016', host='172.16.1.179')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"dataset_id\" = coberturas.\"record_id\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area_geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"autores\" where \"dataset_id\"=(select \"record_id\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";

    break;

case "Tonantzin":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\png\\\\'+filename+'.png', resolution = 300)";

    $lista_shapes = "lista_shapes = os.listdir(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\shp\\\\shp')";
    $layer = "    newlayer1 = arcpy.mapping.Layer(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\shp\\\\'+shapefile+'')";
    $desc = "    desc = arcpy.Describe(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\shp\\\\'+shapefile+'')";
   // $simbolo = "        symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $simbolo_dp = "            symbologyLayer = (r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\simb\\\\'+filename+'.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\simb\\\\'+filename+'.lyr')";
    $conn = "conn = pg.connect(dbname='metadatos', user='postgres', passwd='geosig0-2016', host='172.16.1.179')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"dataset_id\" = coberturas.\"record_id\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area_geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"autores\" where \"dataset_id\"=(select \"record_id\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";

    break;

case "José Galvez":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\CPR\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\CPR\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\CPR\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $lista_shapes = "lista_shapes = os.listdir(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\shp\\\\shp')";
    $layer = "    newlayer1 = arcpy.mapping.Layer(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\shp\\\\'+shapefile+'')";
    $desc = "    desc = arcpy.Describe(r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\shp\\\\'+shapefile+'')";
   // $simbolo = "            symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $simbolo = "            symbologyLayer = (r'C:\\\\Users\\\\tcamacho\\\\Desktop\\\\plantilla\\\\simb\\\\'+filename+'.lyr')";
    $conn = "conn = pg.connect(dbname='metadatos', user='postgres', passwd='geosig0-2016', host='172.16.1.179')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"dataset_id\" = coberturas.\"record_id\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area_geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"autores\" where \"dataset_id\"=(select \"record_id\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";

    break;

case "Shareni Lara":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\slara\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\slara\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\slara\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\slara\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";
    $simbolo_dp = "            symbologyLayer = (r'J:\\USUARIOS\\SISTEM\\GMAGALLANES\\template\\base\\color_dp.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'J:\\USUARIOS\\SISTEM\\GMAGALLANES\\template\\base\\color_sr.lyr')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"DATASET ID\" = coberturas.\"RECORD ID\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area-geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"Autores\" where \"DATASET ID\"=(select \"RECORD ID\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";
    break;

case "Verena Ekaterina Benítez":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\vbenitez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\vbenitez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\vbenitez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\vbenitez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";
    $simbolo_dp = "            symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_dp.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"DATASET ID\" = coberturas.\"RECORD ID\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area-geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"Autores\" where \"DATASET ID\"=(select \"RECORD ID\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";
    break;

case "ssocialsig":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\ssocialsig.CONABIO\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\ssocialsig.CONABIO\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\ssocialsig.CONABIO\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\ssocialsig.CONABIO\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";
    $simbolo_dp = "            symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_dp.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"DATASET ID\" = coberturas.\"RECORD ID\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area-geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"Autores\" where \"DATASET ID\"=(select \"RECORD ID\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";
    break;

case "Estrella Cruz":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\ecruz\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\ecruz\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\ecruz\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\ecruz\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";
    $simbolo_dp = "            symbologyLayer = (r'J:\\USUARIOS\\SISTEM\\GMAGALLANES\\template\\base\\color_dp.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'J:\\USUARIOS\\SISTEM\\GMAGALLANES\\template\\base\\color_sr.lyr')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"DATASET ID\" = coberturas.\"RECORD ID\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area-geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"Autores\" where \"DATASET ID\"=(select \"RECORD ID\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";
    break;
case "Laura Herrera":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\oherrera\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\oherrera\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\oherrera\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\oherrera\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";
    $simbolo_dp = "            symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_dp.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"DATASET ID\" = coberturas.\"RECORD ID\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area-geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"Autores\" where \"DATASET ID\"=(select \"RECORD ID\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";
    break;
case "Rocio Lopez":
    $mxd_d = "        mxd.saveACopy(r'C:\\\\Users\\\\rlopez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_d = "        arcpy.mapping.ExportToPNG(mxd, r'C:\\\\Users\\\\rlopez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";

    $mxd_s = "        mxd_P.saveACopy(r'C:\\\\Users\\\\rlopez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\mxd\\\\'+filename+'.mxd')";
    $png_s = "        arcpy.mapping.ExportToPNG(mxd_P, r'C:\\\\Users\\\\rlopez\\\\Desktop\\\\".$nom_proy."\\\\".$tipo_proy."\\\\png\\\\'+filename+'.png', resolution = 300)";
    $simbolo_dp = "            symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_dp.lyr')";
    $simbolo_sr = "        symbologyLayer = (r'J:\\\\USUARIOS\\\\SISTEM\\\\GMAGALLANES\\\\template\\\\base\\\\color_sr.lyr')";
    $consulta = "    consulta_atributo = 'select atributos.nombre from atributos inner join coberturas on atributos.\"DATASET ID\" = coberturas.\"RECORD ID\" where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $area = "    consulta_areageo = 'select \"area-geo\" as areageo from coberturas where cobertura='+\"'\"+filename+\"'\"+\"\"";
    $autores = "    autores = 'select origin from \"Autores\" where \"DATASET ID\"=(select \"RECORD ID\" from coberturas where cobertura='+\"'\"+filename+\"')\"+\"\"";
    break;
default:
    $mxd_d = "No hay usuario dado de alta";
    $png_d = "No hay usuario dado de alta";

    $mxd_s = "No hay usuario dado de alta";
    $png_s = "No hay usuario dado de alta";
}

//$existImage_dp = "        existImage = os.path.isfile(r'T:\\\\jm\\\\".$nom_proy."\\\\img\\\\'+filename+'.jpg')";
//$existImage_sr = "        existImagep = os.path.isfile(r'T:\\\\jm\\\\".$nom_proy."\\\\img\\\\'+filename+'.jpg')";

$sourseImage_dp = "                    img.sourceImage = r'T:\\\\jm\\\\".$nom_proy."\\\\img\\\\'+nombreImg+'.JPG'";
$sourseImage_sr = "                    img.sourceImage = r'T:\\\\jm\\\\".$nom_proy."\\\\img\\\\'+nombreImg+'.JPG'";

$img = "        im = Image.open(r'T:\\\\jm\\\\".$nom_proy."\\\\\\img\\\\'+nombreImg+'.JPG')"; 


// Lineas en las que se inyectan las instrucciones
$ln_conn = 35;
$ln_lista_shapes = 43;
$ln_img = 79;
$ln_consulta = 99;
$ln_area = 123;
$ln_autores = 263;
$ln_layer = 610;
$ln_desc = 616;
//$ln_existImage_dp = 341;
$ln_sourseImage_dp = 734;
$ln_mxd_d = 782;
$ln_png_d = 786;
$ln_simbolo_dp = 638;
$ln_simbolo_sr = 804;
//$ln_existImage_sr = 490;
$ln_sourseImage_sr = 900;
$ln_mxd_s = 948;
$ln_png_s = 952;

//Fin de lineas

$contents = file($dir);

$new_contents = array();
foreach ($contents as $key => $value) {
$new_contents[] = $value;

if ($key == $ln_conn) {
$new_contents[] = $conn;
}

if ($key == $ln_lista_shapes) {
$new_contents[] = $lista_shapes;
}

if ($key == $ln_img) {
$new_contents[] = $img;
}

if ($key == $ln_consulta) {
$new_contents[] = $consulta;
}

if ($key == $ln_area) {
$new_contents[] = $area;
}


if ($key == $ln_autores) {
$new_contents[] = $autores;
}



if ($key == $ln_layer) {
$new_contents[] = $layer;
}
if ($key == $ln_desc) {
$new_contents[] = $desc;
}
if ($key == $ln_simbolo_dp) {
$new_contents[] = $simbolo_dp;
}
if ($key == $ln_simbolo_sr) {
$new_contents[] = $simbolo_sr;
}

//if ($key == $ln_existImage_dp) {
//$new_contents[] = $existImage_dp;
//}
if ($key == $ln_sourseImage_dp) {
$new_contents[] = $sourseImage_dp;
}
if ($key == $ln_mxd_d) {
$new_contents[] = $mxd_d;
}
if ($key == $ln_png_d) {
$new_contents[] = $png_d;
}
//if ($key == $ln_simbolo_sr) {
//$new_contents[] = $simbolo;
//}
//if ($key == $ln_existImage_sr) {
//$new_contents[] = $existImage_sr;
//}
if ($key == $ln_sourseImage_sr) {
$new_contents[] = $sourseImage_sr;
}
if ($key == $ln_mxd_s) {
$new_contents[] = $mxd_s;
}
if ($key == $ln_png_s) {
$new_contents[] = $png_s;
}
}

file_put_contents($dir, implode('',$new_contents));

//-----Descarga del archivo

if (is_file($dir)) {
header("Content-Disposition: attachment; filename=\"$dir\"");
readfile($dir);
} else {
die("Error: no se encontró el archivo '$dir'");
}

}

else{

$fichero = 'quantumTemplate.py';
//$dir = date("Y-m-d")."_".date("H:i:s")."_".$fichero;
$dir = date("Y-m-d")."_".$usuario_proy[0]."_".$nom_proy."_".$tipo_proy.".py";
copy($fichero,$dir);
$name = "lyr = QgsVectorLayer('Escriba la ruta de su shape','".$cobertura."', 'ogr')"; 

$titulo = "cadena1 = '".$nombre."'";
$cita1 = "cita1 = '".$cita."'";
$ln_name = 59;
$ln_titulo = 90;
$ln_cita = 91;

$contenido = file($dir);
$new_contenido = array();
foreach ($contenido as $clave => $valor) {
$new_contenido[] = $valor;

if ($clave == $ln_name) {
$new_contenido[] = $name;
}

if ($clave == $ln_titulo) {
$new_contenido[] = $titulo;
}

if ($clave == $ln_cita) {
$new_contenido[] = $cita1;
}
}

file_put_contents($dir, implode('',$new_contenido));

if (is_file($dir)) {
header("Content-Disposition: attachment; filename=\"$dir\"");
readfile($dir);
} else {
die("Error: no se encontró el archivo '$dir'");
}

}

?>
