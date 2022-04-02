
<?php
session_start();
//se non si è loggati, rimanda alla pagina di login
if(isset($_SESSION['email'])) $email = $_SESSION['email'];
if(isset($_SESSION['nickname'])) $nickname = $_SESSION['nickname'];

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
    <title>Account</title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <h1>Modifica il tuo account</h1>
        
    </div>
<?php
    require('../data/footer.php');
    ?>
</body>

</html>