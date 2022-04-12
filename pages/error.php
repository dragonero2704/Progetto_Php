<?php
$errorcode = urldecode($_GET['errcode']);
$error = urldecode($_GET['error'])
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
    <title>Error <?php echo $errorcode ?></title>
</head>

<body onunload="window.location.replace('../index.php')">
    <div class="body">
        <div class="errorbox">
            <h1>
                <?php
                echo $errorcode;
                ?>
            </h1>
            <p>
                <?php
                echo $error;
                ?>
            </p>
        </div>
    </div>

</body>

</html>