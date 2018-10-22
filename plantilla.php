<?php

//################# abre sesión#####################3

session_start();

$nombre_imagen = $_SESSION['nameFileSession'];
$nombre_imagen .= ".png";

//################# abre zona creación de imagen#####################3
header("Content-type:image/png");

$imagen_fondo = "images/imagen_fondo.png";

$im = imagecreatefrompng($imagen_fondo);

imagecopy($im, imagecreatefrompng("images/bici.png"),250,120,-150,-150,700,540); //

imagecopy($im, imagecreatefrompng("images/bici.png"),20,650,0,0,140,100); //Imagen chica

$color_negro = imagecolorallocate($im,0,0,0);

$color_blanco = imagecolorallocate($im,255,250,250);

$textoTitulo = $_SESSION['titleFileSession'];

$textoiPie = $_SESSION['titleFileSession'];

$textoiPie .= ". Comisión Nacional para el Conocimiento \n y uso de la Biodiversidad"; 

$textoDatum = $_SESSION['datumFileSession'];

$fuente = "/usr/share/fonts/truetype/dejavu/DejaVuSerif.ttf";

imagettftext($im,20,0,130,60,$color_blanco,$fuente,$textoTitulo);

imagettftext($im,8,0,220,735,$color_negro,$fuente,$textoiPie);

imagettftext($im,5,0,56,630,$color_negro,$fuente,$textoDatum);

imagepng($im, "images/".$nombre_imagen);

imagedestroy($im);

//################# abre zona de descarga#####################3

chdir("images");

$attachment_location = $nombre_imagen; 
if (file_exists($attachment_location)) {
    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for internet explorer
    header('Content-Type: application/octet-stream');
    header('Content-Type: application/force-download');
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length:".filesize($attachment_location));
    header("Content-Disposition: attachment; filename=$nombre_imagen");
    readfile($attachment_location);
    die();
} else {
    die("Error: File not found.");
}
//################# cierra zona de descarga#####################3
