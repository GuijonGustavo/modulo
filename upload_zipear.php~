<?php
$files_shp = $_FILES['archivo_shp']['name'];
$tipoFile = $_FILES['archivo_shp']['type'];

    $extension = end(explode(".", $_FILES['archivo_shp']['name']));
 

    if(($tipoFile == "application/x-esri-shape") && ($extension == "shp"))
        {

            if (move_uploaded_file($_FILES['archivo_shp']['tmp_name'],"files/".$_FILES['archivo_shp']['name']) )
                {
                    
                    $p = "EL archivo " . $_FILES['archivo_shp']['name'] . " ha subido correctamente.";

                    echo "<script type=\"text/javascript\">alert(\"$p\");</script>"; 
                }
        
            else
                {

                    echo "<script type=\"text/javascript\">alert(\"No se pudo subir su archivo. Error Processing Request\");</script>"; 
                    
                }
        }
    

    else
        {

            echo "<script type=\"text/javascript\">alert(\"Este archivo no es válido. Intenta de nuevo.\");</script>"; 
        }

?>


