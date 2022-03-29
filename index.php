<?php
    require('./data/session.php');
    if(isset($email)){
        header("location: ./pages/explore.php?theme=default");
    }else{
        header("location: ./pages/home.php?theme=default");
    }
?>