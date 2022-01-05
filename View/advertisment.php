<?php
$adv = SQLgetAds("", "", "")[$_GET['advertismentPage']-1];
$_SESSION['adApplied'] = $adv;
echo '
    <section>
        <article class="advertisment">
            <h1 class="adsTitle">'.$adv{"name"}.'</h1>
            <h2 class="adsCompany">'.SQLgetComp("company.name", $adv{"name"}, "")[0]{'name'}.'</h2>
            <img src="https://lh3.googleusercontent.com/proxy/wiDSqsPgus8rfqavuk5dYlzbAHeV8uiBXIs9_2R7xdG3Q2YADFKo_SqUXHcrPvXdqOxvB2NnhjFEHRyH2-ef7QfsU00faKzf08sOimQ">
            <span class="longDescrib">Description : '.$adv{"longDescrib"}.'</span><br/>
            <span class="wages">Wages : '.$adv{"wages"}.'€ per hour</span><br/>
            <span class="place">Place : '.$adv{"place"}.'</span><br/>
            <span class="workTime">Work time : '.$adv{"workingTime"}.'h per working day</span><br/>
            <ul class="adsField">';
            for($field=0; $field<sizeof(SQLgetField("", $adv{"name"})); $field++)
            {
                echo '
                <li>'.SQLgetField("", $adv{"name"}){$field}{'name'}.'</li>';
            }
    
//---- get informations if the user had applied to it ----//
    $info = SQLgetInfo("", $adv{'name'}, $_SESSION['User']{'mail'});
    if($info != null)
    {
        for($i = 0; $i < sizeof($info); $i++)
        {
            if($info{$i} != null && $info{$i}{'idAdvertisment'} == $adv{'id'} && $_SESSION['User']{'id'} == $info{$i}{'idPeople'})
            {
                echo '
                            </ul>
                            <a href="index.php?main=contact,Com'.$adv{'idCompany'}.',Adv'.$adv{'id'}.'"><button class="contact">Contact</button></a>
                            <button class="return">Return</button>
                        </article>
                    </section>';
                echo '
                <section class="advInfo">
                    <h2>Interactions :</h2>
                    <article class="myApply">
                        <form action="index.php?main=modLetter" method="post">
                            <h3>Cover letter</h3>
                            <textarea id="letter" name="letter" rows="10" cols="100" readonly>'.$info{$i}{'coverLetter'}.'</textarea>
                            <input id="modLetterAdv" type="text" name="advertisment" value="'.$adv{'id'}.'" hidden>
                            <input id="modLetterSbmt" type="submit" value="valide" hidden>
                        </form>
                        <button id="modLetterBTN" class="modLetter">Modify</button>
                    </article>
                    <article class="myApply">
                        <h3>Mails exchanged</h3>';
                $mails = SQLgetMail("", $info{$i}{'idAdvertisment'});
                for($mail = 0; $mail < sizeof($mails); $mail++)
                {
                    if($mails{$mail}{'idInformation'} == $info{$i}{'id'} && ($mails{$mail}{'receiver'} == $_SESSION['User']{'mail'} || $mails{$mail}{'sender'} == $_SESSION['User']{'mail'}))
                    {
                        $date = date('d/m/Y H:i:s', strtotime($mails{$mail}{'dateTime'}));
                        echo '
                        <div class="mail" id="'.$mails{$mail}{'id'}.'">
                            <input type="text" class="mailPeoples" value="From : '.$mails{$mail}{'sender'}.', to : '.$mails{$mail}{'receiver'}.'" readonly>
                            <input type="text" class="mailDate" value="'.$date.'" readonly>
                            <textarea class="mailContent" name="mail" rows="4" cols="100" readonly>'.$mails{$mail}{'content'}.'</textarea>
                        </div>';
                    }
                }
                echo '
                    </article>
                </section>';
            }    
        }
    }
    else
    {
//---- User had post ----//
        if($_SESSION['User']{'idCompany'} == $adv{'idCompany'})
        {
            echo '
                    </ul>
                    <button id="modAds'.$adv{'id'}.'" class="modAds">Modify</button>
                    <button class="return">Return</button>
                </article>
            </section>';
        }
//---- User haven't post and applied ----//
        else
        {
            echo '
                    </ul>
                    <button id="adApplied'.$adv{'id'}.'" class="apply">Apply</button>
                    <button class="return">Return</button>
                </article>
            </section>';

        }
    }
    
//---- get informations from users which applied if the user had posted it ----//
    $info = SQLgetInfo("", $adv{'name'}, "");
    if($_SESSION['User']{'idCompany'} == $adv{'idCompany'})
    {
        echo '
        <section class="advInfo">
            <h2>Applyers :</h2>';
        for($applyer = 0; $applyer < sizeof($info); $applyer++)
        {
            $ppl = SQLgetPeople("","","");
            for($i=0;$i<sizeof($ppl);$i++)
            {
                if($ppl{$i}{'id'} == $info{$applyer}{'idPeople'})
                {
                    echo '
                    <article class="applyer">
                        <h3>'.$ppl{$i}{'mail'}.'</h3>
                        <a href="index.php?main=contact,Ppl'.$ppl{$i}{'id'}.',Adv'.$adv{'id'}.'"><button class="contact">Contact</button></a>
                        <h3>Cover letter : </h3>
                        <textarea name=\"letter\" rows=\"10\" cols=\"100\" readonly>'.$info{$applyer}{'coverLetter'}.'</textarea>
                        <h3>Mails exchanged : </h3>';
                    $mails = SQLgetMail("", $info{$applyer}{'idAdvertisment'});
                    for($mail = 0; $mail < sizeof($mails); $mail++)
                    {
                        if($mails{$mail}{'idInformation'} == $info{$applyer}{'id'} && (($mails{$mail}{'receiver'} == SQLgetComp("", $adv{'name'}, $_SESSION['User']{'mail'}){0}{'name'} || $mails{$mail}{'sender'} == SQLgetComp("", $adv{'name'}, $_SESSION['User']{'mail'}){0}{'name'})) && $mails{$mail}{'sender'} == $ppl{$i}{'mail'} || $mails{$mail}{'receiver'} == $ppl{$i}{'mail'})
                        {
                            $date = date('d/m/Y H:i:s', strtotime($mails{$mail}{'dateTime'}));
                            echo '
                            <div class="mail" id="'.$mails{$mail}{'id'}.'">
                                <input type="text" class="mailPeoples" value="From : '.$mails{$mail}{'sender'}.', to : '.$mails{$mail}{'receiver'}.'" readonly>
                                <input type="text" class="mailDate" value="'.$date.'" readonly>
                                <textarea class="mailContent" name="mail" rows="4" cols="100" readonly>'.$mails{$mail}{'content'}.'</textarea>
                            </div>';
                        }
                    }
                    echo '
                    </article>';                   
                }
            }
            echo '
            </section>';
        }
    }
?>