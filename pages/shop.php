<?php
//code
session_start();
$email = NULL;
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
//connessione al database?
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../data/head.php')
    ?>
    <title>Shop</title>
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