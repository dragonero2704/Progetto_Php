<?php
//code
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);

if (empty($email)) header('location: login.php');
//GET dell'articolo
if (isset($_GET['game'])) $codice_gioco = urldecode($_GET['game']);
else header('location: explore.php');
//controllo che il gioco non sia già posseduto
$query = "SELECT *
FROM possiede
WHERE codice_gioco = $codice_gioco AND codice_utente = '$codice_utente'";

$ris = $conn->query($query);
if ($ris->num_rows > 0) {
    //gioco posseduto, redirect alla pagina prodotto
    header("location: product.php?game=$codice_gioco");
}
//altrimenti continua
if (isset($_POST['confermare'])) {
    //La pagina è stata ricaricata per confermare l'acquisto del gioco
    $conferma = true;
    $refreshtime = 3;
    header("refresh:$refreshtime; url=library.php");
    $inserimento = "INSERT INTO possiede (codice_utente, codice_gioco, data_acquisto)
VALUES ( '" . $codice_utente . "', '" . $codice_gioco . "', '" . date("Y-m-d", time()) . "')
";
} else {
    //la pagina è stata chiamata col metodo GET da product.php
    $conferma = false;
    //trovo il gioco
    $query = "SELECT *
FROM giochi
WHERE codice_gioco = $codice_gioco";

    $ris = $conn->query($query);
    $dati_gioco = $ris->fetch_assoc();
}


if ($conferma) {
    $conn->query('SET FOREIGN_KEY_CHECKS=0;');
    $conn->query($inserimento) or die($conn->error);
    $conn->query('SET FOREIGN_KEY_CHECKS=1;');
    $acquistato = true;
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../components/head.php')
    ?>
    <title><?php echo $dati_gioco['titolo'] ?></title>
</head>

<body>
    <?php
    require('../components/menu.php');
    ?>
    <div class="body">
        <?php

        if ($conferma) {
            echo '<h1>Acquisto effettuato con successo</h1>
                    <br>
                    <h2>sarai reindirizzato al negozio tra <span id="refreshseconds">' . $refreshtime . '</span></h2>
                    <script>
                    let el = document.getElementById("refreshseconds")
                        setInterval(function() {
                        let number = parseInt(el.innerHTML)
                        el.innerHTML = number - 1
                    }, 1000)
                </script>';
        } else {
            echo '<div class="generalita">
                    <h1 class="mb3 mt8">Acquista - ' . $dati_gioco['titolo'] . '</h1>
                    <img src="../media/games/' . $dati_gioco['codice_gioco'] . '/banner.jpg" alt="">
                    <form action="' . htmlentities($_SERVER['PHP_SELF']) . '?game=' . $codice_gioco . '" method="post">
                        <input class="group scalehover mt4 pulsante_acquisto" type="submit" name="confermare" value="ACQUISTA ' . $dati_gioco['prezzo'] . '€">
                    </form>
                    </div>
                    ';
        }

        ?>
    </div>
    <?php
    require('../components/footer.php');
    ?>
    <option value=""></option>
</body>

</html>