<?php
    $ads = SQLgetAds("","","");
    $infos = SQLgetInfo("", "", $_SESSION['User']{'mail'});
    $applies = array();
    for($myAds=0; $myAds < sizeof($ads); $myAds++)
    {
        for($info=0; $info<sizeof($infos); $info++)
        {
            if($ads{$myAds}{'id'} == $infos{$info}{'idAdvertisment'})
            {
                array_push($applies, $ads{$myAds});
            }
        }
    }
echo '
        <section id="myApplies">';
        for($mads=0; $mads<sizeof($applies); $mads++)
        {
echo '
            <article id="ads'.$applies{$mads}{'id'}.'" class="advertisment" style="background-color: rgb(220, 250, 230); border-color: rgb(16, 116, 20)">
                <h1 class="adsTitle">'.$applies{$mads}{'name'}.'</h1>
                <h2 class="adsCompany">'.SQLgetComp("company.name", $applies{$mads}{'name'}, "")[0]["name"].'</h2>
                <span>'.$applies{$mads}{'shortDescrib'}.'</span>
                <ul class="adsField">';
            $adsField = SQLgetField("field.name", $applies{$mads}{'name'});
            for($field = 0; $field < sizeof($adsField); $field++)
            {
                echo'
                <li>'.$adsField[$field]["name"].'</li>';           
            }
echo'
                </ul>
                <button id="learnmoreAds'.$applies{$mads}{'id'}.'" class="learnMore">Learn more</button>
            </article>';
        }
        echo'
        </section>';

?>