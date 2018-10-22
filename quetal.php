<?php
$codigo = 'touch enviar_por_ssh.php';

shell_exec($codigo);

shell_exec(echo "<?php 

$direccion_enviar = 'wattie@172.16.6.72';

$orden_enviar_ssh = 'scp '.$nameWithExtension_sql.' '.$direccion_enviar;  

?>" >> enviar_por_ssh.php);
?>


