<?php
//code
session_start();
$email = NULL;
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
//connessione al database?
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