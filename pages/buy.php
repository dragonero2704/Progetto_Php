<?php
//code
require('../data/session.php');
require('../data/db.php');
require('../data/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);

if(empty($email)) header('location: login.php');
//connessione al database?
//GET dell'articolo
if(isset($_GET['game'])) $codice_gioco = urldecode($_GET['game']); else header('location: explore.php');

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

$data_oggi=date("d/m/Y", time());

$inserimento = "INSERT INTO possiede (codice_utente, codice_gioco, data_acquisto)
VALUES ( '" . $dati_utente['codice_utente'] . "', '" . $dati_gioco['codice_gioco'] . "', '" . date("d/m/Y", time()) . "')
";

$conn->query('SET FOREIGN_KEY_CHECKS=0;');
$conn->query($inserimento) or die($conn->error);
$conn->query('SET FOREIGN_KEY_CHECKS=1;');

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
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>