<?php
require('../data/session.php');

if (isset($_GET['search'])) {
    $search = urldecode($_GET['search']);
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
    <title>Esplora</title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <!-- search bar -->
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="get">
            <div class="search_container mt8">
                <input type="search" name="search" class="search" id="" placeholder="Search...">
                <div class="searchbutton">
                    <input type="submit" value="">
                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                </div>
            </div>


        </form>

        <div class="result">
            <!-- roba che esce con xhtpp -->
        </div>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>