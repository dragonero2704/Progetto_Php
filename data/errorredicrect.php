<?php
    function erredirect($code, $body){
        $body = urlencode($body);
        header("location: error.php?errcode=$code&error=$body");
    }
?>