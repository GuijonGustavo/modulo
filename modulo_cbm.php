<?php
session_start();

$nameFileSession = $_SESSION['nameFileSession'];
$nameFileSession .= ".zip";

$nameOfFile = $_FILES['nameOfFile']['name'];
$typeFile = $_FILES['nameOfFile']['type'];


$mensaje_archivo_distinto = "El archivo " . $nameOfFile . " es distinto a : " . $nameFileSession . ", revisa porfavor que sea el archivo corrrecto para poder continuar.";
$k =  "Continua el proceso en Geoserver.";

if($nameFileSession == $nameOfFile)
    {
                    echo "<script type=\"text/javascript\">alert(\"$k\");</script>";


    $extensionFile = end(explode(".", $_FILES['nameOfFile']['name']));
//Este primer if es para los memetypes. 
    if((($typeFile == "application/zip") || ($typeFile == "multipart/x-zip") || ($typeFile == "application/x-zip-compressed")) && ($extensionFile == "zip"))
    { 
    
        if($extensionFile == "zip")
        
        {

                    echo "<script type=\"text/javascript\">alert(\"Espere por favor continua subiendo su archivo. Proceso: 2/6  \");</script>"; 
            if (move_uploaded_file($_FILES['nameOfFile']['tmp_name'],"files/".$_FILES['nameOfFile']['name']) )
                {
                    
                    $aviso_exito = "EL archivo " . $_FILES['nameOfFile']['name'] . " ha subido correctamente.";

                    echo "<script type=\"text/javascript\">alert(\"$aviso_exito\");</script>"; 

//                    echo "<script type=\"text/javascript\">$(\"#dialog_zip\").dialog({autoOpen: false,resizable: false,height: 200,width: 450,modal: true});</script>"; Sigo trabajando en este estilo

                }
        
            else
                {

                    echo "<script type=\"text/javascript\">alert(\"No se pudo subir su archivo\" . $nameOfFile . \"Error Processing Request\");</script>"; 
                   
                }
        }
    else
        {
            echo "<script type=\"text/javascript\">alert(\"Este archivo no es válido. Intenta de nuevo.\");</script>";

        }
}
getcwd();
chdir("files");

                        $nameWithoutExtension = reset(explode(".", $nameOfFile));

//$url_enviar='curl -u admin:vS9UI355#ea9 -H "Content-type: application/zip" -T ${TRAINING_ROOT}/var/www/html/modulo_cbm/files/'. $nameOfFile . ' http://ssig0.conabio.gob.mx:8080/geoserver/rest/workspaces/myworkspace/datastores/' . $nameWithoutExtension . '/file.shp';
$url_enviar='curl -u admin:vS9UI355#ea9 -H "Content-type: application/zip" -T ${TRAINING_ROOT}/var/www/html/modulo_cbm/files/'. $nameOfFile . ' http://172.16.1.179:8080/geoserver/rest/workspaces/myworkspace/datastores/' . $nameWithoutExtension . '/file.shp';

shell_exec($url_enviar);

$orden_crear_directorio = 'mkdir ' .$nameWithoutExtension;

shell_exec($orden_crear_directorio);

$orden_mover='mv '.$nameOfFile.' '.$nameWithoutExtension.'/';

shell_exec($orden_mover);

chdir($nameWithoutExtension);

$orden_unzip = 'unzip '.$nameOfFile;

shell_exec($orden_unzip);

chdir($nameWithoutExtension);

$nameWithExtension_sql = $nameWithoutExtension.'.sql'; 

$orden_shp2pgsql = 'shp2pgsql '.$nameWithoutExtension. ' > '.$nameWithExtension_sql;

shell_exec($orden_shp2pgsql);

$permiso = 'chmod 777 '.$nameWithExtension_sql;

shell_exec($permiso);

$direccion_enviar = 'wattie@gmagallanes.conabio.gob.mx:/home/wattie/ssig0/';

$orden_enviar_ssh = 'scp '.$nameWithExtension_sql.' '.$direccion_enviar;  

shell_exec($orden_enviar_ssh);

echo "<script type=\"text/javascript\">alert(\"Se han enviado los archivos a la CONABIO\");</script>"; 

}

else{
                    echo "<script type=\"text/javascript\">alert(\"$mensaje_archivo_distinto\");</script>"; 
}

?>
