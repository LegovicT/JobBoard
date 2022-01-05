<?php
    $ads = SQLgetAds("","","");
    $offers = array();
    for($myPost=0; $myPost < sizeof($ads); $myPost++)
    {
        if($ads{$myPost}{'idCompany'} == $_SESSION['User']{'idCompany'})
        {
            array_push($offers, $ads{$myPost});
        }
    }
echo '
        <section id="myOffers">';
        for($mads=0; $mads<sizeof($offers); $mads++)
        {
echo '
            <article id="ads'.$offers{$mads}{'id'}.'" class="advertisment" style="background-color: rgb(176, 185, 195); border-color: rgb(108, 8, 32)">
                <h1 class="adsTitle">'.$offers{$mads}{'name'}.'</h1>
                <h2 class="adsCompany">'.SQLgetComp("company.name", $offers{$mads}{'name'}, "")[0]["name"].'</h2>
                <span>'.$offers{$mads}{'shortDescrib'}.'</span>
                <ul class="adsField">';
            $adsField = SQLgetField("field.name", $offers{$mads}{'name'});
            for($field = 0; $field < sizeof($adsField); $field++)
            {
                echo'
                <li>'.$adsField[$field]["name"].'</li>';           
            }
echo'
                </ul>
                <button id="learnmoreAds'.$offers{$mads}{'id'}.'" class="learnMore">Learn more</button>
            </article>';
        }
        echo'
        </section>';

?>