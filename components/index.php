<?php
    require('../components/session.php');
    if(isset($email)){
        header("location: ../pages/library.php?theme=default");
    }else{
        header("location: ../pages/home.php?theme=default");
    }
?>