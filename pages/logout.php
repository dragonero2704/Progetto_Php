<?php
    session_start();
    $_SESSION = NULL;
    session_destroy();
    header('location: ../index.php');
?>