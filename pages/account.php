<?php
require('../data/session.php');

require('../data/db.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);

$sql = "
SELECT *
FROM account
WHERE email='$email'
";

$ris = $conn->query($sql) or die($conn->error);

if($ris->num_rows>0){
    $ris=$ris->fetch_assoc();
    $accountdata = $ris;
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
    <title>Account</title>
</head>

<body>
    <?php
    require('../data/menu.php');
    ?>
    <div class="body">
        <div class="login_container">
            <h1 class="mt3 mb3">Modifica il tuo account</h1>
            <div class="input_container mb3">

                    <input type="email" name="email" id="email" value="<?php echo $accountdata['email']; ?>" placeholder=" ">
                    <label for="email">email</label>
                </div>
        </div>

    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

<script>
    //async update
</script>

</html>