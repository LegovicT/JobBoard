<?php
$adv = $_SESSION['adApplied'];
if($_SESSION["User"]{'statut'} < 3)
{
    echo "
    <h2> Apply for </h2><h1>".$adv{'name'}."</h1>
    <h2> at </h2><h1>".SQLgetComp("", $adv{'name'}, ""){0}{'name'}."</h1>
    <form id=\"applyForm\" action=\"index.php?main=applied\" method=\"post\">
        <label for=\"fName\">First name : </label><input type=\"text\" name=\"fName\" placeholder=\"my first name\" value=".$_SESSION["User"]{"fname"}." required>
        <label for=\"lName\">Last name : </label><input type=\"text\" name=\"lName\" placeholder=\"my last name\" value=".$_SESSION["User"]{"lname"}." required>
        <label for=\"address\">Address : </label><input type=\"text\" name=\"address\" placeholder=\"n°? name street, postcode City\" value=".$_SESSION["User"]{"address"}.">
        <label for=\"birthday\">Birthday : </label><input type=\"date\" name=\"birthday\" placeholder=\"DD/MM/YYYY\" value=".$_SESSION["User"]{"birthDate"}.">
        <label for=\"mail\">E-mail : </label><input type=\"email\" name=\"mail\" placeholder=\"address@domain.ext\" value=".$_SESSION["User"]{"mail"}." required>
        <label for=\"phone\">Phone : </label><input type=\"phone\" name=\"phone\" placeholder=\"0123456789\" value=".$_SESSION["User"]{"phone"}.">
    
        <article>
            <label for=\"file\">Upload your resume</label>
            <input type=\"file\" id=\"resume\" name=\"resume\" accept=\".pdf\">
        </article>
        <article>
            <label for=\"letter\">Upload your cover letter</label>
            <textarea name=\"letter\" rows=\"10\" cols=\"100\">My cover letter</textarea>
        </article>
    
        <input  name=\"ppl\" type=\"hidden\" value=\"".$_SESSION["User"]{'id'}."\">
        <input  name=\"advId\" type=\"hidden\" value=\"".$adv{'id'}."\">
        <input  name=\"advName\" type=\"hidden\" value=\"".$adv{'name'}."\">
        
        <input class=\"submit\" type=\"submit\" value=\"Submit\" name=\"submit\">
        <button class=\"return\">Return</button>
    </form>";
}
else
{
    echo "
    <h2> Apply for </h2><h1>".$adv{'name'}."</h1>
    <h2> at </h2><h1>".SQLgetComp("", $adv{'name'}, ""){0}{'name'}."</h1>
    <form id=\"applyForm\" action=\"index.php?main=applied\" method=\"post\">
        <label for=\"fName\">First name : </label><input type=\"text\" name=\"fName\" placeholder=\"my first name\" required>
        <label for=\"lName\">Last name : </label><input type=\"text\" name=\"lName\" placeholder=\"my last name\" required>
        <label for=\"address\">Address : </label><input type=\"text\" name=\"address\" placeholder=\"n°? name street, postcode City\">
        <label for=\"birthDate\">Birthday : </label><input type=\"date\" name=\"birthDate\" placeholder=\"DD/MM/YYYY\">
        <label for=\"mail\">E-mail : </label><input type=\"email\" name=\"mail\" placeholder=\"address@domain.ext\" required>
        <label for=\"phone\">Phone : </label><input type=\"phone\" name=\"phone\" placeholder=\"0123456789\">
        <label for=\"password\">Password : </label><input type=\"password\" name=\"password\" placeholder=\"my password\" required>
        <label for=\"password\">Confirm password : </label><input type=\"password\" name=\"passwordConfirm\" placeholder=\"confirm my password\" required>
        <input type=\"number\" name=\"statut\"value=\"0\" hidden>
        <input hidden type='number' name='company' value=''>

        <article>
            <label for=\"file\">Upload your resume</label>
            <input type=\"file\" id=\"resume\" name=\"resume\" accept=\".pdf\">
        </article>
        <article>
            <label for=\"coverLetter\">Upload your cover letter</label>
            <textarea name=\"coverLetter\" rows=\"10\" cols=\"100\">My cover letter</textarea>
        </article>
        <article>
            <label for=\"file\">Upload you profile picture</label>
            <input type=\"file\" id=\"avatar\" name=\"avatar\" accept=\"image/*\">
        </article>
    
        <input  name=\"ppl\" type=\"hidden\" value=\"\">
        <input  name=\"advId\" type=\"hidden\" value=\"".$adv{'id'}."\">
        <input  name=\"advName\" type=\"hidden\" value=\"".$adv{'name'}."\">
        
        <input class=\"submit\" type=\"submit\" value=\"Submit\" name=\"submit\">
        <button class=\"return\">Return</button>
    </form>";
}