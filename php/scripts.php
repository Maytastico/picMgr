<?php
require_once "variables.php";

function sortItems($path){
    $verzeichnis = array_slice(scanDir($path), 2);
    $files = array();
    foreach ($verzeichnis as $datei) {
        $pfad = $path . $datei;
        $files [filemtime($pfad)] = $datei;
    }
    krsort ($files);
    return $files;
}
//looks at the end of the filename after a String jpg or png
function checkPic($filename){
    $filename =  explode('.', $filename);
    $filetype = $filename[count($filename) - 1];

    if($filetype== "jpeg" || $filetype== "jpg" || $filetype == "JPG" || $filetype == "png" || $filetype == "PNG") {
        return true;
    }
    else{
        return false;
    }
}
//Looks at the end of the filename, after a String mov or mp4
function checkMovie($filename){
    $filename =  explode('.', $filename);
    $filetype = $filename[count($filename) - 1];

    if($filetype== "mov" || $filetype == "MOV" || $filetype == "mp4" || $filetype == "MP4") {
        return true;
    }
    else{
        return false;
    }
}
//Reads all files in Directory and shows them
function showPics($files){
    $index = 0;
    foreach ($files as $key => $datei) {
        if (checkPic($datei) == true) {
            echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=image&name=" . $datei . "&ref=" . $index . "' class='img-wrapper'>";
            echo "<img src='" . FULLPATH . $datei . "'>";
            echo '<div class="time">';
            echo date("H:i:s Y.m.d", $key);
            echo '</div>';
            echo "</a>\n";

        } elseif (checkMovie($datei) == true) {
            echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=video&name=" . $datei . "&ref=" . $index . "' class='video-wrapper'>";
            echo "<video  src='" . FULLPATH . $datei . "' autoplay muted loop>";
            echo '<div class="time">';
            echo date("H:i:s Y.m.d", $key);
            echo "</div>";
            echo "</a>\n";
        }
        $index++;
    }
}
//Reads all files in Directory, filters them and shows them
function filteredPics($files, $date){
    $index = 0;
    foreach ($files as $key => $datei) {
        if(compareFileDate(ROOT . FULLPATH . $datei, $date)) {
            if (checkPic($datei) == true) {
                echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=image&name=" . $datei . "&ref=" . $index . "' class='img-wrapper'>";
                echo "<img src='" . FULLPATH . $datei . "'>";
                echo '<div class="time">';
                echo date("H:i:s Y.m.d", $key);
                echo "</div>";
                echo "</a>\n";

            } elseif (checkMovie($datei) == true) {
                echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=video&name=" . $datei . "&ref=" . $index . "' class='video-wrapper'>";
                echo "<video  src='" . FULLPATH . $datei . "' autoplay muted loop>";
                echo '<div class="time">';
                echo date("H:i:s Y.m.d", $key);
                echo "</div>";
                echo "</a>\n";
            }
            $index++;
        }

    }
}
//Shows the Picture
function showPicture($path){
    echo "<div class='fullImage'>";
    echo "<img src='$path'>";
    echo "</div>";
}
function showVideo($path){
    echo "<div class='fullVideo'>";
    echo "<video src='$path' controls>";
    echo "</div>";
}
//Deletes a file
function deleteFile($filePath){
    $status = flase;
    //Checks whether the file exists
    if (is_writable($filePath)) {
        $status=unlink($filePath);
    }else{
        echo "<div style='background: red; padding:50px 0;'>";
        echo "<br>Die Datei ist nicht beschreibar!<br>";
        echo "</div>";
        return false;
    }
    //Checks whether the deleting process was successful
    if($status == true){
        echo "<div style='background: green'>";
        echo "<br>Datei wurde gelöscht!";
        echo "</div>";
        return true;
    }else{
        echo "<div style='background: red; padding:50px 0;'>";
        echo "<br>Die Datei konnte nicht gelöscht werden!<br>";
        echo "</div>";
        return false;
    }
}
//For Filters
function convertToTimeStamp($dateAsString, $delimiter){
    $dateAsArray = explode($delimiter, $dateAsString);
    $timestamp = mktime(0,0,0, $dateAsArray[1], $dateAsArray[2], $dateAsArray[0]);
    if($timestamp != false){
        return $timestamp;
    }else{
        return false;
    }
}
function compareFileDate($file, $requestedTime){
    $dateOfFile = date("Y-m-d",filemtime($file));
    $tFileInStamp = convertToTimeStamp($dateOfFile, "-");
    $requestedTimeInStamp = convertToTimeStamp($requestedTime, "-");

    if($requestedTimeInStamp == $tFileInStamp){
        return true;
    }else{
        return false;
    }
}
?>