<?php
    
    if($_SESSION['User']{'statut'} != 2)                // people contact admin
    {
        $date = date("Y-m-d H:i:s");

        echo '
                <form action="index.php?main=asking" method="Post">
                    <h1>Contact : </h1>
                    <input name="dateTime" type="datetime" value="'.date("Y-m-d H:i:s", strtotime($date)).'" hidden>
                    <input name="idAsk" type="text" value="'.$_SESSION['User']{'id'}.'" hidden>
                    <textarea name="ask" rows="10" cols="100"></textarea>
            
                    <input class="submit" type="submit" value="Submit" name="submit">
                </form>
                <button class="return">Return</button>';
    }
    else                                                // admin contact people
    {
        $cont = SQLgetContactAdmin("", "");
        for($c=0; $c<sizeof($cont); $c++)
        {
            if($cont{$c}{'idAdmin'} == null)
            {
                echo '
                        <form action="index.php?main=answering" method="Post">
                            <h1>Contact : </h1>
                            <input name="id" type="number" value="'.$cont{$c}{'id'}.'" hidden>
                            <label for="dateTime">Date : </label><input name="dateTime" type="datetime" value="'.$cont{$c}{'date'}.'" readonly>
                            <label for="idAsk">idAsk : </label><input name="idAsk" type="text" value="'.$cont{$c}{'idPeople'}.'" readonly>
                            <label for="idAnswer">idAnswer : </label><input name="idAnswer" type="text" value="'.$_SESSION['User']{'id'}.'" readonly>
                            <label for="ask">Ask : </label><textarea name="ask" rows="10" cols="100" readonly>'.$cont{$c}{'ask'}.'</textarea>
                            <label for="answer">Answer : </label><textarea name="answer" rows="10" cols="100"></textarea>
                    
                            <input class="submit" type="submit" value="Submit" name="submit">
                        </form>
                        <button class="return">Return</button>';
            }
        }
    }

?>