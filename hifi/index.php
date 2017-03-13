<?php require_once 'sqlconfig.php'; ?>
<html>

<head>
    <meta charset="utf-8">
    <title>HIFI - Velkommen</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
</head>

<body>
    <?php
        include 'includes/nav.php';

        if(isset($_GET['p'])){
            $page = 'includes/' . $_GET['p'] . '.php';
            if(file_exists($page)){
                include $page;
            } else {
                //404
                header('Location: index.php?p=home');
            }
        } else {
            header('Location: index.php?p=home');
        }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
