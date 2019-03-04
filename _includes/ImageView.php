<?php
//This is imported for giving this program access to the variables
require_once "../php/manageImg.php";
?>
<body>
<nav class="imageNav">
    <a href="<?php echo DIR?>" class="button large">
        Zurück
    </a>
    <a href="?command=del&<?php echo"name=". $pictureName?>" class="button large alert">
        Bild löschen
    </a>
</nav>
<?php
if($type != null && $type == "image"){
    showPicture(FULLPATH.$pictureName);
}
?>
</body>