<?php
ini_set("display_errors", "on");
header('Content-Type: text/html; charset=utf-8'); 
require('PHP/conn.php');
require('PHP/funciones.php');
$db = conectar();


	$usr = ( isset ($_POST['usuario'])) ? $_POST['usuario'] : null ;
	$pw =  ( isset ($_POST['password']))? $_POST['password'] : null ;


	$consulta = pg_query($db, "SELECT * FROM analistas where nom_user='$usr' AND password = '$pw'");
	if (!$consulta) { exit("Error en al intertar buscar el analista o capturista"); } 
	if(pg_num_rows ($consulta))
	{
		if( $fila=pg_fetch_array($consulta) )
		{       
			$uid = $fila['idAnalista'];
			$pwrd = $fila['password'];
			$cv_principal = $fila['idAnalista'];
//			$puesto = $fila['Puesto'];
			$ultimoAcceso = date("Y-n-j H:i:s"); 
			$autentificado = 'SI';
			session_start();
			$_SESSION['autenticado']    = $autentificado;
			$_SESSION['uid']            = $uid;
			$_SESSION['passw']          = $pwrd; 
			$_SESSION["ultimoAcceso"]   = $ultimoAcceso;
			
			
			echo "<form name=\"formulario\" method=\"post\" action=\"Menu.php\">";
			echo "<input type=\"hidden\" name=\"idUsr\" value=\'$uid \' />";
			echo "<input type=\"hidden\" name=\"idPwrd\" value=\'$pwrd\' />";
			echo "<input type=\"hidden\" name=\"acceso\" value=\'$ultimoAcceso\' />";
			echo "<input type=\"hidden\" name=\"autenticado\" value=\'$autentificado\' />";
//			echo "<input type=\"hidden\" name=\"puesto\" value=\'$puesto\' />";
			echo "</form>";
			
		}
		
		echo "<script type=\"text/javascript\">"; 
		echo "document.formulario.submit();";
		echo "</script>";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html lang="es">
  <head>
    <title>Index</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="CSS/estilo.css" media="all" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:300,500,700" rel="stylesheet">
    <script src="Javascript/jquery-1.7.1.min.js"></script>
    <script src="Javascript/scriptIndex.js"></script>
  </head>
  <body>
    <div>
      
      <div id="cn"> 
		<h2>Proyecto de Cooperación Triangular</h2>
		<h2>Fortalecimiento de capacidades para la gestión territorial sostenible del</h2>
		<h2>Corredor Biológico Mesoamericano en Guatemala</h2>
		<img class="cn" src ="CSS/images/logos.png" />	
		<h2>Módulo para la integración<br>de información cartográfica</h2>
		<h2></h2>
       
	   <form method="post" action="">
		  <table width="631" border="0" align="center">
            <tr>
              <td width="220"></td>
              <td width="72" valaign="bottom" align="right">Usuario:</td>
              <td width="325"><input name="usuario" id="usuario" type="text"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td valaign="bottom" align="right">Contraseña:</td>
              <td><input name="password" type="password" id="password"/></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php
                           if( isset( $_POST['actualiza_error'] ) && $_POST['actualiza_error'] != '' ){echo "<font color=\"red\"><ul id=\"msg_error\">".$_POST['msg_error']."</ul></font>"; }
						   if( isset( $_POST['ActualizaSesionfinal'] ) && $_POST['ActualizaSesionfinal'] != '' ){echo "<font color=\"green\"><ul id=\"msg_error\">".$_POST['sesionfinal']."</ul></font>"; }
                   ?>
              </td>
            </tr>
            <tr>
              <td colspan="3"><input type="submit" name="iniciar"  id="iniciar" value="Entrar" class="Bttn"/></td>
            </tr>
            <tr>
              <td colspan="3" align="center"><div class="error"> </div></td>
            </tr>
            <tr>
              <td colspan="3" align="center"></td>
            </tr>
          </table>
	    </form>
      </div>
    </div>
  </body>
</html>
