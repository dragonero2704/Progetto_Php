<?php
//code
require('../data/session.php');
require('../data/db.php');
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);

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
            <?php
                $query = "
                    SELECT codice_gioco
                    FROM giochi
                ";
                $ris = $conn->query($query) or die($conn->error);
                $codici = array();
                while($row=$ris->fetch_assoc()){
                    array_push($codici, $row['codice_gioco']);
                }

                $game_display = $codici[array_rand($codici, 1)];
                $query = "SELECT *
                FROM giochi
                WHERE codice_gioco = $game_display";
                $ris = $conn->query($query) or die($conn->error);
                $gamedata = $ris->fetch_assoc();
            ?>
            <div class="img_evidenza">
                <img src="../media/games/<?php echo $game_display?>/banner.jpg" alt="immagine non caricata">
            </div>
            <h1><?php
                echo $gamedata['titolo'];
            ?></h1>
        </div>

        <!-- barra di selezione tipo di ordine -->

        <?php

            $trova_giochi = "
                SELECT *
                FROM giochi
            ";
            $ris=$conn->query($trova_giochi) or die ($conn->connect_error);


            echo '<div class="game_container">';
            while($row = $ris->fetch_assoc())
            {
                echo '<a class="game" href="product.php?game=' . $row['codice_gioco'] . '">
                <div class="game_negozio">
                    <div class="img_container">
                        <img src="../media/games/' . $row['codice_gioco'] . '/preview.jpg" alt="Immagine non caricata :(">
                    </div>
                    <h2>' . $row['titolo'] . '</h2>
                    <div class="pricetag">' . $row['prezzo'] . ' €</div>
                </div>
                </a>';
            }
            echo '</div>';
        ?>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>