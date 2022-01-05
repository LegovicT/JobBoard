<?php
    echo '
    <section class="companiesViewer">';
    $companies = SQLgetComp("", "", "");

    for($com=0; $com<sizeof($companies); $com++)
    {
        echo '
            <article id="company'.$companies{$com}{'id'}.'" class="companiesView">
            <form class="companyForm" action="index.php?main=valideCompanies" method="Post">
            <input name="id" type="number" value="'.$companies{$com}{'id'}.'" hidden>
                <h4>Name : <input class="nptCompany'.$companies{$com}{'id'}.'" name="name" type="text" value="'.$companies{$com}{'name'}.'" readonly> </h4> 
                <input id="modCompaniesSubmit" class="nptCompany'.$companies{$com}{'id'}.'"  type="submit" value="Submit" hidden>
            </form>
            <button id="com'.$companies{$com}{'id'}.'" class="modCompanies">Modify</button>
            <button id="com'.$companies{$com}{'id'}.'" class="delCompanies">Delete</button>
            </article>';
    }

    echo '
    <button class="addCompanies">Create</button>
</section>';
?>