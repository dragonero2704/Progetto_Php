<?php
session_start();
$email = "";
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
                    <input type="email" name="email" id="" value="<?php echo $email ?>" placeholder="Email">

                </div>
                <div class="input_container mt2">
                    <input type="password" name="password" id="" placeholder="Password">
                </div>
                
                <input type="submit" class="submitbtn backglow mt2" value="Login" name="login">
            </form>
        </div>
    </div>
</body>

</html>