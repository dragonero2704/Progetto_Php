<?php
require('../data/session.php');

if(isset($_GET['search'])){
    $search = urldecode($_GET['search']);
}
require('../data/session.php');

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
        
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>