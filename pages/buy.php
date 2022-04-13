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

//trovo il gioco
$query = "
SELECT *
FROM giochi
WHERE codice_gioco = $codice_gioco";

$ris=$conn->query($query);
$dati_gioco = $ris->fetch_assoc();


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
    <div class="body"></div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>