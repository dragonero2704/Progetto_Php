<?php
if (isset($_GET['generi'])) {
    $generi = json_decode(urldecode($_GET['generi']));
} else {
    $generi = '';
}

if (isset($_GET['ordine'])) {
    $ordine = $_GET['ordine'];
} else {
    $ordine = '';
}

$generi_string = '(';

// echo $ordine;


if (empty($generi)) {
    $query = "SELECT *
        FROM giochi
    ";
    if (!empty($ordine)) {
        $query = $query . "\nORDER BY $ordine";
    }
} else {
    foreach ($generi as $genere) {
        $generi_string = $generi_string . "'$genere',";
    }

    $generi_string = substr($generi_string, 0, -1);
    $generi_string = $generi_string . ')';


    $query = "SELECT DISTINCT *
        FROM appartiene JOIN giochi ON appartiene.codice_gioco = giochi.codice_gioco
        WHERE appartiene.genere IN $generi_string
    ";
    if (!empty($ordine)) {
        $query = $query . "\n ORDER BY $ordine";
    }
}

// echo $query;

require('../data/db.php');
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die();
$ris = $conn->query($query) or die();

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
