<?php
require('../data/session.php');
$query = array();
$results = array();

$fieldsearch = array('name', 'software_house', 'genere', 'description');
$search = isset($_GET['search']) ? urldecode($_GET['search']) : "";

require('../data/db.php');
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);

$query = "SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
        FROM giochi
        WHERE titolo LIKE '%$search%'

        UNION

        SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
        FROM giochi JOIN sviluppato ON sviluppato.codice_gioco = giochi.codice_gioco
        JOIN software_house ON sviluppato.software_house = software_house.codice_software_house
        WHERE software_house.nome LIKE '%$search%'
        GROUP BY giochi.codice_gioco

        UNION

        SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
        FROM giochi JOIN sviluppato ON sviluppato.codice_gioco = giochi.codice_gioco
        JOIN software_house ON sviluppato.software_house = software_house.codice_software_house
        WHERE software_house.nome LIKE '%$search%'
        GROUP BY giochi.codice_gioco 

        -- UNION
        -- SELECT giochi.codice_gioco, titolo, descrizione, pegi, prezzo
        -- FROM giochi
        -- WHERE descrizione LIKE '%$search%' 
     ";

$result = $conn->query($query) or die($conn->error);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../data/head.php')
    ?>
    <title>Esplora</title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <!-- search bar -->
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="get">
        <div class="search_wrapper">
            <div class="search_container mt8">
                <input type="search" name="search" class="search" id="" placeholder="Search..." value="<?php echo htmlentities($search)?>">
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
            while ($row = $result->fetch_assoc()) {
                echo '<a class="game" href="product.php?game=' . $row['codice_gioco'] . '">
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