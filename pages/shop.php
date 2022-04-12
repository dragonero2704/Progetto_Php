<?php
//code
require('../data/session.php');
require('../data/db.php');
require('../data/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);

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
                <div class="content mr7">
                    <h1><?php echo $gamedata['titolo']; ?></h1>
                    <p> <?php echo $gamedata['descrizione']; ?> </p>
                    <a href="./product.php?game=<?php echo $game_display; ?>" class="button group scalehover mt4">
                        Acquista ora
                    </a>
                </div>
            </div>


        </div>
    </div>

        <!-- barra di selezione tipo di ordine -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
            $("#menuButton").click(function(){
            $("#menu").slideToggle();
            }); 
        });

        </script>
        <!-- eventuale chiusura </head>, apertura <body> -->
        <button id="menuButton">Menu</button>
        <div id="menu" style="display:none;">
        <p>Ordina per:</p>
        <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <input type="submit" value="titolo" name="metodo">
            <input type="submit" value="Produttore" name="metodo">
            <input type="submit" value="Prezzo" name="metodo">
            <input type="submit" value="Pegi" name="metodo">
        </form>
        </div>


    <?php
    $trova_giochi = "
                SELECT *
                FROM giochi
            ";
            $ris=$conn->query($trova_giochi) or die ($conn->connect_error);
            if(isset($_POST['metodo']))
            {
                if($_post['metodo'] == 'Titolo'){}
            }
        ?>

    <div class="result mt3">
        <!-- roba che esce con search -->
        <?php
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
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>