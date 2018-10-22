<?php
	$uploaddir = 'ficheros/';
	$jsondata = array();
	$jsondata["vector"] = array();
	//$jsondata["vector"] ["linea"] = array();
	//$jsondata["vector"] ["name"] = array();
	
	if (!is_dir($uploaddir)) {
   		mkdir($uploaddir);
	}
	$file =  $_FILES['userfile']['name'];
	$uploadfile = $uploaddir . $file;
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
	{
		$file = fopen($uploadfile, "r");
		$layerName = fgets($file). "<br />";
		$str = substr($layerName, 1, 7);
		$num_lineas = 1;
		
		if ($str == "CONABIO")
		{
			while(!feof($file)) {
				$num_lineas++;
				$layerName = trim(fgets($file));
				$vector = substr($layerName, 0, 10); // 12 caracteres a partir del nombre
				$tif = substr($layerName, 0,5);
				if ($vector == "Layer name")
				{
					$extrac = substr($layerName, (12 + ((strlen($layerName)) * (-1))));
					//$jsondata["vector"] [] = $extrac;
					$jsondata["vector"] ["linea"]  [] =  $num_lineas;
					$jsondata["vector"] ["name"] [] =  $extrac;
				}
				if ($tif == "Files")
				{
					$extName = substr($layerName,7);
					$nameRaster = str_replace('\\', "/", $extName);
					$nameRasterFinal = explode("/", $nameRaster);
					
					if(substr($nameRaster,-3) == "tif")
					{
						$jsondata["tif"] ["linea"]  [] =  $num_lineas;
						$jsondata["tif"] ["name"]  [] =  trim(array_pop($nameRasterFinal));
					}
					
				}
				
				
			}
		}
		
			
		
		$jsondata["message"] = "el archivo se ha subido con existo";			
		
	} 
	else 
	{
		$jsondata["message"] = "Error al subir el archivo";	
	}
	
	echo json_encode($jsondata, JSON_PRETTY_PRINT);


//////////////////////////////////////////////////////////////////////////////////////////////////////


//	$uploaddir = 'ficheros/';
//	
//	if (!is_dir($uploaddir)) {
//   		mkdir($uploaddir);
//	}
//	$file =  $_FILES['userfile']['name'];
//	$uploadfile = $uploaddir . $file;
//	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
//	{				
//		$file = fopen($uploadfile, "r");
//		$layerName = fgets($file). "<br />";
//		$str = substr($layerName, 1, 7);
//		
//		$num_lineas = 1; 
//		
//		
//		if ($str == "CONABIO")
//		{
//			echo "<select name=\"campos\" id=\"selectMetadato\">";
//			echo "<option value=\"\">Seleccione un archivo</option>";
//			while(!feof($file)) {
//
//					$num_lineas++; 
//					$layerName = trim(fgets($file));
//					$extraction = substr($layerName, 0, 10); // 12 caracteres a partir del nombre
//					if ($extraction == "Layer name")
//					{
//						$extrac = substr($layerName, (12 + ((strlen($layerName)) * (-1))));
//						
//							echo "<option value=\"$num_lineas\">$extrac</option>";
//						
//						//echo  $extrac;// ." ". $layerName ;
//					}
//			
//			}
//			echo "</select>";
//		}
//		else {echo "Archivo no válido";}
//
//		
//		fclose($file);
//	} 
//	else {echo "error";}


//$id=$_POST["fileName"];
//  echo "$id 1";

?>