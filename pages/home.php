<?php
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="shortcut icon" href="../media/loghi/logo.jpg" type="image/x-icon"> -->
    <?php
    require('../components/head.php')
    ?>
    <title>Home</title>
</head>

<body>
    <?php
    require('../components/menu.php');
    ?>
    <div class="body">
        <div class="poster">
            <div class="poster__img">
                <img src="../media/images/banner.jpg" alt="">
            </div>
            <div class="poster__content white">
                <h1><b>Benvenuto su Unreal!</b></h1>
                <p>Scopri i nuovi giochi esplorando il sito, e se non l'hai già fatto crea un account, così potrai acquistare e giocare i tuoi giochi preferiti.</p>
                <a href="login.php" class="button scalehover">Login</a>
                <a href="signup.php" class="button scalehover mt1">Registrati</a>

            </div>
        </div>
    </div>
    <?php
    require('../components/footer.php');
    ?>
</body>

</html>