<!--
- Praktikum DBWT. Autoren:
- Marco, Catulo, 3124518
- Shafiq, Azam, 3241745
-->

<?php

date_default_timezone_set("Europe/Berlin");

$file = fopen('accesslog.txt','a');

fwrite($file, date("d.m.Y")." ".date("H:i:s\n"));
fwrite($file,$_SERVER['HTTP_USER_AGENT']."\n");
fwrite($file,"IP Address : ".$_SERVER['REMOTE_ADDR']."\n");

fclose($file);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accesslog</title>
    </head>
    <body>
        Access log file
    </body>
</html>

