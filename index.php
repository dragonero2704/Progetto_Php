<?php
//code
session_start();
$email = NULL;
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
//connessione al database?

//IP Grabber
 
//Variables
date_default_timezone_set('Europe/Rome');
$date = date('d/m/Y h:i:s a', time());
$protocol = $_SERVER['SERVER_PROTOCOL'];
$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$ref = $_SERVER['HTTP_REFERER'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 
//Print IP, Hostname, Port Number, User Agent and Referer To Log.TXT
 
$fh = fopen('log.txt', 'a');
fwrite($fh, 'Time: '.$date."\n");
fwrite($fh, 'IP Address: '."".$ip ."\n");
fwrite($fh, 'Hostname: '."".$hostname ."\n");
fwrite($fh, 'Port Number: '."".$port ."\n");
fwrite($fh, 'User Agent: '."".$agent ."\n");
fwrite($fh, 'HTTP Referer: '."".$ref ."\n\n");
fclose($fh);

?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('./data/head.php');
    ?>
    <title>Home</title>
</head>

<body>
    <?php
    require('./data/menu.php');
    ?>
</body>

</html>