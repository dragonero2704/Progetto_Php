<?php
session_start();
$email = "";
$password = "";
$error = array();

if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["password"])) $password = $_POST["password"];

//connessione al database per verificare le credenziali
require('../data/db.php');
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die('');
$account_exist = "
    SELECT *
    FROM account
    WHERE email = '$email'
";


if ($email != "" && isset($email)) {
    $ris = $conn->query($account_exist) or die('Query fallita: ' . $conn->error);
    if ($ris->num_rows == 0) {
        //email non trovata
        $error['email'] = "Email errata";
        $error['password'] = "Password errata";
    } else {
        $row = $ris->fetch_assoc();
        $hash = $row['password'];

        if (password_verify($password, $hash)) {
            //login success
            $_SESSION['email'] = $email;
            $_SESSION['nickname'] = $nickname;

            header('location: ../index.php');
        } else {
            $error['password'] = "Password errata";
        }
    }
}


$conn->close();
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




    <title>Login</title>
</head>

<body>
    <header>
        <a href="../index.php" class="menu_voice backglow">Back</a>
        <a href="./signup.php" class="menu_voice backglow right">
            <nobr>Sign up</nobr>
        </a>

    </header>

    <div class="body">
        <div class="login_container mt5">
            <h1>Login</h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off">

                <div class="err<?php if (!isset($error['email'])) echo ' hidden'; ?>"><?php if (isset($error['email'])) echo $error['email'] ?></div>
                <div class="input_container mb3">

                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="">
                    <label for="email">email</label>
                </div>

                <div class="err<?php if (!isset($error['password'])) echo ' hidden'; ?>"><?php if (isset($error['password'])) echo $error['password'] ?></div>
                <div class="input_container mb2">
                    <input type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder="">
                    <label for="password">password</label>
                    <span id="eye" class="mr3">Show</span>
                </div>
                <div class="submitbtn backglow backglow">
                    <input type="submit" class="" value="login" name="login">
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