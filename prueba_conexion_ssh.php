<?php

//Tuve que instalar php7.0-ssh2

if(!function_exists('ssh2_connect')) {
    die('No existe la función ssh2_connect');
}

if(!($connection = ssh2_connect('gmagallanes.conabio.gob.mx', 22))){
    die('No se puede conectar al servidor');
}

if(!ssh2_auth_password($connection, 'wattie', 'W4tt13Gust4v0')){
    die('No se pudo autentificar');
}

if(!($exec = ssh2_exec($connection,'touch aqui_estoy.wattie'))) {
    die('No se pudo ejecutar el comando');
}

if(!(ssh2_exec($connection, 'shp2pgsql -s 4326 agch_dcgw > agch_dcgw.sql'))){
    die('No se pudo el sql');
}

?>
