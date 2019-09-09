<?php 
$salida = shell_exec('composer install > note.txt');
echo "<pre>$salida</pre>";
?>