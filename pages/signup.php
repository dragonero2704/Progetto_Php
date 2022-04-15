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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../data/db.php');
    require('../components/errorredicrect.php');

    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or erredirect($conn->connect_errno,$conn->connect_error);

    //controlli
    //campi essenziali lasciati vuoti
    if(empty($userdata['email'])) $error['email'] = 'Inserire una email';
    if(empty($userdata['password'])) $error['password'] = 'Inserire una password';
    if(empty($userdata['nickname'])) $error['nickname'] = 'Inserire un nickname';

    
    //------------------------------------------------------------------------------------------------------
    //controllo email
    $email = $userdata['email'];
    $query_controllo_mail = "
SELECT email
FROM account
WHERE email='$email'
";

    $ris = $conn->query($query_controllo_mail) or die($conn->error);
    if ($ris->num_rows != 0) {
        $error['email'] = 'Un account è già associato a questa email';
    }
    //------------------------------------------------------------------------------------------------------
    //funzione di controllo password
    /** 
1 numero
caratteri speciali (!?@)
1 Maiuscola
     */
    function Validate($pass)
    {
        // return '';
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            return 'La password deve contenere almeno 8 caratteri di cui 1 carattere speciale, 1 numero e 1 mauiscola';
        } else {
            return '';
        }
    }
    if (!empty($userdata['password']) and !empty(Validate($userdata['password'])))
        $error['password'] = Validate($userdata['password']);

    //controllo password
    if ($userdata['password'] !== $userdata['confermapassword']) {
        $error['confermapassword'] = 'La password non coincide';
    }
    //se alla fine di tutti i controlli l'array error è vuoto, allora la registrazione è andata a buon fine
    if (sizeof($error) === 0) {
        if (!empty($userdata['password'])) $passwordhash = password_hash($userdata['password'], PASSWORD_DEFAULT);
        if (!empty($userdata['telefono'])) $userdata['telefono'] = str_replace(' ', '', $userdata['telefono']);

        $registration_query = "
                            INSERT INTO account (email, password, nickname, nome, cognome, telefono, email_recupero, data_nascita, nazionalita)
                            VALUES('" . $userdata['email'] . "','" . $passwordhash . "','" . $userdata['nickname'] . "','" . $userdata['nome'] . "','"
            . $userdata['cognome'] . "','" . $userdata['telefono'] . "','" . $userdata['email_recupero'] . "','" . $userdata['data_nascita'] . "','"
            . $userdata['nazionalita'] . "')";

        $conn->query($registration_query) or die($conn->error);

        $query = "SELECT codice_utente
        FROM account
        WHERE email = '".$userdata['email']."'";
        $ris = $conn->query($query);
        $codice_utente = $ris->fetch_assoc()['codice_utente'];
        $conn->close();

        $error['ok'] = 'ok';

        $_SESSION['email'] = $userdata['email'];
        $_SESSION['nickname'] = $userdata['nickname'];
        $_SESSION['cocice_utente'] = $codice_utente;
        $refreshtime = 5;
        header("refresh: $refreshtime; URL=../index.php");
    }
}

//------------------------------------------------------------------------------------------------------



?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require('../components/head.php');
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
        <div class="login_container mauto">
            <h1>Sign up</h1>
            <p class="mt2">Hai già un account? <a class="hoverglow bold inline" href="./login.php">Accedi</a></p>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off">
                <div class="err<?php if (!isset($error['email'])) echo ' hidden'; ?>"><?php if (isset($error['email'])) echo $error['email'] ?></div>

                <div class="input_container">
                    <input type="email" id="email" name="email" value="<?php echo $userdata['email']; ?>" placeholder=" " >
                    <label for="email">email*</label>
                </div>
                <div class="err<?php if (!isset($error['password'])) echo ' hidden'; ?>"><?php if (isset($error['password'])) echo $error['password'] ?></div>
                <div class="input_container">

                    <input type="password" maxlength="20" name="password" id="password" value="<?php echo $userdata['password']; ?>" placeholder=" " >
                    <label for="password">password*</label>
                    <span id="eye" class="mr3">Show</span>

                </div>
                <div class="err<?php if (!isset($error['confermapassword'])) echo ' hidden'; ?>"><?php if (isset($error['confermapassword'])) echo $error['confermapassword'] ?></div>
                <div class="input_container">
                    <input type="password" maxlength="20" name="confermapassword" id="confermapassword" value="<?php echo $userdata['confermapassword']; ?>" placeholder=" " >
                    <label for="confermapassword">conferma password*</label>

                </div>
                <div class="err<?php if (!isset($error['nome'])) echo ' hidden'; ?>"><?php if (isset($error['nome'])) echo $error['nome'] ?></div>
                <div class="input_container">
                    <input type="text" id="nome" name="nome" value="<?php echo $userdata['nome']; ?>" placeholder=" ">
                    <label for="nome">nome</label>

                </div>
                <div class="err<?php if (!isset($error['cognome'])) echo ' hidden'; ?>"><?php if (isset($error['cognome'])) echo $error['cognome'] ?></div>
                <div class="input_container">
                    <input type="text" id="cognome" name="cognome" value="<?php echo $userdata['cognome']; ?>" placeholder=" ">
                    <label for="cognome">cognome</label>

                </div>
                <div class="err<?php if (!isset($error['nickname'])) echo ' hidden'; ?>"><?php if (isset($error['nickname'])) echo $error['nickname'] ?></div>
                <div class="input_container">
                    <input type="text" id="nickname" name="nickname" value="<?php echo $userdata['nickname']; ?>" placeholder=" " >
                    <label for="nickname">nickname*</label>

                </div>
                <div class="err<?php if (!isset($error['data_nascita'])) echo ' hidden'; ?>"><?php if (isset($error['data_nascita'])) echo $error['data_nascita'] ?></div>
                <div class="input_container">
                    <input type="date" id="data_nascita" name="data_nascita" value="<?php echo $userdata['data_nascita']; ?>" placeholder=" ">
                    <label for="data_nascita">Data di nascita</label>
                </div>

                <div class="err<?php if (!isset($error['nazionalita'])) echo ' hidden'; ?>"><?php if (isset($error['nazionalita'])) echo $error['nazionalita'] ?></div>
                <div class="input_container">
                    <input type="text" id="nazionalita" name="nazionalita" value="<?php echo $userdata['nazionalita']; ?>" placeholder=" ">
                    <label for="nazionalita">nazionalita</label>
                </div>

                <div class="err<?php if (!isset($error['telefono'])) echo ' hidden'; ?>"><?php if (isset($error['telefono'])) echo $error['telefono'] ?></div>
                <div class="input_container">
                    <input type="tel" id="telefono" name="telefono" value="<?php echo $userdata['telefono']; ?>" placeholder=" " pattern="^{2}\d{3}\d{3}\d{4}">
                    <label for="telefono no-txt-transform">Numero di telefono</label>
                </div>

                <div class="err<?php if (!isset($error['email_recupero'])) echo ' hidden'; ?>"><?php if (isset($error['email_recupero'])) echo $error['email_recupero'] ?></div>
                <div class="input_container mb2">
                    <input type="email" id="email_recupero" name="email_recupero" value="<?php echo $userdata['email_recupero']; ?>" placeholder=" ">
                    <label for="email_recupero no-txt-transform">Email recupero</label>
                </div>



                <div class="submitbtn backglow mt2 mb2">
                    <input type="submit" class="" value="Sign up" name="Sign_up">
                </div>

            </form>
            <?php
            if (isset($error['ok']))
                echo '<p class="result">Registrazione effettuata con successo. Sarai reindirizzato alla home tra <span id="refreshseconds">' . $refreshtime . '</span>...</p>
                <script>
                    let el = document.getElementById("refreshseconds")
                        setInterval(function() {
                        let number = parseInt(el.innerHTML)
                        el.innerHTML = number - 1
                    }, 1000)
                </script>
                ';

            ?>
        </div>
    </div>
    <?php
    require('../components/footer.php');
    ?>
</body>
<script src="../javascript/psw.js"></script>



</html>