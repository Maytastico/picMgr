<?php
require_once "variables.php";

//Writes the time, when the file was created, into the document
function fileDate($filepath){
    date('m.d.y');
    if (file_exists($filepath)) {
        echo date ("Y.m.d/H:i:s.", filemtime($filepath));
    }else{
        echo "File is not existing!";
    }
}
//looks at the end of the filename after a String jpg or png
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
//Looks at the end of the filename, after a String mov or mp4
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
    $index = -2;
    while ($datei = readdir ($handle)) {
        $filename =  explode('.', $datei);
        if(!(trim($datei) == ".." || trim($datei) == ".")){
            if(checkPic($datei) == true) {
                echo "<a id='". $index ."' href='".DIR."/php/manageImg.php?type=image&name=". $datei ."&ref=".$index."' class='img-wrapper'>";
                echo "<img src='" . FULLPATH . $datei. "'>";
                //fileDate($folderpath . $datei);
                echo "</a>\n";
            }
            elseif (checkMovie($datei) == true){
                echo "<a id='". $index ."' href='".DIR."/php/manageImg.php?type=video&name=". $datei ."&ref=".$index."' class='video-wrapper'>";
                echo "<video  src='" . FULLPATH . $datei. "' autoplay muted loop>";
                echo "</a>\n";
            }
        }
        $index++;
    }
    closedir($handle);
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