<?php
//code
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);

$sql ="SELECT *
FROM discussione";

$ris = $conn->query($sql);
if(isset($_POST["titolo"]) && isset($_POST["descrizione"]))
{
    $sql = "SELECT *
    FROM account
    WHERE email = '$email'";
    $tmp1 = $conn->query($sql);
    $tmp1 = $tmp1->fetch_assoc();
    $codice_utente = $tmp1["codice_utente"];
    $data = date("Y-m-d", time());
    $titolo = $_POST["titolo"];
    $descrizione = $_POST["descrizione"];
    $inserimento = "INSERT INTO discussione (creatore, data_creazione, titolo, descrizione)
    VALUES ( '" . $codice_utente . "', '" . $data . "', '" . $titolo . "', '" . $descrizione . "')";
    $conn->query($inserimento);
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
    <title>Aiuto</title>
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
                <input type="text" name="titolo" id="titolo" placeholder=" " required>
                <label for="titolo">titolo</label>
            </div>
            <div class="input_container">
                <input type=text" name="descrizione" id="descrizione" placeholder=" " required>
                <label for="descrizione">descrizione</label>
            </div>
            <div class="submitbtn backglow">
                <input type="submit" class="" value="crea" name="crea">
            </div>
            </form>
            </div>';
        }else{
            echo "<h1>registrati per chiedere aiuto</h1>";
        }
        while ($dati_discussione = $ris->fetch_assoc()) {
            $cod = $dati_discussione["creatore"];
            $sql="SELECT *
            FROM account
            WHERE codice_utente = '$cod'";
            $tmp = $conn->query($sql);
            $tmp = $tmp->fetch_assoc();
            $nome = $tmp["nome"] . " " . $tmp["cognome"];
            if(empty($nome) or $nome == " ") $nome = "anonimo";
            echo '
                <a href="discussione.php?codice_discussione='.$dati_discussione["codice_discussione"].'">
                <div class="generalita">
                <h1 class="mb3 mt8">' . $dati_discussione["titolo"] . '</h1>
                <p>'.$dati_discussione["descrizione"].'</p>
                <p>'.$nome.'</p>
                <p>'.$dati_discussione["data_creazione"].'</p>
                </div>
                </a>
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