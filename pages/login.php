<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

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
<a href="" class="menu_voice back_btn" onclick="history.back()">Back</a>

<div class="login_wrapper fullvw fullvh">
    <div class="login_container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="post">
            <input type="email" name="email" id="">
            <input type="password" name="password" id="">
        </form>
    </div>
</div>
</body>
    
</html>