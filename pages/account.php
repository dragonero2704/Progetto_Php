<?php
require('../components/session.php');
require('../data/db.php');
require('../components/errorredicrect.php');
if (empty($email)) die(header('location: login.php'));
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = array();
    $fields = array('nickname', 'nome', 'cognome', 'data_nascita', 'nazionalita', 'telefono', 'email_recupero');
    $error = array();

    foreach ($fields as $field) {
        if (isset($_POST[$field])) $data[$field] = $_POST[$field];
        else $data[$field] = '';
    }

    $cartella_upload = "../media/account/";
    $img = $codice_utente . ".jpg";

    if (!empty(trim($_FILES["upload"]["name"]))) {
        $tipi_consentiti = array('png', 'jpg', 'jpeg');
        if (!is_uploaded_file($_FILES["upload"]["tmp_name"]) or $_FILES["upload"]["error"] > 0) {
            $error['file'] = 'Si sono verificati problemi nella procedura di upload!';
        }
        if (!is_dir($cartella_upload)) {
            $error['file'] = 'La cartella in cui si desidera salvare il file non esiste!';
        }
        if (!is_writable($cartella_upload)) {
            $error['file'] = "La cartella in cui fare l'upload non ha i permessi!";
        }
        $file_extension = explode('.', $_FILES["upload"]["name"]);
        $file_extension = $file_extension[count($file_extension) - 1];

        if (!in_array($file_extension, $tipi_consentiti)) {
            $error['file'] = "Il file non è tra i tipi consentiti";
        }
        if (empty($error['file'])) {
            if (!move_uploaded_file($_FILES["upload"]["tmp_name"], $cartella_upload . $img)) {
                $error['file'] = 'Ops qualcosa è andato storto nella procedura di upload!';
            }
        }
    }

    foreach ($fields as $field) {
        if ($data[$field] != $userdata[$field]) {
            $update = "UPDATE account
            SET $field = '" . $data[$field] . "'
            WHERE email = '$email'";

            if ($field == 'nickname') {
                if (empty($data[$field])) {
                    $error[$field] = 'Il nickname non può essere vuoto';
                } else {
                    $_SESSION[$field] = $data[$field];
                    $nickname = $data[$field];
                }
            }

            if (empty($error[$field]))
                $conn->query($update);
        }
    }
    $ris = $conn->query($sql) or die($conn->error);

    if ($ris->num_rows > 0) {
        $ris = $ris->fetch_assoc();
        $userdata = $ris;
    }
}



$defaultpath = '../media/account/defaultuser.jpg';
if (file_exists("../media/account/$codice_utente.jpg")) {
    $path = "../media/account/$codice_utente.jpg";
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
    require('../components/head.php')
    ?>
    <title>Account -<?php echo $nickname ?></title>
</head>

<body>
    <?php
    require('../components/menu.php');
    ?>
    <div class="body">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <div class="login_container mauto">
                <h1 class="mb3">Personalizza il tuo account</h1>
                <div class="err<?php if (!isset($error['file'])) echo ' hidden'; ?>"><?php if (isset($error['file'])) echo $error['file'] ?></div>
                <div class="profilepic_container mb2">
                    <img src="<?php echo $path ?>" alt="../media/account/defaultuser.jpg">
                    <label for="uploadfile">Sfoglia...</label>
                    <input type="file" name="upload" id="uploadfile" class="hidden" onchange="">
                </div>
                <div class="input_container mb3">
                    <input type="email" id="email" value="<?php echo $userdata['email']; ?>" placeholder=" " disabled aria-hidden="true">
                    <label for="email">email</label>
                </div>
                <div class="input_container mb2">
                    <input type="text" id="nickname" name="nickname" value="<?php echo $userdata['nickname']; ?>" placeholder=" ">
                    <label for="nickname">nickname</label>

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
                    <input type="date" id="data_nascita" name="data_nascita" value="<?php echo $userdata['data_nascita']; ?>" placeholder=" ">
                    <label for="data_nascita" class="no-txt-transform">Data di nascita</label>
                </div>

                <div class="input_container mb2">
                    <input type="text" id="nazionalita" name="nazionalita" value="<?php echo $userdata['nazionalita']; ?>" placeholder=" ">
                    <label for="nazionalita">nazionalita</label>
                </div>

                <div class="input_container mb2">
                    <input type="tel" id="telefono" name="telefono" value="<?php echo $userdata['telefono']; ?>" placeholder=" " pattern="^{2}\d{3}\d{3}\d{4}">
                    <label for="telefono" class="no-txt-transform">Numero di telefono</label>
                </div>

                <div class="input_container mb2">
                    <input type="email" id="email_recupero" name="email_recupero" value="<?php echo $userdata['email_recupero']; ?>" placeholder=" ">
                    <label for="email_recupero" class="no-txt-transform">Email recupero</label>
                </div>

                <div class="submitbtn backglow mb2">
                    <input type="submit" class="" value="Salva" name="save">
                </div>
                <div class="submitbtn backglow">
                    <input type="reset" class="" value="Scarta" name="Cancel">
                </div>

            </div>
        </form>
    </div>
    <?php
    require('../components/footer.php');
    ?>
</body>

</html>