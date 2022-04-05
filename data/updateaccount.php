<?php
    if(isset($_GET['q'])) $data = json_decode(urldecode($_GET['q']));

    require('./db.php');
    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);

    $sql = "UPDATE account
            SET email = '$email', 
    ";

?>