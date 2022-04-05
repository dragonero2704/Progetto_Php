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
    $userdata = $ris;
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
        <div class="login_container mauto">
            <h1 class="mb3">Personalizza il tuo account</h1>
            <div class="input_container mb3">
                <input type="email" name="email" id="email" value="<?php echo $userdata['email']; ?>" placeholder=" ">
                <label for="email">email</label>
            </div>
            <div class="input_container mb2">
                    <input type="text" id="nome" name="nome" value="<?php echo $userdata['nome']; ?>" placeholder=" ">
                    <label for="nome">nome</label>

                </div>
                <div class="input_container mb2">
                    <input type="text" id="cognome" name="cognome" value="<?php echo $userdata['cognome']; ?>" placeholder=" ">
                    <label for="cognome">cognome</label>

                </div>
                <div class="input_container mb2">
                    <input type="text" id="nickname" name="nickname" value="<?php echo $userdata['nickname']; ?>" placeholder=" ">
                    <label for="nickname">nickname</label>

                </div>
                <div class="input_container mb2">
                    <input type="date" id=data_nascita" name="data_nascita" value="<?php echo $userdata['data_nascita']; ?>" placeholder=" ">
                    <label for="data_nascita">Data di nascita</label>
                </div>

                <div class="input_container mb2">
                    <input type="text" id=nazionalita" name="nazionalita" value="<?php echo $userdata['nazionalita']; ?>" placeholder=" ">
                    <label for="nazionalita">nazionalita</label>
                </div>

                <div class="input_container mb2">
                    <input type="tel" id=telefono" name="telefono" value="<?php echo $userdata['telefono']; ?>" placeholder=" " pattern="^{2}\d{3}\d{3}\d{4}">
                    <label for="telefono">numero di telefono</label>
                </div>

                <div class="input_container mb2">
                    <input type="email" id=email_recupero" name="email_recupero" value="<?php echo $userdata['email_recupero']; ?>" placeholder=" ">
                    <label for="email_recupero">Email recupero</label>
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