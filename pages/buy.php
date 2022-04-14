<?php
//code
require('../data/session.php');
require('../data/db.php');
require('../data/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);

if(empty($email)) header('location: login.php');
//connessione al database?
//GET dell'articolo
if(isset($_SESSION['codice_gioco'])) $codice_gioco = urldecode($_SESSION['codice_gioco']); else header('location: explore.php');

//trovo l'utente

$query = "SELECT *
FROM account
WHERE email = '$email'";

$ris = $conn->query($query);
$dati_utente = $ris->fetch_assoc();

//trovo il gioco
$query = "SELECT *
FROM giochi
WHERE codice_gioco = $codice_gioco";

$ris=$conn->query($query);
$dati_gioco = $ris->fetch_assoc();

$inserimento = "INSERT INTO possiede (codice_utente, codice_gioco, data_acquisto)
VALUES ( '" . $dati_utente['codice_utente'] . "', '" . $dati_gioco['codice_gioco'] . "', '" . date("d/m/Y", time()) . "')
";

//controllo che il gioco non sia già posseduto

$query = "SELECT *
FROM possiede
WHERE codice_gioco = $codice_gioco AND codice_utente = '$dati_utente[codice_utente]'";

$ris = NULL;
$ris=$conn->query($query);

$attiva=true;

if($ris->num_rows != 0)
{
    $attiva=false;
    header("refresh:3;url=shop.php");
}

$conferma=false;

if(isset($_POST['confermare']))
{
    $conferma = true;
}

$acquistato = false;

if($conferma)
{
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
    require('../data/head.php')
    ?>
    <title><?php echo $dati_gioco['titolo'] ?></title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <?php
            if($attiva)
            {
                if($acquistato)
                {
                    echo '<h1>Acquisto effettuato con successo</h1>
                    <br>
                    <h2>sarai reindirizzato al negozio tra pochi secondi</h2>';
                    header("refresh:3;url=shop.php");
                } else {
                    echo '<div class="generalita">
                    <h1>' . $dati_gioco['titolo'] . '</h1>
                    <img src="../media/games/' . $dati_gioco['codice_gioco'] . '/banner.jpg" alt="">
                    </div>
                    <form action="' . htmlentities($_SERVER['PHP_SELF']) . '" method="post">
                        <input class="group scalehover mt4 pulsante_acquisto" type="submit" name="confermare" value="ACQUISTA ' . $dati_gioco['prezzo'] . '€">
                    </form>';
                }
            } else {
                echo '<h1>Ooops, possiedi già questo gioco</h1>
                <br>
                <h2>sarai reindirizzato al negozio tra pochi secondi</h2>';
            }
        ?>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>