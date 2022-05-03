<?php
//code
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);

if (isset($_GET['search']) and !empty($_GET['search'])) {
    $search = urldecode($_GET['search']);
} else {
    $search = "";
}

if (isset($search) and !empty($search) and $search != " ") {
    $search = trim($search);
    $sql = "SELECT*
        FROM discussione
        WHERE titolo LIKE '%$search%' OR descrizione LIKE '%$search%'";
} else {
    $sql = "SELECT *
        FROM discussione";
}

if (isset($_POST["elimina"])) {
    if ($_POST["elimina"]) {
        $trova = intval(urldecode($_GET["d"]));
        $elimina_messaggi = "DELETE FROM messaggio WHERE codice_discussione='$trova'";
        $elimina_discussione = "DELETE FROM discussione WHERE codice_discussione='$trova'";
        $conn->query('SET FOREIGN_KEY_CHECKS=0;');
        $conn->query($elimina_messaggi);
        $conn->query($elimina_discussione);
        $conn->query('SET FOREIGN_KEY_CHECKS=1;');
    }
}

$ris = $conn->query($sql);

if (isset($_POST["titolo"]) && isset($_POST["descrizione"])) {
    $sql = "SELECT *
    FROM account
    WHERE email = '$email'";
    $tmp1 = $conn->query($sql);
    $tmp1 = $tmp1->fetch_assoc();
    $codice_utente = $tmp1["codice_utente"];
    $data = date("Y-m-d", time());
    $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);
    $descrizione = mysqli_real_escape_string($conn, $_POST["descrizione"]);
    $inserimento = "INSERT INTO discussione (creatore, data_creazione, titolo, descrizione)
    VALUES ( '" . $codice_utente . "', '" . $data . "', '" . $titolo . "', '" . $descrizione . "')";
    $conn->query($inserimento);
    header("location:" . $_SERVER['PHP_SELF'] . "");
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
        <div class="max-container mb3">
            <h1 class="mt8">Discussioni</h1>
            <?php if (!empty($email)) echo "<h3 class='mt1 mb3'><a href='#scriviticket'>Chiedi aiuto</a></h3>"; ?>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="get">

                <div class="search_container mt3 mb3">
                    <input type="search" name="search" class="search " id="" placeholder="Search..." value="<?php if(!empty($search)) echo htmlentities($search); ?>">
                    <div class="searchbutton">
                        <input type="submit" value="">
                        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                    </div>
                </div>

            </form>
            <?php
            while ($dati_discussione = $ris->fetch_assoc()) {
                $cod = $dati_discussione["creatore"];
                $codice_discussione = $dati_discussione["codice_discussione"];

                $sql = "SELECT *
            FROM account
            WHERE codice_utente = '$cod'";

                $tmp = $conn->query($sql);
                $tmp = $tmp->fetch_assoc();
                $nome = $tmp["nickname"];
                $mail = $tmp["email"];
                echo '
                <div class="generalita sopra">';
                echo '<a href="discussione.php?d=' . $dati_discussione["codice_discussione"] . '">
                <h2 class = "centered">' . $dati_discussione["titolo"] . '</h1>
                <p class = "centered">' . $dati_discussione["descrizione"] . '</p>
                <p class = "centered">' . $nome . '</p>
                <p class = "centered">' . $dati_discussione["data_creazione"] . '</p>
                </a>';

                if ($mail == $email) {
                    echo '<form class="eliminare" action="' . $_SERVER['PHP_SELF'] . '?d=' . $codice_discussione . '" method="post">
                    <input type="submit" class="meno" name="elimina" value="true">
                    </form>';
                }

                echo '</div>';
            }
            ?>
            <?php


            if (isset($email) && !empty($email)) {
                echo '<div class="separator"></div>
    <h1 class = "mt1" id="scriviticket" >Crea una nuova discussione</h1>
<div class = "create_form">
<form action="' . htmlentities($_SERVER['PHP_SELF']) . '" method="post">
<div class="input_container mt3">
    <input type="text" name="titolo" id="titolo" placeholder=" " required>
    <label for="titolo">titolo</label>
</div>

<div class="textarea_container mt3">
<textarea name="descrizione" id="" cols="30" rows="10" placeholder="Descrivi il tuo problema..." required></textarea>
</div>

<div class="submitbtn backglow mt3">
    <input type="submit" class="" value="crea" name="crea">
</div>
</form>
</div>';
            } else {
                echo '<h1 class = "centered mauto" >Registrati per chiedere aiuto</h1>';
            }
            ?>

        </div>
        <?php
        require('../components/footer.php');
        ?>
</body>

</html>