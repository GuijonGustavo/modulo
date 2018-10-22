<?php                 
//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
 
    //obtenemos el archivo a subir
    $files = $_FILES['archivo']['name'];
 
     $i = 0;
    //comprobamos si el archivo ha subido
    foreach($files as $file)
    {
        if (move_uploaded_file($_FILES['archivo']['tmp_name'][$i],"files/".$_FILES['archivo']['name'][$i]))
        {
            echo "EL archivo " . $_FILES['archivo']['name'][$i] . " ha subido correctamente<br>";
            $i++;
        }
    }
}else{
    throw new Exception("Error Processing Request", 1);   
}
?> 