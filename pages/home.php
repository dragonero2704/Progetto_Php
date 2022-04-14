<?php
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);


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
    <title>Home</title>
</head>

<body>
    <?php
    require('../components/menu.php');
    ?>
    <div class="body">
       
    </div>
    <?php
    require('../components/footer.php');
    ?>
</body>

</html>