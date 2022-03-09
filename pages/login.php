<?php
session_start();
$email = "";
$password = "";

if (isset($_POST['email'])) $email = $_POST['email'];
if (isset($_POST['password'])) $password = $_POST['password'];

//connessione al database per verificare le credenziali
require('../data/db.php');
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die('Connessione fallita ' .$conn->connect_error);
$account_exist = "
    SELECT *
    FROM account
    WHERE email = '$email';
";

$ris = $conn->query($account_exist) or die('Query fallita: '.$conn->error);

if ($ris->num_rows == 0) {
    //email non trovata

} else {
    $row = $ris->fetch_assoc();
    $hash = $row['password'];

    if (password_verify($password, $hash)) {
        //login success
        $_SESSION['email'] = $email;
        $_SESSION['nickname'] = $nickname;

        header('location: ../index.php');
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
        <a href="" class="menu_voice backglow" onclick="history.back()">Back</a>
    </header>

    <div class="login_wrapper fullvh fullvw">
        <div class="login_container">
            <h1>Login</h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="input_container mt2">
                    <div class="error <?php if(!isset($error_email)) echo 'hidden';?>"><?php if(isset($error_email)) echo $error_email?></div>
                    <input type="email" name="email" id="" value="<?php echo $email ?>" placeholder="Email">

                </div>
                <div class="input_container mt2">
                    <div class="error <?php if(!isset($error_pass)) echo 'hidden';?>"><?php if(isset($error_pass)) echo $error_pass?></div>
                    <input type="password" name="password" id="" value="<?php echo $password ?>" placeholder="Password">
                </div>

                <input type="submit" class="submitbtn backglow mt2" value="Login" name="login">
            </form>
        </div>
    </div>
</body>

</html>