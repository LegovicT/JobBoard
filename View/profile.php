<?php
    echo '
    <section class="profile">
        <form class="profilForm" action="index.php?main=valideProfile" method="Post">
            <h4>First name : <input class="nptProfile" name="fname" type="text" value="'.$_SESSION["User"]{'fname'}.'" readonly> </h4> 
            <h4>Last name : <input class="nptProfile" name="lname" type="text" value="'.$_SESSION["User"]{'lname'}.'" readonly></h4>
            <h4>Mail : <input class="nptProfile" name="mail" type="email" value="'.$_SESSION["User"]{'mail'}.'" readonly> </h4> 
            <h4>Password : <input id="psw" class="nptProfile" name="password" type="password" value="'.$_SESSION['User']{'password'}.'" readonly></h4> 
                <div id="passmod" hidden>
                    Fill your old Password <input name="oldPass" type="password" value="'.$_SESSION['User']{'password'}.'">
                    Fill your new Password <input name="newPass" type="password" value="'.$_SESSION['User']{'password'}.'">
                    Confirm your new Password <input name="confPass" type="password" value="'.$_SESSION['User']{'password'}.'">
                </div>';
            switch($_SESSION['User']{'statut'})
            {
                case 0:
                    echo'
                    <h4>Statut : <input name="statut" type="text" value="Candidate" readonly> </h4>';
                break;
                case 1:
                    echo'
                    <h4>Statut : <input name="statut" type="text" value="Recruiter" readonly> </h4>';
                break;
                case 2:
                    echo'
                    <h4>Statut : <input name="statut" type="text" value="Administrator" readonly> </h4>';
                break;
            }
    echo'
            <h4>Birth date : <input class="nptProfile" name="birthday" type="date" value="'.$_SESSION["User"]{'birthDate'}.'" readonly> 
            <h4>Address : <input class="nptProfile" name="address" type="text" value="'.$_SESSION["User"]{'address'}.'" readonly></h4>';
            if(isset(SQLgetComp("", "", $_SESSION["User"]{'mail'}){0}{'name'}))
            {
                echo'
                <h4>My Company : <input class="nptProfile" name="company" type="text" value="'.SQLgetComp("", "", $_SESSION["User"]{'mail'}){0}{'name'}.'" readonly></h4>';
            }
            
    echo'
            <h4>Phone : <input class="nptProfile" name="phone" type="phone" value="'.$_SESSION["User"]{'phone'}.'" readonly></h4> 
            <input id="modProfileSubmit" class="submit" type="submit" value="Submit" hidden>
        </form>
        <button class="modProfile">Modify</button>
    </section>';
?>