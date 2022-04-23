<?php
//code
require('../components/session.php');
require('../data/db.php');
//connessione al database?
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);
//GET dell'articolo
if (isset($_GET['game'])) $codice_gioco = urldecode($_GET['game']);
else die(header('location: explore.php'));

if (empty($codice_utente)) die(header('location: login.php'));

//Fetch dei dettagli del gioco
$query = "SELECT *
FROM giochi JOIN software_house ON giochi.software_house = software_house.codice_software_house
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


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../components/head.php');
    ?>
    <title><?php
            echo $gamedata['titolo'];
            ?></title>
</head>

<body>
    <?php
    require('../components/menu.php');
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
                    <?php
                    //controllo se l'utente ha già il gioco
                    $query = "SELECT codice_gioco
                                FROM possiede
                                WHERE codice_gioco = $codice_gioco AND codice_utente = $codice_utente";
                    if ($conn->query($query)->num_rows > 0) {
                        //l'utente ha già il gioco
                        echo '<a href="library.php" class="button">Nella libreria</a>';
                    } else {
                        //l'utente non ha il gioco
                        echo '<a href="buy.php?game=' . $codice_gioco . '" class="button">Acquista ora - ' . $gamedata['prezzo'] . '€</a>';
                    }
                    ?>

                    <div class="separator"></div>
                    <div class="voice_flex"><span>Sviluppatore:</span><span><?php echo $gamedata['nome']; ?></span></div>
                    <div class="separator"></div>
                    <div class="voice_flex"><span>Pegi:</span><span><?php echo $gamedata['pegi']; ?></span></div>
                    <div class="separator"></div>
                    <div class="voice_flex"><span>Genere:</span><span><?php foreach (array_keys($generi) as $key) {
                                                                            echo $key . ' ';
                                                                        } ?></span></div>
                    <div class="separator"></div>
                </div>

            </div>
            <div class="description mt3">
                <h2>Descrizione</h2>
                <p class="txtjustify"> <?php echo $gamedata['descrizione']; ?> </p>

            </div>
            <!-- Sezione recensioni -->
            <div class="description mt5 mb5">
                <h2 class="mb2">Recensioni</h2>
                
                <!-- Recensione dell'utente loggato -->
                <?php
                    $sql = "SELECT * 
                    FROM recensione 
                    WHERE codice_gioco = $codice_gioco AND codice_utente = $codice_utente";
                    $recensione = $conn->query($sql) or erredirect($conn->errno+200, $conn->error);
                    if($recensione){
                        //l'utente ha già fatto una recensione, mostrala
                    }else{
                        //l'utente non ha ancora fatto una recensione, creare il box in cui può scriverla
                    }

                ?>
                <!-- ----------------------------- -->
                <!-- prova -->
                <!-- <div>
                    <h3>dragonero <span class="dot star"></span><span class="dot star"></span><span class="dot star"></span><span class="dot star"></span><span class="dot star"></span></h3>
                    <p class="txtjustify">Bel gioco, 8/10</p>
                    <div class="separator"></div>
                </div> -->
                <!-- prova -->


                <?php
                //fetch delle recensioni degli altri utenti
                $sql = "SELECT * 
                FROM recensione
                WHERE codice_gioco = $codice_gioco AND codice_utente != $codice_utente";

                $recensioni = $conn->query($sql) or erredirect($conn->errno+300, $conn->error);

                while($recensione = $recensioni->fetch_assoc()){
                    $query = "SELECT * 
                    FROM account
                    WHERE codice_utente = ". $recensione['codice_utente'];
                    $tmp = $conn->query($query) or erredirect($conn->errno, $conn->error);
                    $tmp = $tmp->fetch_assoc();
                    $tmp_nick = $tmp['nickname'];
                    echo "<div class='mt3 mb3'>
                    <h3>$tmp_nick ";
                    //  ciclo per la valutazione
                    $stelle = $recensione['valutazione'];
                    for ($i=0; $i < $stelle; $i++) { 
                        echo"<span class='dot star'></span>";
                    }
                    $stelle_rimanenti = 5 - $stelle;
                    for ($i=0; $i < $stelle_rimanenti; $i++) { 
                        echo"<span class='dot'></span>";
                    }
                    echo "
                    <p class='txtjustify'>".$recensione['testo']."</p>
                    
                </div>
                <div class='separator'></div>";
                }
                ?>
            </div>


        </div>
    </div>
    <?php
    require('../components/footer.php');
    ?>
</body>

</html>