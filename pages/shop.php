<?php
//code
require('../data/session.php');
//connessione al database?
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../data/head.php')
    ?>
    <title>Shop</title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <div class="evidenza">
            <div class="img_evidenza">
                <img src="../media/games/16/preview.jpg" alt="immagine non caricata">
            </div>
            <h1>lego star wars</h1>
        </div>

        <?php

            $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);
            $trova_giochi = "
                SELECT *
                FROM giochi
            "
            $ris=$conn->query($trova_giochi) or die ($conn->connect_error);

            while($row = $ris->fetch_assoc())
            {
                echo
            }
        ?>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>