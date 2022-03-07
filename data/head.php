<?php
    if (basename($_SERVER["PHP_SELF"]) == 'index.php'){
        echo'<!-- my css -->
            <link rel="stylesheet" href="./style/style.css">
            <!-- google fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Poppins:wght@300&display=swap" rel="stylesheet">';
    }else{
        echo '<!-- my css -->
        <link rel="stylesheet" href="../style/style.css">
        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Poppins:wght@300&display=swap" rel="stylesheet">';
    }
?>