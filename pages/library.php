<?php
//code
require('../components/session.php');
//connessione al database
require('../data/db.php');
require('../components/errorredicrect.php');

if(empty($email)) header('location: login.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);
if (isset($_SESSION['nickname'])) $nickname = $_SESSION['nickname'];
else $nickname = "";
if (isset($_SESSION['codice_utente'])) $codice_utente = $_SESSION['codice_utente'];
else $codice_utente = "";


$search = isset($_GET['search']) ? $search = $_GET['search'] : $search = "";

if (empty($search)) {
    $query = "SELECT *
    FROM possiede JOIN giochi ON possiede.codice_gioco = giochi.codice_gioco
    WHERE codice_utente = $codice_utente";

    $ris = $conn->query($query);
    error_reporting(E_ALL ^ E_WARNING);
    if ($ris->num_rows > 0) {
        $games = array();

        while ($row = $ris->fetch_assoc()) {
            array_push($games, $row);
        }
    }
} else {
    $query = "SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
    FROM giochi
    WHERE titolo LIKE '%$search%'

    UNION

    SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
    FROM giochi JOIN software_house ON giochi.software_house = software_house.codice_software_house
    WHERE software_house.nome LIKE '%$search%'
    GROUP BY giochi.codice_gioco

    -- UNION
    -- SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
    -- FROM giochi
    -- WHERE descrizione LIKE '%$search%'  
     ";
    $ris = $conn->query($query);
    $games = array();

    if ($ris->num_rows > 0) {
        $games = array();

        while ($row = $ris->fetch_assoc()) {
            array_push($games, $row);
        }
    }
}
error_reporting(E_ALL);
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
    <title>Home</title>
</head>

<body>
    <?php
    require('../components/menu.php');
    ?>
    <div class="body">
        

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="get">
        
            <div class="search_wrapper mt8">
            <h1 class="mauto mb3">La tua libreria</h1>
                <div class="search_container">
                    <input type="search" name="search" class="search" id="" placeholder="Search..." value="<?php echo htmlentities($search) ?>">
                    <div class="searchbutton">
                        <input type="submit" value="">
                        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                    </div>
                </div>
            </div>
        </form>

        <div class="result mt3">
            <!-- roba che esce con search -->
            <?php
            if (!empty($games)) {
                foreach ($games as $game) {
                    echo '<a class="game scalehover" href="product.php?game=' . $game['codice_gioco'] . '">
                <div class="img_container">
                    <img src="../media/games/' . $game['codice_gioco'] . '/preview.jpg" alt=" ">
                </div>
                <h2>' . $game['titolo'] . '</h2>
            </a>';
                }
            }else{
                echo "<p>La libreria è vuota</p>";
            }
            ?>
        </div>

    </div>
    <?php
    require('../components/footer.php');
    ?>
</body>
<script>
    ScrollReveal().reveal('.game', {
            easing: 'cubic-bezier(.215,.61,.355,1)',
            // distance: '100px'
            duration: 800,
            distance: '1000px',
        });

</script>
</html>