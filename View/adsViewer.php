<?php

//---- get fields selected ----//
    if(isset($_GET['field']) && $_GET['field'] != "clear")
    {
        if(isset($_SESSION["field"]) && $_SESSION["field"] != "")
        {
            $_SESSION["field"].=",".$_GET['field'];
        }
        else{$_SESSION["field"]=$_GET['field'];}
    }
    else if(isset($_GET['field']) && $_GET['field'] == "clear")
    {
        $_SESSION["field"]="";
    }
    else
    {
        if(!isset($_SESSION['q']{'field'}) || $_SESSION['q']{'field'} == null)
        {
            $_SESSION["field"]="";
        }
    }

//---- get advertisment by the fields selected ----//
    $_SESSION["advertisment"] = SQLgetAds("", "", $_SESSION["field"]);
    echo '
    <div class="fields">
        <div class="fieldsSelected">Fields Selected : '.$_SESSION["field"].'</div>
        <form class="fieldForm" action="index.php?main=adsViewer" method="get">
            Add a field : <select name="field" id="field-select">
                <option value="clear">Clear</option>';
//---- display fields selected ----//
        for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
        {
            echo '
                <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
        }
    echo '   
            </select>
            <button id="fieldBtn">Select</button>
        </form>
    </div>
    <section id="adsViewer">';
//---- display advertisments by the searching keywords ----//
    //-- by the advertisments name
    if(isset($_SESSION['q']{'advertisment'}) && $_SESSION['q']{'advertisment'} != null)
    {
        $_SESSION["advertisment"] =  array();
        $adverts = SQLgetAds("", "", "");
        for($add=0; $add<sizeof($adverts); $add++)
        {
            for($q=0; $q<sizeof($_SESSION['q']{'advertisment'}); $q++)
            {
                if($adverts{$add}{'name'} == $_SESSION['q']{'advertisment'}{$q}{'name'})
                {
                    array_push($_SESSION["advertisment"], $_SESSION['q']{'advertisment'}{$q});
                }
            }
        }
    }
    //-- by the companies name
    if(isset($_SESSION['q']{'company'}) && $_SESSION['q']{'company'} != null)
    {
        $_SESSION["advertisment"] =  array();
        for($q=0; $q<sizeof($_SESSION['q']{'company'}); $q++)
        {
            $adverts = SQLgetAds("", $_SESSION['q']{'company'}{$q}{'name'}, "");
            for($add=0; $add<sizeof($adverts); $add++)
            {
                if($adverts{$add}{'idCompany'} == $_SESSION['q']{'company'}{$q}{'id'})
                {
                    array_push($_SESSION["advertisment"], $adverts{$add});
                }
            }
        }
    }

//---- display advertisments by the fields selected ----//
    for($ads = 0; $ads < sizeof($_SESSION["advertisment"]); $ads++)
    {
    //---- advert posted by the user ----//
        if(isset($_SESSION["advertisment"]{$ads}{'idCompany'}) && $_SESSION["advertisment"]{$ads}{'idCompany'} == $_SESSION['User']{'idCompany'})
        {
            echo '
            <article id="ads'.$ads.'" class="advertisment" style="background: linear-gradient(to bottom right, rgb(150, 150, 210), rgb(200, 250, 255)); border-color: rgb(160, 64, 64)">
                <h1 class="adsTitle">'.$_SESSION["advertisment"]{$ads}{'name'}.'</h1>
                <h2 class="adsCompany">'.SQLgetComp("company.name", $_SESSION["advertisment"]{$ads}{'name'}, "")[0]["name"].'</h2>
                <img src="https://lh3.googleusercontent.com/proxy/wiDSqsPgus8rfqavuk5dYlzbAHeV8uiBXIs9_2R7xdG3Q2YADFKo_SqUXHcrPvXdqOxvB2NnhjFEHRyH2-ef7QfsU00faKzf08sOimQ">
                <span>'.$_SESSION["advertisment"]{$ads}{'shortDescrib'}.'</span>
                <ul class="adsField">';
        }
    //---- advert applied by the user ----//
        else if(SQLgetInfo("", $_SESSION["advertisment"]{$ads}{'name'}, $_SESSION['User']{'mail'}) != null)
        {
            echo '
            <article id="ads'.$ads.'" class="advertisment" style="background: linear-gradient(to bottom right, rgb(150, 150, 210), rgb(200, 250, 255)); border-color: rgb(64, 160, 64)">
                <h1 class="adsTitle">'.$_SESSION["advertisment"]{$ads}{'name'}.'</h1>
                <h2 class="adsCompany">'.SQLgetComp("company.name", $_SESSION["advertisment"]{$ads}{'name'}, "")[0]["name"].'</h2>
                <img src="https://lh3.googleusercontent.com/proxy/wiDSqsPgus8rfqavuk5dYlzbAHeV8uiBXIs9_2R7xdG3Q2YADFKo_SqUXHcrPvXdqOxvB2NnhjFEHRyH2-ef7QfsU00faKzf08sOimQ">
                <span>'.$_SESSION["advertisment"]{$ads}{'shortDescrib'}.'</span>
                <ul class="adsField">';
        }
    //---- advert by default ----//
        else
        {
            echo '
            <article id="ads'.$ads.'" class="advertisment" style="background: linear-gradient(to bottom right, rgb(150, 150, 210), rgb(200, 250, 255)); border-color: rgb(64, 64, 160)">
                <h1 class="adsTitle">'.$_SESSION["advertisment"]{$ads}{'name'}.'</h1>
                <h2 class="adsCompany">'.SQLgetComp("company.name", $_SESSION["advertisment"]{$ads}{'name'}, "")[0]["name"].'</h2>
                <img src="https://lh3.googleusercontent.com/proxy/wiDSqsPgus8rfqavuk5dYlzbAHeV8uiBXIs9_2R7xdG3Q2YADFKo_SqUXHcrPvXdqOxvB2NnhjFEHRyH2-ef7QfsU00faKzf08sOimQ">
                <span>'.$_SESSION["advertisment"]{$ads}{'shortDescrib'}.'</span>
                <ul class="adsField">';
        }
            $adsField = SQLgetField("field.name", $_SESSION["advertisment"]{$ads}{'name'});
            for($field = 0; $field < sizeof($adsField); $field++)
            {
                echo'
                <li>'.$adsField[$field]["name"].'</li>';           
            }
            echo'
            </ul>
            <button id="learnmoreAds'.$_SESSION["advertisment"]{$ads}{'id'}.'" class="learnMore">Learn more</button>
        </article>';
    }
    echo '
    </section>';
?>