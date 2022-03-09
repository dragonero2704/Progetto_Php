<?php
session_start();
$email = "";
$password = "";

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
        $error_email = "Email errata";
        $error_pass = "Password errata";
    } else {
        $row = $ris->fetch_assoc();
        $hash = $row['password'];
        echo $password;
        echo $hash;
        echo password_verify($password, $hash);

        if (password_verify($password, $hash)) {
            //login success
            $_SESSION['email'] = $email;
            $_SESSION['nickname'] = $nickname;

            header('location: ../index.php');
        }else{
            $error_pass = "Password errata";
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
    </header>

    <div class="login_wrapper fullvh fullvw">
        <div class="login_container">
            <h1>Login</h1>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off">
                <div class="input_container mt2">
                    <div class="err<?php if (!isset($error_email)) echo ' hidden'; ?>"><?php if (isset($error_email)) echo $error_email ?></div>
                    <input type="email" name="email" id="" value="<?php echo $email;?>" placeholder="Email">

                </div>
                <div class="input_container mt2">
                    <div class="err<?php if (!isset($error_pass)) echo ' hidden'; ?>"><?php if (isset($error_pass)) echo $error_pass ?></div>
                    <input type="password" name="password" id="" value="<?php echo $password; ?>" placeholder="Password">
                </div>

                <input type="submit" class="submitbtn backglow mt2" value="Login" name="login">
            </form>
        </div>
    </div>
</body>

</html>

<script>
    
</script>