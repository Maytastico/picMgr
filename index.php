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
    <section class="flex">
        <?php
        //Reads alls pictures inside the dir and showes them
        showDirPics("." . IMAGEDIR);
        ?>
    </section>
</body>