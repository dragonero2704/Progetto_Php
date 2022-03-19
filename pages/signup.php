<?php
session_start();

$error = array();

if (isset($_POST['email'])) $email = $_POST['email'];
else $email = "";
if (isset($_POST['password'])) $password = $_POST['password'];
else $password = "";
if (isset($_POST['confermapassword'])) $confermapassword = $_POST['confermapassword'];
else $confermapassword = "";

if (isset($_POST['nome'])) $nome = $_POST['nome'];
else $nome = "";

if (isset($_POST['cognome'])) $cognome = $_POST['cognome'];
else $cognome = "";

if (isset($_POST['nickname'])) $nickname = $_POST['nickname'];
else $nickname = "";

if (isset($_POST['nazionalita'])) $nazionalita = $_POST['nazionalita'];
else $nazionalita = "";

if (isset($_POST['data_nascita'])) $data_nascita = $_POST['data_nascita'];
else $data_nascita = "";

if (isset($_POST['telefono'])) $telefono = $_POST['telefono'];
else $telefono = "";

if (isset($_POST['email_recupero'])) $email_recupero = $_POST['email_recupero'];
else $email_recupero = "";

?>

<!DOCTYPE html>
<html lang="en">

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
        <div class="login_container mt5">
            <h1>Sign up</h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off">
                <div class="input_container mt3">
                    <div class="err<?php if (!isset($error['email'])) echo ' hidden'; ?>"><?php if (isset($error['email'])) echo $error['email'] ?></div>
                    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
                </div>

                <div class="input_container mt2">
                    <div class="err<?php if (!isset($error['password'])) echo ' hidden'; ?>"><?php if (isset($error['password'])) echo $error['password'] ?></div>
                    <div class="pos-rel">
                        <input type="password" name="password" id="psw" value="<?php echo $password; ?>" placeholder="Password">
                        <span id="eye" class="mr3">Show</span>
                    </div>
                </div>

                <div class="input_container mt2">
                    <div class="err<?php if (!isset($error['confermapassword'])) echo ' hidden'; ?>"><?php if (isset($error['confermapassword'])) echo $error['confermapassword'] ?></div>
                    <div class="pos-rel">
                        <input type="password" name="confermapassword" id="psw" value="<?php echo $confermapassword; ?>" placeholder="Conferma password">
                        <span id="eye" class="mr3">Show</span>
                    </div>
                </div>

                <div class="input_container mt2">
                    <div class="err<?php if (!isset($error['nome'])) echo ' hidden'; ?>"><?php if (isset($error['nome'])) echo $error['nome'] ?></div>
                    <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="Nome">
                </div>

                <div class="input_container mt2">
                    <div class="err<?php if (!isset($error['cognome'])) echo ' hidden'; ?>"><?php if (isset($error['cognome'])) echo $error['cognome'] ?></div>
                    <input type="text" name="cognome" value="<?php echo $cognome; ?>" placeholder="Cognome">
                </div>



                <input type="submit" class="submitbtn backglow mt2" value="Sign up" name="login">
            </form>
        </div>
    </div>
    <?php
    require('../data/footer.php');
    ?>
</body>

</html>

<script src="../javascript/psw.js"></script>