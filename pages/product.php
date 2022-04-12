<?php
//code
require('../data/session.php');
require('../data/db.php');
//connessione al database?
require('../data/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);
//GET dell'articolo
if (isset($_GET['game'])) $codice_gioco = urldecode($_GET['game']);
else header('location: explore.php');

//Fetch dei dettagli del gioco
$query = "SELECT *
FROM giochi
WHERE codice_gioco = $codice_gioco";

$ris = $conn->query($query) or die($conn->error);
$row = $ris->fetch_assoc();
$gamedata = $row;

//Fetch dei generi
$query = "SELECT appartiene.genere, descrizione
FROM appartiene JOIN genere ON appartiene.genere = genere.genere
WHERE codice_gioco = $codice_gioco";

$ris = $conn->query($query);
$generi = array();
while ($row = $ris->fetch_assoc()) {
    $generi[$row['genere']] = $row['descrizione'];
}
//Fetch software house
$query = "SELECT sviluppato.software_house, nome, telefono, email, nazionalita
FROM sviluppato JOIN software_house ON sviluppato.software_house = software_house.codice_software_house
WHERE codice_gioco = $codice_gioco";

$ris = $conn->query($query) or erredirect($conn->errno, $conn->error);
$software_house = array();
while ($row = $ris->fetch_assoc()) {
    $software_house[$row['codice_software_house']] = $row;
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../data/head.php');
    ?>
    <title><?php
            echo $gamedata['titolo'];
            ?></title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <div class="product mt8">

            <div class="product_flex">
                <div class="banner_container">
                    <img src="../media/games/<?php echo $codice_gioco ?>/banner.jpg" alt="">
                </div>
                <div class="product_content group">
                    <h2>
                        <?php
                        echo $gamedata['titolo'];
                        ?>
                    </h2>
                    <div class="separator"></div>
                    <a href="buy.php?game=<?php echo $codice_gioco; ?>" class="button">Acquista ora - <?php echo $gamedata['prezzo'];?>€</a>
                    <div class="separator"></div>
                </div>
            </div>

        </div>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>