<!DOCTYPE html>
<head>

    <?php
    //Adds common stylesheets into HTML
    require_once "stylesheets.php";
    ?>

</head>
<?php
//scripts contains all functions for showing or deleting files
    require_once "scripts.php";

//Looks whether a Variable is set and saves the contend inside a Variable
    if( isset($_GET['name'])) {
        $pictureName = $_GET['name'];
    }else{
        $pictureName = null;
        echo "No name set!\n";
    }


    if( isset($_GET['type'])) {
        //Checks for keywords
        if($_GET['type'] == "image" || $_GET['type'] == "video") {
            $type = $_GET['type'];
        }
    }else{
        $type = null;
        //echo "No type set!\n";
    }

    if( isset($_GET['command'])) {
        if($_GET['command'] == "del") {
            $command = $_GET['command'];
        }
    }else{
        $command = null;
    }

    if( isset($_GET['ref'])) {
        if(is_numeric(trim($_GET['ref']))) {
            $ref = $_GET['ref'];
        }
    }else{
        $ref = null;
    }

    if( isset($_GET['filter'])) {
        if(trim($_GET['filter'])) {
            $filter = $_GET['filter'];
        }
    }else{
        $filter = null;
}
    //If a type is decleared it imports another php file
    if($type != null && $type == "image" || $type == "video"){
        require "../_includes/ImageView.php";
    }

    if($pictureName != null && $command == "del"){
        $toBeDeleted = ROOT.DIR.IMAGEDIR.$pictureName;
        $delRef = 0;
        echo $toBeDeleted;
        if($ref == 0){
            $delRef = $ref + 1;
        }else{
            $delRef = $ref - 1;
        }
        echo "<div class='message'>";
            if (deleteFile($toBeDeleted) == true){
                echo'<script language="javascript" type="text/javascript">window.location.replace("' .  DIR . '/#' . $delRef .'"); </script>';
            }else{
                echo"<br><a href='".DIR."/#".$delRef."' class=\"button large\"> Zurück</a>";
            }
        echo "</div>";
    }
?>

