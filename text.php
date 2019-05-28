<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/scripts.php";
$verzeichnispfad = $_SERVER['DOCUMENT_ROOT'] . "/img/";

$files = sortItems($verzeichnispfad);
filteredPics($files, "2019-04-06");
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
function showPics($files){
    $index = 0;
    foreach ($files as $key => $datei) {
        if (checkPic($datei) == true) {
            echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=image&name=" . $datei . "&ref=" . $index . "' class='img-wrapper'>";
            echo "<img src='" . FULLPATH . $datei . "'>";
            echo date("H:i:s Y.m.d", $key);
            echo "</a>\n";

        } elseif (checkMovie($datei) == true) {
            echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=video&name=" . $datei . "&ref=" . $index . "' class='video-wrapper'>";
            echo "<video  src='" . FULLPATH . $datei . "' autoplay muted loop>";
            echo date("H:i:s Y.m.d", $key);
            echo "</a>\n";
        }
        $index++;
    }
}
function filteredPics($files, $date){
    $index = 0;

    foreach ($files as $key => $datei) {
        if(compareFileDate(ROOT . FULLPATH . $datei, $date)) {
            if (checkPic($datei) == true) {
                echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=image&name=" . $datei . "&ref=" . $index . "' class='img-wrapper'>";
                echo "<img src='" . FULLPATH . $datei . "'>";
                echo date("H:i:s Y.m.d", $key);
                echo "</a>\n";

            } elseif (checkMovie($datei) == true) {
                echo "<a id='" . $index . "' href='" . DIR . "/php/manageImg.php?type=video&name=" . $datei . "&ref=" . $index . "' class='video-wrapper'>";
                echo "<video  src='" . FULLPATH . $datei . "' autoplay muted loop>";
                echo date("H:i:s Y.m.d", $key);
                echo "</a>\n";
            }
            $index++;
        }

    }
}