<?php
    echo '
    <section class="profilesViewer">';
    $profiles = SQLgetPeople("", "", "");

    for($ppl=0; $ppl<sizeof($profiles); $ppl++)
    {
        echo '
            <article id="profile'.$profiles{$ppl}{'id'}.'" class="profilesView">
            <form class="profilForm" action="index.php?main=valideProfiles" method="Post">
            <input name="id" type="number" value="'.$profiles{$ppl}{'id'}.'" hidden>
                <h4>First name :  </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'" name="fname" type="text" value="'.$profiles{$ppl}{'fname'}.'" readonly>
                <h4>Last name :  </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'" name="lname" type="text" value="'.$profiles{$ppl}{'lname'}.'" readonly>
                <h4>Mail :  </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'" name="mail" type="email" value="'.$profiles{$ppl}{'mail'}.'" readonly> 
                <h4>Password :  </h4> <input id="psw" class="nptProfile'.$profiles{$ppl}{'id'}.'" name="password" type="password" value="'.$profiles{$ppl}{'password'}.'" readonly>
                    <div class="nptProfile'.$profiles{$ppl}{'id'}.'" id="passmod" hidden>
                        <h4>Fill your old Password : </h4><input name="oldPass" type="password" value="'.$profiles{$ppl}{'password'}.'">
                        <h4>Fill your new Password : </h4><input name="newPass" type="password" value="'.$profiles{$ppl}{'password'}.'">
                        <h4>Confirm your new Password : </h4><input name="confPass" type="password" value="'.$profiles{$ppl}{'password'}.'">
                    </div>
                    <label class="nptProfile" for="statut-select" hidden>Statut : </label>
                    <select onchange="statutChanged(this.value)" name="statut" class="nptProfile" hidden>
                        <option value="0">Candidate</option>
                        <option value="1">Recruiter</option>
                        <option value="2">Administrator</option>
                    </select>';
                switch($profiles{$ppl}{'statut'})
                {
                    case 0:
                        echo'
                        <h4>Statut : Candidate </h4> <input class="nptPro'.$profiles{$ppl}{'id'}.'" name="statut" type="text" value="0" readonly>';
                    break;
                    case 1:
                        echo'
                        <h4>Statut : Recruiter </h4> <input class="nptPro'.$profiles{$ppl}{'id'}.'" name="statut" type="text" value="1" readonly>';
                    break;
                    case 2:
                        echo'
                        <h4>Statut : Administrator </h4> <input class="nptPro'.$profiles{$ppl}{'id'}.'" name="statut" type="text" value="2" readonly>';
                    break;
                }
                echo'
                <h4>Birth date : </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'"  name="birthday" type="date" value="'.$profiles{$ppl}{'birthDate'}.'" readonly> 
                <h4>Address : </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'"  name="address" type="text" value="'.$profiles{$ppl}{'address'}.'" readonly>';
                if(isset(SQLgetComp("", "", $profiles{$ppl}{'mail'}){0}))
                {
                    echo'
                    <h4>My Company : </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'"  name="company" type="text" value="'.SQLgetComp("", "", $profiles{$ppl}{'mail'}){0}{'name'}.'" readonly>';
                }
                echo'
                <h4>Phone :  </h4> <input class="nptProfile'.$profiles{$ppl}{'id'}.'"  name="phone" type="phone" value="'.$profiles{$ppl}{'phone'}.'" readonly> 
                <input id="modProfileSubmit" class="nptProfile'.$profiles{$ppl}{'id'}.'"  type="submit" value="Submit" hidden>
            </form>
            <button id="pro'.$profiles{$ppl}{'id'}.'" class="modProfiles">Modify</button>
            <button id="pro'.$profiles{$ppl}{'id'}.'" class="delProfiles">Delete</button>
            </article>';
    }

    echo '
    <button class="addProfiles">Create</button>
</section>';
?>