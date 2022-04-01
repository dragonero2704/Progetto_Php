<!-- 
    <header>
            <div class="menu">
                <a href="./index.php" class="menu_voice backglow">Home</a>
                <a href="./pages/shop.php" class="menu_voice backglow">Negozio</a>
            </div>

            <a href="./pages/account.php" class="right menu_voice backglow">Account</a>

        </header>
 -->
<?php
if (basename($_SERVER["PHP_SELF"]) === 'index.php') {
    //links
    if (isset($email)) {
        echo '<header>
            <div class="menu">
                <a href="./index.php" class="menu_voice backglow">Home</a>
                <a href="./pages/explore.php" class="menu_voice backglow">esplora</a>
                <a href="./pages/shop.php" class="menu_voice backglow">Negozio</a>
            </div>
            <a href="./pages/account.php" class="right menu_voice backglow">Account</a>
        </header>';
    } else {
        echo '<header>
            <div class="menu">
                <a href="./index.php" class="menu_voice backglow">Home</a>
                <a href="./pages/explore.php" class="menu_voice backglow">esplora</a>
                <a href="./pages/shop.php" class="menu_voice backglow">Negozio</a>
            </div>
            <a href="./pages/login.php" class="right menu_voice backglow">Login</a>
        </header>';
    }

    echo '<script src="./javascript/hamburger.js"></script>';

} else {
    //modified links
    if (isset($email)) {
        echo '<header>
            <div class="menu">
                <a href="../index.php" class="menu_voice backglow">Home</a>
                <!-- <a href="./library.php" class="menu_voice backglow">La tua Libreria</a> -->
                <a href="./explore.php" class="menu_voice backglow">esplora</a>
                <a href="./shop.php" class="menu_voice backglow">Negozio</a>
            </div>';
        if (basename($_SERVER['PHP_SELF']) === 'account.php') {
            echo '<a href="./logout.php" class="right menu_voice backglow">Logout</a>
            </header>';
        } else {
            echo '<a href="./account.php" class="right menu_voice backglow">Account</a>
            </header>';
        }
    } else {
        echo '<header>
            <div class="menu">
                <a href="../index.php" class="menu_voice backglow">Home</a>
                <a href="./explore.php" class="menu_voice backglow">esplora</a>
                <a href="./shop.php" class="menu_voice backglow">Negozio</a>
            </div>

            <a href="./login.php" class="right menu_voice backglow">Login</a>

        </header>';
    }

    echo '<script src="../javascript/hamburger.js"></script>';
}
?>