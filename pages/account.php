<?php
require('../data/session.php');
require('../data/db.php');
require('../data/errorredicrect.php');

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno, $conn->connect_error);

$sql = "
SELECT *
FROM account
WHERE email='$email'
";

$ris = $conn->query($sql) or die($conn->error);

if ($ris->num_rows > 0) {
    $ris = $ris->fetch_assoc();
    $userdata = $ris;
}

$codice =  isset($userdata['codice_utente']) ? $userdata['codice_utente'] : $userdata['codice_account'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = array();
    $fields = array();

    $cartella_upload = "../media/account/";
    $img = "" . $codice . ".jpg";
    if (trim($_FILES["upload"]["name"]) == '') {
     
        if (!is_uploaded_file($_FILES["profileimg"]["tmp_name"]) or $_FILES["profileimg"]["error"] > 0) {
            echo 'Si sono verificati problemi nella procedura di upload!';
        }
        if (!is_dir($cartella_upload)) {
            echo 'La cartella in cui si desidera salvare il file non esiste!';
        }
        if (!is_writable($cartella_upload)) {
            echo "La cartella in cui fare l'upload non ha i permessi!";
        }
        if (!move_uploaded_file($_FILES["profileimg"]["tmp_name"], $cartella_upload . $img)) {
            echo 'Ops qualcosa è andato storto nella procedura di upload!';
        }
    }
   
}

$defaultpath = '../media/account/defaultuser.jpg';
if (file_exists("../media/account/$codice.jpg")) {
    $path = "../media/account/$codice.jpg";
} else {
    $path = $defaultpath;
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
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">

            <div class="login_container mauto">
                <h1 class="mb3">Personalizza il tuo account</h1>
                <div class="profilepic_container mb2">
                    <img src="<?php echo $path ?>" alt="../media/account/defaultuser.jpg">
                    <label for="uploadfile">Sfoglia...</label>

                    <input type="file" name="profileimg" id="uploadfile" class="hidden">
                </div>
                <div class="input_container mb3">
                    <input type="email" id="email" value="<?php echo $userdata['email']; ?>" placeholder=" " disabled aria-hidden="true">
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
        </form>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

<script>
    //async update
</script>

</html>