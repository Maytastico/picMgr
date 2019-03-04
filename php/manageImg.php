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


    if($type != null && $type == "image"){
        require "../_includes/ImageView.php";
    }
    if($pictureName != null && $command == "del"){
        $toBeDeleted = "..".IMAGEDIR.$pictureName;
        echo "<div class='message'>";
            if (deleteFile($toBeDeleted) == true){
                echo'<script language="javascript" type="text/javascript">window.location.replace("' .  DIR . '"); </script>';
            }else{
                echo"<br><a href=\"".DIR."\" class=\"button large\"> Zurück</a>";
            }
        echo "</div>";
    }
?>

