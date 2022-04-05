<?php
session_start();
    $email = NULL;
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
