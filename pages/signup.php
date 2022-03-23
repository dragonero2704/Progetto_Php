<?php
session_start();

$error = array();
$userdata = array();

$userfields = array('email', 'password', 'confermapassword', 'nome', 'cognome', 'nickname', 'nazionalita', 'data_nascita', 'telefono', 'email_recupero');

foreach ($userfields as $field) {
    if (isset($_POST[$field])) $userdata[$field] = $_POST[$field];
    else $userdata[$field] = "";
}

//connessione al database
require('../data/db.php');
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die('connection error'.$conn->connect_error);

//controlli
$email = $userdata['email'];
$query_controllo_mail = "
SELECT email
FROM account
WHERE email='$email'
";

$ris = $conn->query($query_controllo_mail) or die($conn->error);
if($ris->num_rows !=0){
    $error['email'] = 'Un account è già associato a questa email';
}

//se alla fine di tutti i controlli l'array error è vuoto, allora la registrazione è andata a buon fine
if(count($error) === 0){
    $registration_query = "
        INSERT INTO account (email, password, nickname, nome, cognome, telefono, email_recupero, data_nascita, nazionalita)
        VALUES ('".$userdata['email']."','".$userdata['password']."','".$userdata['nickname']."','".$userdata['nome']."','".$userdata['cognome']."','".$userdata['telefono']."','".$userdata['email_recupero']."','".$userdata['data_nascita']."','".$userdata['nazionalita'].")
    ";

    
}


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

    <title>Sign Up</title>
</head>

<body>
    <header>
        <a href="../index.php" class="menu_voice backglow">Home</a>
        <a href="./login.php" class="menu_voice backglow right">
            <nobr>Login</nobr>
        </a>

    </header>

    <div class="body">
        <div class="login_container mt5 mb5">
            <h1>Sign up</h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off">
                <div class="err<?php if (!isset($error['email'])) echo ' hidden'; ?>"><?php if (isset($error['email'])) echo $error['email'] ?></div>

                <div class="input_container mb2">
                    <input type="email" id="email" name="email" value="<?php echo $userdata['email']; ?>" placeholder="" required>
                    <label for="email">email</label>
                </div>
                <div class="err<?php if (!isset($error['password'])) echo ' hidden'; ?>"><?php if (isset($error['password'])) echo $error['password'] ?></div>
                <div class="input_container mb2">

                    <input type="password" name="password" id="password" value="<?php echo $userdata['password']; ?>" placeholder="" required>
                    <label for="password">password</label>
                    <span id="eye" class="mr3">Show</span>

                </div>
                <div class="err<?php if (!isset($error['confermapassword'])) echo ' hidden'; ?>"><?php if (isset($error['confermapassword'])) echo $error['confermapassword'] ?></div>
                <div class="input_container mb2">
                    <input type="password" name="confermapassword" id="confermapassword" value="<?php echo $userdata['confermapassword']; ?>" placeholder="" required>
                    <label for="confermapassword">conferma password</label>

                </div>
                <div class="err<?php if (!isset($error['nome'])) echo ' hidden'; ?>"><?php if (isset($error['nome'])) echo $error['nome'] ?></div>
                <div class="input_container mb2">
                    <input type="text" id="nome" name="nome" value="<?php echo $userdata['nome']; ?>" placeholder="" required>
                    <label for="nome">nome</label>

                </div>
                <div class="err<?php if (!isset($error['cognome'])) echo ' hidden'; ?>"><?php if (isset($error['cognome'])) echo $error['cognome'] ?></div>
                <div class="input_container mb2">
                    <input type="text" id="cognome" name="cognome" value="<?php echo $userdata['cognome']; ?>" placeholder="" required>
                    <label for="cognome">cognome</label>

                </div>
                <div class="err<?php if (!isset($error['nickname'])) echo ' hidden'; ?>"><?php if (isset($error['nickname'])) echo $error['nickname'] ?></div>
                <div class="input_container mb2">
                    <input type="text" id="nickname" name="nickname" value="<?php echo $userdata['nickname']; ?>" placeholder="">
                    <label for="nickname">nickname</label>

                </div>
                <div class="err<?php if (!isset($error['data_nascita'])) echo ' hidden'; ?>"><?php if (isset($error['data_nascita'])) echo $error['data_nascita'] ?></div>
                <div class="input_container mb2">
                    <input type="date" id=data_nascita" name="data_nascita" value="<?php echo $userdata['data_nascita']; ?>" placeholder="" required>
                    <label for="data_nascita">Data di nascita</label>
                </div>

                <div class="err<?php if (!isset($error['nazionalita'])) echo ' hidden'; ?>"><?php if (isset($error['nazionalita'])) echo $error['nazionalita'] ?></div>
                <div class="input_container mb2">
                    <input type="text" id=nazionalita" name="nazionalita" value="<?php echo $userdata['nazionalita']; ?>" placeholder="">
                    <label for="nazionalita">nazionalita</label>
                </div>

                <div class="err<?php if (!isset($error['telefono'])) echo ' hidden'; ?>"><?php if (isset($error['telefono'])) echo $error['telefono'] ?></div>
                <div class="input_container mb2">
                    <input type="tel" id=telefono" name="telefono" value="<?php echo $userdata['telefono']; ?>" placeholder="" pattern="[0-9]{2}-[0-9]{3}-[0-9]{3}--[0-9]{3}">
                    <label for="telefono">numero di telefono</label>
                </div>

                <div class="err<?php if (!isset($error['email_recupero'])) echo ' hidden'; ?>"><?php if (isset($error['email_recupero'])) echo $error['email_recupero'] ?></div>
                <div class="input_container mb2">
                    <input type="email" id=email_recupero" name="email_recupero" value="<?php echo $userdata['email_recupero']; ?>" placeholder="">
                    <label for="email_recupero">Email recupero</label>
                </div>



                <div class="submitbtn backglow mt2">
                    <input type="submit" class="" value="Sign up" name="Sign_up">
                </div>
            </form>
        </div>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>

<script src="../javascript/psw.js"></script>