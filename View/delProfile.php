<?php
    if(isset($_GET["del"]) && $_GET["del"] == $_GET["pro"])
    {
        SQLdelPeople($_GET["pro"]);
        header("location: index.php?main=profiles");
        $_GET["del"] = null;
        $_GET["pro"] = null;
    }
    else
    {
        echo '
        <a href="index.php?main=delProfile&pro='.$_GET["pro"].'&del='.$_GET["pro"].'"> DELETE THIS PROFILE? </a>';
    }

?>