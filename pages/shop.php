<?php
//code
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);

//connessione al database?
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../components/head.php')
    ?>
    <title>Shop</title>
</head>

<body>
    <?php
    require('../components/menu.php');
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
            while ($row = $ris->fetch_assoc()) {
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
                <img src="../media/games/<?php echo $game_display ?>/banner.jpg" alt="immagine non caricata">
                <div class="content">
                    <h1><?php echo $gamedata['titolo']; ?></h1>
                    <p> <?php echo $gamedata['descrizione']; ?> </p>
                    <a href="./product.php?game=<?php echo $game_display; ?>" class="button group scalehover mt4">
                        Acquista ora
                    </a>
                </div>
            </div>


        </div>




        <!-- barra di selezione tipo di ordine -->
        <div class="shop_flex mt19 mb5">
            <div class="filter_menu">
                <h2 class=" mb3">Ordina per...</h2>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="get" onchange="update_ordine(this.children)" onload="update_ordine(this.children)">
                    <input class='checkbox-genere hidden' type="radio" value="titolo" name="metodo" id="titolo-id" checked>
                    <label for='titolo-id' class='sort_order backglow'>titolo</label>
                    <div class="separator"></div>
                    <input class='checkbox-genere hidden' type="radio" value="prezzo" name="metodo" id="prezzo-id">
                    <label for='prezzo-id' class='sort_order backglow'>prezzo</label>
                    <div class="separator"></div>
                    <input class='checkbox-genere hidden' type="radio" value="pegi" name="metodo" id="pegi-id">
                    <label for='pegi-id' class='sort_order backglow'>pegi</label>
                </form>
                <h2 class="mt3 mb3">Filtra generi...</h2>

                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="get" style="display: block;" onchange="update_generi(this.children)" onload="update_generi(this.children)">
                    <?php
                    $query = "SELECT *
                        FROM genere";
                    $ris = $conn->query($query);
                    while ($row = $ris->fetch_assoc()) {
                        $genere = $row['genere'];
                        echo "<input type='checkbox' name='generi[]' id='$genere-id' class='checkbox-genere hidden' value='$genere'>
                            <label for='$genere-id' class='sort_order backglow'>$genere</label>
                    <div class='separator'></div>
                    ";
                    }
                    ?>

                </form>


            </div>
            <div class="result m0">
                <!-- roba che esce con search -->
                <?php
                
                    $trova_giochi = "
            SELECT *
            FROM giochi
            ORDER BY titolo";
                

                $ris = $conn->query($trova_giochi) or die($conn->connect_error);
                while ($row = $ris->fetch_assoc()) {
                    echo '<a class="game scalehover" href="product.php?game=' . $row['codice_gioco'] . '">
                        <div class="img_container">
                            <img src="../media/games/' . $row['codice_gioco'] . '/preview.jpg" alt=" ">
                        </div>
                        <h2>' . $row['titolo'] . '</h2>
                        <div class="pricetag">' . $row['prezzo'] . ' €</div>
                        </a>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    require('../components/footer.php');
    ?>


</body>
<script src="../javascript/shop.js"></script>

</html>