<?php
    $advert = substr($_SESSION['Contact']{'advertisment'}, -1);
    $receiver = substr($_SESSION['Contact']{'receiver'}, -1);
    $sender = "";
    $info;
    
    $advs = SQLgetAds("", "", "");
    for($adv=0; $adv<sizeof($advs); $adv++)                             // Select the name of the advertisment
    {
        if($advs{$adv}{'id'} == $advert)
        {
            $advert = $advs{$adv}{'name'};
        }
    }
    
    if(substr($_SESSION['Contact']{'receiver'}, 0, 3) == "Com")         // Select the name of the receiver (company)
    {
        $companies = SQLgetComp("", "", "");
        for($com=0; $com<sizeof($companies); $com++)
        {
            if($companies{$com}{'id'} == $receiver)
            {
                $receiver = $companies{$com}{'name'};
            }
        }
        $sender = $_SESSION['User']{'mail'};                            // and the mail of the sender (people)
        
        $info = SQLgetInfo("", $advert, $sender){0}{'id'};             // and the id of the information
    }
    else if(substr($_SESSION['Contact']{'receiver'}, 0, 3) == "Ppl")    // Select the mail of the receiver (people)
    {
        $peoples = SQLgetPeople("", "", "");
        $companies = SQLgetComp("", "", "");
        for($ppl=0; $ppl<sizeof($peoples); $ppl++)
        {
            if($peoples{$ppl}{'id'} == $receiver)
            {
                $receiver = $peoples{$ppl}{'mail'};
            }
        }
        for($com=0; $com<sizeof($companies); $com++)                    // and the name of the sender (company)
        {
            if($companies{$com}{'id'} == $_SESSION['User']{'idCompany'})
            {
                $sender = $companies{$com}{'name'};
            }
        }
        
        $info = SQLgetInfo("", $advert, $receiver){0}{'id'};           // and the id of the information
    }

    $date = date("Y-m-d H:i:s");

echo '
        <form action="index.php?main=contacted" method="Post">
            <h1>Contact : '.$receiver.'</h1>
            <h2>For the advertisment : '.$advert.'</h2>
            <label for="dateTime">Date : </label><input name="dateTime" type="datetime" value="'.date("Y-m-d H:i:s", strtotime($date)).'" readonly>
            <label for="sender">Sender : </label><input name="sender" type="text" value="'.$sender.'" readonly>
            <label for="receiver">Receiver : </label><input name="receiver" type="text" value="'.$receiver.'" readonly>
            <input name="idInformation" type="number" value="'.$info.'" hidden>
            <textarea name="coverLetter" rows="10" cols="100">My message</textarea>
    
            <input class="submit" type="submit" value="Submit" name="submit">
        </form>
        <button class="return">Return</button>';

?>