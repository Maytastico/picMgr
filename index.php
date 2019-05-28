<?php
//Mode Variable
$mode = "show";
//Adds Constantes
require_once "php/variables.php";
require_once "php/scripts.php";
//Filter
$date = $_GET["date"];
if(isset($date)){
    $convertedTime = convertToTimeStamp($date,"-");
    $mode = "date";
    echo '<div style="text-align: center;">';
    echo "Alle Bilder vom ". date("d/M/y", $convertedTime);
    echo '</div>';
}
?>

<!DOCTYPE html>

<head>
    <?php require_once "php/stylesheets.php"; ?>
    <script type="text/javascript">
        let status = false;
        function toggleNav() {
            if(status == false) {
                document.getElementById('navigationContent').style.display = 'block';
                document.getElementById('navigationContent').className = 'fadeIn';
                document.getElementById('menuButton').innerHTML = 'X';
                status = true;
                return status;
            }else if(status == true){
                document.getElementById('navigationContent').className = 'fadeOut';
                setTimeout(function(){
                    document.getElementById('navigationContent').style.display = 'none';
                }, 500);
                document.getElementById('menuButton').innerHTML = '&equiv;';
                status = false;
                return status;
            }
        }
    </script>
</head>
<body>
<nav>
    <a id="menuButton" onclick="toggleNav()">&equiv;</a>
    <section id="navigationContent" style=" display: none">
        <main class="flex space nowarp">
            <div class="padding">
                <p>Navigation</p>
                <a class="button " href="motor.html">Kamerastream</a>
            </div>
            <div class="padding">
                <p>Filter</p>
                <form  action="index.php" method="GET">
                    <input value="<?php echo $date?>" name="date" type="date" required>
                    <input  value="Bilder Anzeigen" class="button  success" type="submit" >
                </form>
                <?php if($mode != "show"){
                    echo '<a class="button alert" href="index.php">Filter zurücksetzen</a>';
                }?>
            </div>
        </main>

    </section>
</nav>


    <a href="#1" class="arrowUp">
        <svg style="color: white;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-circle-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-arrow-circle-up fa-w-16 fa-5x"><path fill="currentColor" d="M8 256C8 119 119 8 256 8s248 111 248 248-111 248-248 248S8 393 8 256zm143.6 28.9l72.4-75.5V392c0 13.3 10.7 24 24 24h16c13.3 0 24-10.7 24-24V209.4l72.4 75.5c9.3 9.7 24.8 9.9 34.3.4l10.9-11c9.4-9.4 9.4-24.6 0-33.9L273 107.7c-9.4-9.4-24.6-9.4-33.9 0L106.3 240.4c-9.4 9.4-9.4 24.6 0 33.9l10.9 11c9.6 9.5 25.1 9.3 34.4-.4z" class=""></path></svg>
    </a>
    <section class="flex">
        <?php
        switch ($mode){
            case "show":
                //Reads alls pictures inside the dir and showes them
                $files = sortItems(ROOT . FULLPATH);
                showPics($files);
            break;
            case "date":
                $files = sortItems(ROOT . FULLPATH);
                filteredPics($files, $date);
            break;
        }
        ?>
    </section>

</body>