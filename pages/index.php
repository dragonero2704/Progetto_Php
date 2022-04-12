<?php
    require('../data/session.php');
    if(isset($email)){
        header("location: library.php?theme=default");
    }else{
        header("location: home.php?theme=default");
    }
?>