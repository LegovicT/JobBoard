$(document).ready(function()
{
    $('.learnMore').click(function()
    {
        var elem = this;
        $advertismentPage = elem.getAttribute('id').substr(12);
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=advertisment&advertismentPage="+$advertismentPage;
    });
    $('.apply').click(function()
    {
        var elem = this;
        $adApplied = elem.getAttribute('id').substr(9);
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=applyForm&adApplied="+$adApplied;
    });
    $('.modAds').click(function()
    {
        var elem = this;
        $adModified = elem.getAttribute('id').substr(6);
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=adModified&adModified="+$adModified;
    });
    $('.return').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=adsViewer";
    });
    $('.signIn').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=signForm";   
    });
    $('.login').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=login";   
    });
    $('#applyForm .submit').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=login"; 
    });
    $('.modProfile').click(function()
    {
        var elem = this;
        var sbmt = document.getElementById('modProfileSubmit');
        var passmod = document.getElementById('passmod');
        var psw = document.getElementById('psw');
        sbmt.hidden = false;
        passmod.hidden = false;
        elem.hidden = true;
        psw.hidden = true;
        var nptProfile = document.getElementsByClassName('nptProfile');
        for(var i=0; i < nptProfile.length; i++)
        {
            nptProfile[i].removeAttribute('readonly');
        }
    });
    $('#modLetterBTN').click(function()
    {
        var elem = this;
        var letter = document.getElementById('letter');
        letter.readOnly = false;
        var btn = document.getElementById('modLetterBTN');
        btn.hidden = true;
        var sbmt = document.getElementById('modLetterSbmt');
        sbmt.hidden = false;
    });
    $('.modProfiles').click(function()
    {
        var elems = "";
        var elem = this;
        $idPpl = elem.getAttribute('id').substr(3);
        //alert("modify profile : "+$idPpl);
        var nptPro = document.getElementsByClassName('nptPro'+$idPpl);
        for(var i=0; i < nptPro.length; i++)
        {
            nptPro[i].hidden = true;
        }
        var nptProfile = document.getElementsByClassName('nptProfile'+$idPpl);
        for(var i=0; i < nptProfile.length; i++)
        {
            nptProfile[i].hidden = false;
            nptProfile[i].removeAttribute('readonly');
        }
        elem.hidden = true;
    });
    $('.delProfiles').click(function()
    {
        var elem = this;
        $idPpl = elem.getAttribute('id').substr(3);
        //alert("delete profile : "+$idPpl);
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=delProfile&pro="+$idPpl; 

        
    });
    $('.addProfiles').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=addProfile"; 
    });
    $('.modCompanies').click(function()
    {
        var elems = "";
        var elem = this;
        $idcom = elem.getAttribute('id').substr(3);
        //alert("modify compnay : "+$idcom);
        var nptCom = document.getElementsByClassName('nptCom'+$idcom);
        for(var i=0; i < nptCom.length; i++)
        {
            nptCom[i].hidden = true;
        }
        var nptCompany = document.getElementsByClassName('nptCompany'+$idcom);
        for(var i=0; i < nptCompany.length; i++)
        {
            nptCompany[i].hidden = false;
            nptCompany[i].removeAttribute('readonly');
        }
        elem.hidden = true;
    });
    $('.delCompanies').click(function()
    {
        var elem = this;
        $idcom = elem.getAttribute('id').substr(3);
        //alert("delete company : "+$idcom);
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=delCompany&com="+$idcom; 

        
    });
    $('.addCompanies').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=addCompany"; 
    });
    $('.modFields').click(function()
    {
        var elems = "";
        var elem = this;
        $idFld = elem.getAttribute('id').substr(3);
        //alert("modify field : "+$idFld);
        var nptFld = document.getElementsByClassName('nptFld'+$idFld);
        for(var i=0; i < nptFld.length; i++)
        {
            nptFld[i].hidden = true;
        }
        var nptField = document.getElementsByClassName('nptField'+$idFld);
        for(var i=0; i < nptField.length; i++)
        {
            nptField[i].hidden = false;
            nptField[i].removeAttribute('readonly');
        }
        elem.hidden = true;
    });
    $('.delFields').click(function()
    {
        var elem = this;
        $idFld = elem.getAttribute('id').substr(3);
        //alert("delete field : "+$idFld);
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=delnptField&fld="+$idFld; 

        
    });
    $('.addFields').click(function()
    {
        document.location.href="http://localhost/JobBoard/Step5/index.php?main=addField"; 
    });
})

