<?php
//Adds Constan
require_once "php/variables.php";
require_once "php/scripts.php";
?>

<!DOCTYPE html>

<head>
    <?php require_once "php/stylesheets.php"; ?>
</head>
<body>
    <a href="#1" class="arrowUp">
        <img src="icons/arrow-144-128.ico">
    </a>
    <section class="flex">
        <?php
        //Reads alls pictures inside the dir and showes them
        showDirPics("." . IMAGEDIR);
        ?>
    </section>

</body>