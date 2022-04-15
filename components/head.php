<?php
    echo '<!-- normalize css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous">';
    // custom css
    if (basename($_SERVER["PHP_SELF"]) === 'index.php'){
        echo'<!-- my css -->
            <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" href="./media/loghi/logo.png" type="image/x-icon">
    ';
    }else{
        echo '<!-- my css -->
        <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../media/loghi/logo.png" type="image/x-icon">
    ';
    }
    //link che non cambiano a seconda della posizione della pagina
    echo '
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- FontAwesome icons -->
    <script src="https://kit.fontawesome.com/632d3ab13d.js" crossorigin="anonymous"></script>
    <!-- Scrollreveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    ';

