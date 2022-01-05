<?php
if(isset($_GET["del"]) && $_GET["del"] == $_GET["fld"])
{
    SQLdelField($_GET["fld"]);
    header("location: index.php?main=fields");
    $_GET["del"] = null;
    $_GET["fld"] = null;
}
else
{
    echo '
    <a href="index.php?main=delField&fld='.$_GET["fld"].'&del='.$_GET["fld"].'"> DELETE THIS FIELD? </a>';
}

?>