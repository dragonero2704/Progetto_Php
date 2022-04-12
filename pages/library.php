<?php
//code
require('../data/session.php');
//connessione al database
require('../data/db.php');
require('../data/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);
if(isset($_SESSION['nickname'])) $nickname = $_SESSION['nickname']; else $nickname = "";

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../data/head.php');
    ?>
    <title>Home</title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <h1 class="mauto">Libreria di <?php echo $nickname?></h1>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>