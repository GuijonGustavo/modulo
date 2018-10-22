<?php
//require("/usr/share/php/libphp-phpmailer/class.phpmailer.php");
require("/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
if($mail){echo ' YA. ';}

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "xolo.conabio.gob.mx"; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->Username = "gmagallanes@conabio.gob.mx"; // Correo completo a utilizar
$mail->Password = "W4tt13Gust4v0"; // Contraseña
$mail->Port = 587; // Puerto a utilizar
$mail->From = "info@elserver.com"; // Desde donde enviamos (Para mostrar)
$mail->FromName = "Gustavo Magallanes Guijón";
$mail->AddAddress("gmagallanes@conabio.gob.mx"); // Esta es la dirección a donde enviamos
$mail->AddCC("cuenta@dominio.com"); // Copia
$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Titulo"; // Este es el titulo del email.
$body = "Hola mundo. Esta es la primer línea<br />";
$body .= "Acá continuo el <strong>mensaje</strong>";
$mail->Body = $body; // Mensaje a enviar
$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // Texto sin html
//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
$exito = $mail->Send(); // Envía el correo.

if($exito){
echo 'El correo fue enviado correctamente.';
}else{
echo 'Hubo un inconveniente. Contacta a un administrador.';
}
?>
