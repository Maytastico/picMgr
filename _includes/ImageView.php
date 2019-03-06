<?php
//This is imported for giving this program access to the variables
require_once "../php/manageImg.php";
?>
<body>
<nav class="imageNav">
    <a href="<?php echo DIR."/#".$ref?>" class="button large">
        Zurück
    </a>
    <a href="?command=del&<?php echo"name=". $pictureName."&ref=".$ref?>" class="button large alert">
        <?php
            if($type == "image"){
                echo "Bild löschen";
            }
            elseif($type == "video"){
                echo "Video löschen";
            }
        ?>
    </a>
</nav>
    <?php
        if($type != null && $type == "image"){
            showPicture(FULLPATH.$pictureName);
        }elseif ($type != null && $type == "video"){
            showVideo(FULLPATH.$pictureName);
        }
    ?>
</body>