
<?php
if (basename($_SERVER["PHP_SELF"]) == 'index.php') {
    //links
    echo '<header>
            <div class="menu">
                <a href="./index.php" class="menu_voice">Home</a>
                <a href="./pages/library.php" class="menu_voice">La tua Libreria</a>
                <a href="./pages/shop.php" class="menu_voice">Negozio</a>
            </div>
        </header>';
} else {
    //modified links
    echo '<header>
            <div class="menu">
                <a href="../index.php" class="menu_voice">Home</a>
                <a href="./library.php" class="menu_voice">La tua Libreria</a>
                <a href="./shop.php" class="menu_voice">Negozio</a>
            </div>
        </header>';
}
?>