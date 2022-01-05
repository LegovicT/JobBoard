<!--local url
    http://localhost/JobBoard/Step5/index.php
-->

<?php
    session_start();                                //Start the sessions variable
    include "Functions/bddFunction.php";            //fonctions to call BDD
    resetAuto();                                    //reset the autoincrementation of the data base

                                                    //pass the get main variables as session variables
    if(!isset($_GET["main"]))
    {$_GET["main"]="home";}
    $_SESSION["main"] = $_GET["main"];

    include "View/header.php";                      //get the head of the html
    include "Controller/control.php";               //Control globales variables 
    getControl();                                   //control function
    include "View/footer.php";                      //get the foot of the html


    /**** TESTS ****/
    //var_dump("session User",$_SESSION['User']);
    //var_dump("session", $_SESSION);
    //var_dump("post",$_POST);
    //var_dump(sqlRead("advertisment", "*", "name = 'Search for a Cooker'"));
    //var_dump(sqlRead("adsfield", "*", "idAdvertisment = '3'"));
    //var_dump(SQLgetField("", "Search for a Cooker"));

    /*SQL QUERYS
    var_dump(SQLgetAds("","BobCompany", "plumber"));
    var_dump(SQLgetField("field.name", "Search for a Cooker,Search for a developer"));
    var_dump(SQLgetComp("company.name", "Search for Mecanics", "ssbb@bros.com"));
    echo "<br/><br/><br/><br/>";
    var_dump(sqlRead("adsField", "*", ""));
    var_dump(sqlRead("advertisment", "*", ""));
    var_dump(sqlRead("company", "*", ""));
    var_dump(sqlRead("field", "*", ""));
    var_dump(sqlRead("information", "*", ""));
    var_dump(sqlRead("mail", "*", ""));
    var_dump(sqlRead("people", "*", ""));
    var_dump(sqlRead("phoneCall", "*", ""));*/
?>