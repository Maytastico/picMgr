<?php
require_once "variables.php";

function fileDate($filepath){
    date('m.d.y');
    if (file_exists($filepath)) {
        echo date ("Y.m.d/H:i:s.", filemtime($filepath));
    }else{
        echo "File is not existing!";
    }
}
function checkPic($filename){
    $filename =  explode('.', $filename);
    $filetype = $filename[1];

    if($filetype== "jpg" || $filetype == "JPG" || $filetype == "png" || $filetype == "PNG") {
        return true;
    }
    else{
        return false;
    }
}
function checkMovie($filename){
    $filename =  explode('.', $filename);
    $filetype = $filename[1];

    if($filetype== "mov" || $filetype == "MOV" || $filetype == "mp4" || $filetype == "MP4") {
        return true;
    }
    else{
        return false;
    }
}
//Reads all file in Directory and show them
function showDirPics($folderpath){
    $handle=opendir ($folderpath);

    while ($datei = readdir ($handle)) {
        $filename =  explode('.', $datei);
        if(!(trim($datei) == ".." || trim($datei) == ".")){
            if(checkPic($datei) == true) {
                echo "<a href='".DIR."/php/manageImg.php?type=image&name=". $datei ."' class='img-wrapper'>";
                echo "<img src='" . FULLPATH . $datei. "'>";
                //fileDate($folderpath . $datei);
                echo "</a>\n";
            }
            elseif (checkMovie($datei) == true){
                echo "<div class='video-wrapper'>";
                echo "<video  src='" . FULLPATH . $datei. "' autoplay muted loop>";
                echo "</div>\n";
            }
        }
    }
    closedir($handle);
}
//Shows the Picture
function showPicture($path){
    echo "<div class='fullImage'>";
    echo "<img src='$path'>";
    echo "</div>";
}
//Deletes a file
function deleteFile($filePath){
    if (is_writable($filePath)) {
        unlink($filePath);
        echo "<div style='background: green'>";
        echo "<br>File was deleted successfully!";
        echo "</div>";
        return true;
    }else{
        echo "<div style='background: red'>";
        echo "<br>File does not exist<br>";
        echo $filePath;
        echo "</div>";
        return false;
    }
}
?>