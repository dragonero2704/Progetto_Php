<?php
//code
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);

if (empty($email)) header('location: login.php');

if (isset($_GET["codice_discussione"]))
{
    $codice_discussione = $_GET["codice_discussione"];
    $_SESSION["codice_discussione"] = $codice_discussione;
} else {
    $codice_discussione = $_SESSION["codice_discussione"];
}

$sql ="SELECT *
FROM messaggio
WHERE codice_discussione = '$codice_discussione'";

$ris = $conn->query($sql);

if(isset($_POST["messaggio"]))
{
    $sql = "SELECT *
    FROM account
    WHERE email = '$email'";
    $tmp1 = $conn->query($sql);
    $tmp1 = $tmp1->fetch_assoc();
    $codice_utente = $tmp1["codice_utente"];
    $messaggio = $_POST["messaggio"];
    $inserimento = "INSERT INTO messaggio (codice_utente, codice_discussione, testo)
    VALUES ( '" . $codice_utente . "', '" . $codice_discussione . "', '" . $messaggio . "')";
    $conn->query('SET FOREIGN_KEY_CHECKS=0;');
    $conn->query($inserimento);
    $conn->query('SET FOREIGN_KEY_CHECKS=1;');
    header("location:".$_SERVER['PHP_SELF']."");
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
    <title></title>
</head>

<body>
    <?php
    require('../components/menu.php');
    ?>
    <div class="body">
        <?php
        if(isset($email) && !empty($email))
        {
            echo '<div>
            <form action="'. htmlentities($_SERVER['PHP_SELF']) .'" method="post">
            <div class="input_container">
                <input type="text" name="messaggio" id="titolo" placeholder=" " required>
                <label for="titolo">messaggio</label>
            </div>
            <div class="submitbtn backglow">
                <input type="submit" class="" value="invia" name="invia">
            </div>
            </form>
            </div>';
        }

        while ($dati_messaggio = $ris->fetch_assoc()) {
            $cod = $dati_messaggio["codice_utente"];
            $sql = "SELECT *
            FROM account
            WHERE codice_utente = '$cod'";
            $tmp = $conn->query($sql);
            $tmp = $tmp->fetch_assoc();
            $nome = $tmp["nome"] . " " . $tmp["cognome"];
            if(empty($nome) or $nome == " ") $nome = "anonimo";
            echo '
                <div class="generalita">
                <h1 class="mb3 mt8">' . $nome . '</h1>
                <p>'.$dati_messaggio["testo"].'</p>
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