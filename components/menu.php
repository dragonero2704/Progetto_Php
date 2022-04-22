<?php
//modified links
$nickname = isset($_SESSION['nickname']) ? $nickname = $_SESSION['nickname'] : $nickname = "Account";
$codice_utente = isset($_SESSION['codice_utente']) ? $codice_utente = $_SESSION['codice_utente'] : $codice_utente = "";
$defaultpath = '../media/account/defaultuser.jpg';
if (file_exists("../media/account/$codice_utente.jpg")) {
    $path = "../media/account/$codice_utente.jpg";
} else {
    $path = $defaultpath;
}
if (isset($email)) {
    echo '<header>
            <div class="menu">
                <a href="../index.php" class="menu_voice backglow">Home</a>
                <a href="./explore.php" class="menu_voice backglow">esplora</a>
                <a href="./shop.php" class="menu_voice backglow">Negozio</a>
                <a href="./help.php" class="menu_voice backglow">Aiuto</a>
            </div>';
    if (basename($_SERVER['PHP_SELF']) === 'account.php') {
        echo '<a href="./logout.php" class="right menu_voice backglow">Logout</a>
            </header>';
    } else {
        echo "<a href='./account.php' class='right menu_voice backglow'><img src='$path'></a>
            </header>";
    }
} else {
    echo '<header>
            <div class="menu">
                <a href="../index.php" class="menu_voice backglow">Home</a>
                <a href="./explore.php" class="menu_voice backglow">esplora</a>
                <a href="./shop.php" class="menu_voice backglow">Negozio</a>
                <a href="./help.php" class="menu_voice backglow">Aiuto</a>
            </div>

            <a href="./login.php" class="right menu_voice backglow">Login</a>

        </header>';
}

echo '<script src="../javascript/hamburger.js"></script>';
