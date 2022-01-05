<?php
if(isset($_GET["del"]) && $_GET["del"] == $_GET["com"])
{
    SQLdelComp($_GET["com"]);
    header("location: index.php?main=companies");
    $_GET["del"] = null;
    $_GET["com"] = null;
}
else
{
    echo '
    <a href="index.php?main=delCompany&com='.$_GET["com"].'&del='.$_GET["com"].'"> DELETE THIS COMPANY? </a>';
}

?>