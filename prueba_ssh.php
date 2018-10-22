<?php


$direccion_enviar = 'wattie@gmagallanes.conabio.gob.mx:~/ssig0/';

$orden_enviar_ssh = 'scp ANP2005CW.sql '.$direccion_enviar;  

shell_exec($orden_enviar_ssh);




?>
