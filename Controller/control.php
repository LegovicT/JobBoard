<?php

function getControl()
{
//GET THE SEARCHBAR RESULT
    if(isset($_GET['q']))
    {
        $_SESSION['q'] = array('field' => array(), 'company' => array(), 'advertisment' => array());
        $fields = SQLgetField("", "");
        $companies = SQLgetComp("", "", "");
        $advertisments = SQLgetAds("", "", "");

        // the query contains a field
        for($f=0; $f<sizeof($fields); $f++)
        {
            if(strpos(strtoupper($_GET['q']), strtoupper($fields{$f}{'name'})) !== false)
            {
                if(isset($_SESSION["field"]) && $_SESSION["field"] != "")
                {
                    array_push($_SESSION['q']{'field'}, $fields{$f});
                    $_SESSION["field"] .= ",".$fields{$f}{'name'};
                }
                else
                {
                    $_SESSION["field"] = $fields{$f}{'name'};
                    array_push($_SESSION['q']{'field'}, $fields{$f});
                }
            }
        }

        // the query contains a company
        for($c=0; $c<sizeof($companies); $c++)
        {
            if(strpos(strtoupper($_GET['q']), strtoupper($companies{$c}{'name'})) !== false || ($_GET['q'] != null && strpos(strtoupper($companies{$c}{'name'}), strtoupper($_GET['q'])) !== false))
            {
                array_push($_SESSION['q']{'company'}, $companies{$c});
            }
        }

        // the query contains an advertisment
        for($a=0; $a<sizeof($advertisments); $a++)
        {
            if(strpos(strtoupper($_GET['q']), strtoupper($advertisments{$a}{'name'})) !== false || ($_GET['q'] != null && strpos(strtoupper($advertisments{$a}{'name'}), strtoupper($_GET['q'])) !== false))
            {
                array_push($_SESSION['q']{'advertisment'}, $advertisments{$a});
            }
        }
    }

//CONTROL PAGES DISPLAYED FROM THE USER RIGHT & THE MAIN
    if(isset($_SESSION['User']) && $_SESSION['User'] != null)       // the user is connected
    {
        if($_SESSION['User']{'statut'} == 0)                            // the user is a candidate
        {
            if(isset($_SESSION['main']))                                    // session variable "main" has been filled in
            {
                if($_SESSION['main'] == "advertisment")                         // visite an advertisment page
                {
                    include "View/advertisment.php";
                }
                else if($_SESSION['main'] == "adsViewer")                       // visite the advertisments viewer page
                {
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "applyForm")                       // visite the apply form page
                {
                    include "View/applyForm.php";
                }
                else if($_SESSION['main'] == "applied")                         // valide the apply form page
                {
                    $_SESSION['apply'] = $_POST;
                    if(SQLgetInfo("", $_POST['advName'], $_POST['mail']) == null)
                    {
                        SQLaddInfo($_POST['advId'], $_POST['ppl']);
                    }
                    
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "adModified")                      // visite the modify advertisment page
                {
                    $_SESSION['adModified'] = $_GET['adModified'];
                    if(!isset($_SESSION['adModified']))
                    {
                        header("Location : index.php?main=adModified");
                    }
                    else
                    {
                        include "View/modifyAds.php";
                    }
                }
                else if($_SESSION['main'] == "valideAdsModified")               // valide the modify advertisment
                {
                    $myAdd = sqlRead("advertisment", "*", "id = '".$_POST['id']."'"){0};
                    $myFields = SQLgetField("", $myAdd{'name'});
                    $newArr = array('id'=>'', 'name'=>'', 'idAdvertisment'=>'');
                    array_push($myFields, $newArr, $newArr, $newArr, $newArr, $newArr);
                    $return = "";
                    if($_POST['name'] != $myAdd{'name'})
                    {
                        SQLmodAds("name", $_POST['name'], $_POST['id']);
                    }
                    if($_POST['shortDescrib'] != $myAdd{'shortDescrib'})
                    {
                        SQLmodAds("shortDescrib", $_POST['shortDescrib'], $_POST['id']);
                    }
                    if($_POST['longDescrib'] != $myAdd{'longDescrib'})
                    {
                        SQLmodAds("longDescrib", $_POST['longDescrib'], $_POST['id']);
                    }
                    if($_POST['wages'] != $myAdd{'wages'})
                    {
                        SQLmodAds("wages", $_POST['wages'], $_POST['id']);
                    }
                    if($_POST['place'] != $myAdd{'place'})
                    {
                        SQLmodAds("place", $_POST['place'], $_POST['id']);
                    }
                    if($_POST['workingTime'] != $myAdd{'workingTime'})
                    {
                        SQLmodAds("workingTime", $_POST['workingTime'], $_POST['id']);
                    }

                        $fields = SQLgetField("", "");
                    if($_POST['field1'] != $myFields{0}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field1'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{0}{'name'} != "" && $_POST['field1'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{0}{'name'} != "" && $_POST['field1'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field2'] != $myFields{1}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field2'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{1}{'name'} != "" && $_POST['field2'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{1}{'name'} != "" && $_POST['field2'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field3'] != $myFields{2}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field3'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{2}{'name'} != "" && $_POST['field3'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{2}{'name'} != "" && $_POST['field3'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field4'] != $myFields{3}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field4'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{3}{'name'} != "" && $_POST['field4'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{3}{'name'} != "" && $_POST['field4'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field5'] != $myFields{4}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field5'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{4}{'name'} != "" && $_POST['field5'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{4}{'name'} != "" && $_POST['field5'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }

                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "viewProfile")                     // visite the profile page
                {
                    include "View/profile.php";
                }
                else if($_SESSION['main'] == "valideProfile")                   // valide the profile modification
                {
                    $return = "";
                    if($_POST['fname'] != $_SESSION['User']{'fname'})
                    {
                        SQLmodPeople("fname", $_POST['fname'], $_SESSION['User']{'id'});
                    }
                    if($_POST['lname'] != $_SESSION['User']{'lname'})
                    {
                        SQLmodPeople("lname", $_POST['lname'], $_SESSION['User']{'id'});
                    }
                    if($_POST['mail'] != $_SESSION['User']{'mail'})
                    {
                        $people = SQLgetPeople("", "", "");
                        $change = false;
                        for($ppl = 0; $ppl < sizeof($people); $ppl++)
                        {
                            if($people{$ppl}{'mail'} == $_POST['mail'])
                            {
                                $change = true;
                            }
                        }
                        if(!$change)
                        {
                            SQLmodPeople("mail", $_POST['mail'], $_SESSION['User']{'id'});
                        }
                        else
                        {
                            $return .= $_POST['mail']." existe déja. ";
                        }
                    }
                    if($_POST['newPass'] != $_SESSION['User']{'password'})
                    {
                        SQLmodPeople("password", $_POST['newPass'], $_SESSION['User']{'id'});
                    }
                    if($_POST['birthday'] != $_SESSION['User']{'birthDate'})
                    {
                        SQLmodPeople("birthDate", $_POST['birthday'], $_SESSION['User']{'id'});
                    }
                    if($_POST['address'] != $_SESSION['User']{'address'})
                    {
                        SQLmodPeople("address", $_POST['address'], $_SESSION['User']{'id'});
                    }
                        
                        $comp = SQLgetComp("", "", "");
                        $sessionComp = "";
                        for($i=0; $i<sizeof($comp); $i++)
                        {
                            if($_SESSION['User']{'idCompany'} == $comp{$i}{'id'})
                            {
                                $sessionComp = $comp{$i}{'name'};
                            }
                        }
                    if($_POST['company'] != $sessionComp)
                    {
                        $change = SQLgetComp("", "", $_SESSION['User']{'mail'}){'id'};
                        for($c = 0; $c < sizeof($comp); $c++)
                        {
                            if($comp{$c}{'name'} == $_POST['company'])
                            {
                                $change = $comp{$c}{'id'};
                            }
                        }
                        if($change != SQLgetComp("", "", $_SESSION['User']{'mail'}){'id'})
                        {
                            SQLmodPeople("idCompany", $change, $_SESSION['User']{'id'});
                        }
                        else
                        {
                            $return .= $_POST['company']." n'existe pas. ";
                        }
                    }
                    if($_POST['phone'] != $_SESSION['User']{'phone'})
                    {
                        SQLmodPeople("phone", $_POST['phone'], $_SESSION['User']{'id'});
                    }

                    if($return != "")
                    {
                        echo $return;
                    }

                    for($p=0; $p<sizeof(SQLgetPeople("","","")); $p++)
                    {
                        if(SQLgetPeople("","",""){$p}{'id'} == $_SESSION['User']{'id'})
                        {
                            $_SESSION['User'] = SQLgetPeople("","",""){$p};
                        }
                    }
                    header("Location: index.php?main=viewProfile");
                }
                else if($_SESSION['main'] == "disconnect")                      // disconnect the profile
                {
                    session_destroy();
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "contact")                         // visit the contact form
                {
                    include "View/contact.php";
                }
                else if($_SESSION['main'] == 'contacted')                       // valide the contact form
                {
                    SQLaddMail($_POST['idInformation'], $_POST['coverLetter'], $_POST['dateTime'], $_POST['receiver'], $_POST['sender']);
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == 'contactAdm')                      // visite the contact admin
                {
                    include "View/adminContact.php";
                }
                else if($_SESSION['main'] == 'asking')                          // valide the contact admin
                {
                    $ask;
                    $answer;
                    $dateTime;
                    $idPeople;
                    $idAdmin;
                    if(isset($_POST['ask']) && $_POST['ask'] != null)
                    {$ask = $_POST['ask'];}else{$ask="";}
                    if(isset($_POST['answer']) && $_POST['answer'] != null)
                    {$answer = $_POST['answer'];}else{$answer="";}
                    if(isset($_POST['dateTime']) && $_POST['dateTime'] != null)
                    {$dateTime = $_POST['dateTime'];}else{$dateTime="";}
                    if(isset($_POST['idAsk']) && $_POST['idAsk'] != null)
                    {$idPeople = $_POST['idAsk'];}else{$idPeople="";}
                    if(isset($_POST['idAnswer']) && $_POST['idAnswer'] != null)
                    {$idAdmin = $_POST['idAnswer'];}else{$idAdmin="";}
                    SQLaddContactAdmin($ask, $answer, $dateTime, $idPeople, $idAdmin);
                    header("Location: index.php?main=home");
                }
                else if(substr($_SESSION['main'], 0, 7) == "contact")           // contact a people or a company
                {
                    $_SESSION['Contact']{'receiver'} = explode(',', $_SESSION['main'])[1];
                    $_SESSION['Contact']{'advertisment'} = explode(',', $_SESSION['main'])[2];
                    header("Location: index.php?main=contact");
                }
                else if($_SESSION['main'] == "modLetter")                       // valide the modification of the coverletter
                {
                    SQLmodInfo("coverLetter", $_POST['letter'], $_POST['advertisment']);
                    header("Location: index.php?main=contact");
                }
                else if($_SESSION['main'] == 'myOffers')                        // visite the advertisments posted
                {
                    include "View/myOffers.php";
                }
                else if($_SESSION['main'] == 'myApplies')                       // visite the advertisments applied
                {
                    include "View/myApplies.php";
                }
                else                                                            // by default visite the advertisments viewer page
                {
                    include "View/adsViewer.php";
                }
            }
            else                                                            // by default visite the advertisments viewer page
            {
                include "View/adsViewer.php";
            }

        }
        else if($_SESSION['User']{'statut'} == 1)                       // the user is a recruiter
        {
            if(isset($_SESSION['main']))                                    // session variable "main" has been filled in
            {
                if($_SESSION['main'] == "advertisment")                         // visite an advertisment page
                {
                    include "View/advertisment.php";
                }
                else if($_SESSION['main'] == "adsViewer")                       // visite the advertisments viewer page
                {
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "applyForm")                       // visite the apply form page
                {
                    include "View/applyForm.php";
                }
                else if($_SESSION['main'] == "applied")                         // valide the apply form page
                {
                    $_SESSION['apply'] = $_POST;
                    if(SQLgetInfo("", $_POST['advName'], $_POST['mail']) == null)
                    {
                        SQLaddInfo($_POST['advId'], $_POST['ppl']);
                    }
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "adModified")                      // visite the modify advertisment page
                {
                    $_SESSION['adModified'] = $_GET['adModified'];
                    if(!isset($_SESSION['adModified']))
                    {
                        header('index.php?main=adModified');
                    }
                    else
                    {
                        include "View/modifyAds.php";
                    }
                }
                else if($_SESSION['main'] == "valideAdsModified")               // valide the modify advertisment
                {
                    $myAdd = sqlRead("advertisment", "*", "id = '".$_POST['id']."'"){0};
                    $myFields = SQLgetField("", $myAdd{'name'});
                    $newArr = array('id'=>'', 'name'=>'', 'idAdvertisment'=>'');
                    array_push($myFields, $newArr, $newArr, $newArr, $newArr, $newArr);
                    $return = "";
                    if($_POST['name'] != $myAdd{'name'})
                    {
                        SQLmodAds("name", $_POST['name'], $_POST['id']);
                    }
                    if($_POST['shortDescrib'] != $myAdd{'shortDescrib'})
                    {
                        SQLmodAds("shortDescrib", $_POST['shortDescrib'], $_POST['id']);
                    }
                    if($_POST['longDescrib'] != $myAdd{'longDescrib'})
                    {
                        SQLmodAds("longDescrib", $_POST['longDescrib'], $_POST['id']);
                    }
                    if($_POST['wages'] != $myAdd{'wages'})
                    {
                        SQLmodAds("wages", $_POST['wages'], $_POST['id']);
                    }
                    if($_POST['place'] != $myAdd{'place'})
                    {
                        SQLmodAds("place", $_POST['place'], $_POST['id']);
                    }
                    if($_POST['workingTime'] != $myAdd{'workingTime'})
                    {
                        SQLmodAds("workingTime", $_POST['workingTime'], $_POST['id']);
                    }

                        $fields = SQLgetField("", "");
                    if($_POST['field1'] != $myFields{0}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field1'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{0}{'name'} != "" && $_POST['field1'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{0}{'name'} != "" && $_POST['field1'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field2'] != $myFields{1}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field2'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{1}{'name'} != "" && $_POST['field2'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{1}{'name'} != "" && $_POST['field2'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field3'] != $myFields{2}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field3'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{2}{'name'} != "" && $_POST['field3'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{2}{'name'} != "" && $_POST['field3'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field4'] != $myFields{3}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field4'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{3}{'name'} != "" && $_POST['field4'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{3}{'name'} != "" && $_POST['field4'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field5'] != $myFields{4}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field5'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{4}{'name'} != "" && $_POST['field5'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{4}{'name'} != "" && $_POST['field5'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }

                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "viewProfile")                     // visite the profile page
                {
                    include "View/profile.php";
                }
                else if($_SESSION['main'] == "valideProfile")                   // valide the profile modification
                {
                    $return = "";
                    if($_POST['fname'] != $_SESSION['User']{'fname'})
                    {
                        SQLmodPeople("fname", $_POST['fname'], $_SESSION['User']{'id'});
                    }
                    if($_POST['lname'] != $_SESSION['User']{'lname'})
                    {
                        SQLmodPeople("lname", $_POST['lname'], $_SESSION['User']{'id'});
                    }
                    if($_POST['mail'] != $_SESSION['User']{'mail'})
                    {
                        $people = SQLgetPeople("", "", "");
                        $change = false;
                        for($ppl = 0; $ppl < sizeof($people); $ppl++)
                        {
                            if($people{$ppl}{'mail'} == $_POST['mail'])
                            {
                                $change = true;
                            }
                        }
                        if(!$change)
                        {
                            SQLmodPeople("mail", $_POST['mail'], $_SESSION['User']{'id'});
                        }
                        else
                        {
                            $return .= $_POST['mail']." existe déja. ";
                        }
                    }
                    if($_POST['newPass'] != $_SESSION['User']{'password'})
                    {
                        SQLmodPeople("password", $_POST['newPass'], $_SESSION['User']{'id'});
                    }
                    if($_POST['birthday'] != $_SESSION['User']{'birthDate'})
                    {
                        SQLmodPeople("birthDate", $_POST['birthday'], $_SESSION['User']{'id'});
                    }
                    if($_POST['address'] != $_SESSION['User']{'address'})
                    {
                        SQLmodPeople("address", $_POST['address'], $_SESSION['User']{'id'});
                    }
                    
                        $comp = SQLgetComp("", "", "");
                        $sessionComp = "";
                        for($i=0; $i<sizeof($comp); $i++)
                        {
                            if($_SESSION['User']{'idCompany'} == $comp{$i}{'id'})
                            {
                                $sessionComp = $comp{$i}{'name'};
                            }
                        }
                    if($_POST['company'] != $sessionComp)
                    {
                        $change = SQLgetComp("", "", $_SESSION['User']{'mail'}){'id'};
                        for($c = 0; $c < sizeof($comp); $c++)
                        {
                            if($comp{$c}{'name'} == $_POST['company'])
                            {
                                $change = $comp{$c}{'id'};
                            }
                        }
                        if($change != SQLgetComp("", "", $_SESSION['User']{'mail'}){'id'})
                        {
                            SQLmodPeople("idCompany", $change, $_SESSION['User']{'id'});
                        }
                        else
                        {
                            $return .= $_POST['company']." n'existe pas. ";
                        }
                    }
                    if($_POST['phone'] != $_SESSION['User']{'phone'})
                    {
                        SQLmodPeople("phone", $_POST['phone'], $_SESSION['User']{'id'});
                    }

                    if($return != "")
                    {
                        echo $return;
                    }

                    for($p=0; $p<sizeof(SQLgetPeople("","","")); $p++)
                    {
                        if(SQLgetPeople("","",""){$p}{'id'} == $_SESSION['User']{'id'})
                        {
                            $_SESSION['User'] = SQLgetPeople("","",""){$p};
                        }
                    }
                    header("Location: index.php?main=viewProfile");
                }
                else if($_SESSION['main'] == "disconnect")                      // disconnect the profile
                {
                    session_destroy();
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "contact")                         // visite the contact form
                {
                    include "View/contact.php";
                }
                else if($_SESSION['main'] == 'contacted')                       // valide the contact form
                {
                    SQLaddMail($_POST['idInformation'], $_POST['coverLetter'], $_POST['dateTime'], $_POST['receiver'], $_POST['sender']);
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == 'contactAdm')                      // visite the contact admin
                {
                    include "View/adminContact.php";
                }
                else if($_SESSION['main'] == 'asking')                          // valide the contact admin
                {
                    $ask;
                    $answer;
                    $dateTime;
                    $idAsk;
                    $idAnswer;
                    if(isset($_POST['ask']) && $_POST['ask'] != null)
                    {$ask = $_POST['ask'];}else{$ask="";}
                    if(isset($_POST['answer']) && $_POST['answer'] != null)
                    {$answer = $_POST['answer'];}else{$answer="";}
                    if(isset($_POST['dateTime']) && $_POST['dateTime'] != null)
                    {$dateTime = $_POST['dateTime'];}else{$dateTime="";}
                    if(isset($_POST['idAsk']) && $_POST['idAsk'] != null)
                    {$idAsk = $_POST['idAsk'];}else{$idAsk="";}
                    if(isset($_POST['idAnswer']) && $_POST['idAnswer'] != null)
                    {$idAnswer = $_POST['idAnswer'];}else{$idAnswer="";}
                    SQLaddContactAdmin($ask, $answer, $dateTime, $idAsk, $idAnswer);
                    header("Location: index.php?main=home");
                }
                else if(substr($_SESSION['main'], 0, 7) == "contact")           // contact a people or a company
                {
                    $_SESSION['Contact']{'receiver'} = explode(',', $_SESSION['main'])[1];
                    $_SESSION['Contact']{'advertisment'} = explode(',', $_SESSION['main'])[2];
                    header("Location: index.php?main=contact");
                }
                else if($_SESSION['main'] == "modLetter")                       // valide the modification of the coverletter
                {
                    SQLmodInfo("coverLetter", $_POST['letter'], $_POST['advertisment']);
                    //header("Location: index.php?main=contact");
                }
                else if($_SESSION['main'] == "postOffer")                       // visite the post offer form page
                {
                    include "View/postForm.php";
                }
                else if($_SESSION['main'] == "posted")                          // valide the post offer form page
                {
                    $_SESSION['postOffer'] = $_POST;
                    if(SQLgetAds("", $_POST['name'] , "") == null)
                    {
                        if(SQLaddAdv($_POST['name'], $_POST['idCompany'], $_POST['shortDescrib'], $_POST['longDescrib'], $_POST['wages'], $_POST['place'], $_POST['workingTime']) == null)
                        {
                            if(isset($_POST['field1']) && $_POST['field1'] != "")
                            {
                                $fields = SQLgetField("", "");
                                for($field=0; $field < sizeof($fields); $field++)
                                {
                                    if($fields{$field}{'name'} == $_POST['field1'])
                                    {
                                        SQLaddAdsField(end(SQLgetAds("", "", "")){'id'}, $fields{$field}{'id'});
                                    }
                                }
                            }
                            
                            if(isset($_POST['field2']) && $_POST['field2'] != "")
                            {
                                $fields = SQLgetField("", "");
                                for($field=0; $field < sizeof($fields); $field++)
                                {
                                    if($fields{$field}{'name'} == $_POST['field2'])
                                    {
                                        SQLaddAdsField(end(SQLgetAds("", "", "")){'id'}, $fields{$field}{'id'});
                                    }
                                }
                            }
                            
                            if(isset($_POST['field3']) && $_POST['field3'] != "")
                            {
                                $fields = SQLgetField("", "");
                                for($field=0; $field < sizeof($fields); $field++)
                                {
                                    if($fields{$field}{'name'} == $_POST['field3'])
                                    {
                                        SQLaddAdsField(end(SQLgetAds("", "", "")){'id'}, $fields{$field}{'id'});
                                    }
                                }
                            }
                            
                            if(isset($_POST['field4']) && $_POST['field4'] != "")
                            {
                                $fields = SQLgetField("", "");
                                for($field=0; $field < sizeof($fields); $field++)
                                {
                                    if($fields{$field}{'name'} == $_POST['field4'])
                                    {
                                        SQLaddAdsField(end(SQLgetAds("", "", "")){'id'}, $fields{$field}{'id'});
                                    }
                                }
                            }
                            
                            if(isset($_POST['field5']) && $_POST['field5'] != "")
                            {
                                $fields = SQLgetField("", "");
                                for($field=0; $field < sizeof($fields); $field++)
                                {
                                    if($fields{$field}{'name'} == $_POST['field5'])
                                    {
                                        SQLaddAdsField(end(SQLgetAds("", "", "")){'id'}, $fields{$field}{'id'});
                                    }
                                }
                            }
                        }
                    }
                    
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == 'myOffers')                        // visite the advertisments posted
                {
                    include "View/myOffers.php";
                }
                else if($_SESSION['main'] == 'myApplies')                       // visite the advertisments applied
                {
                    include "View/myApplies.php";
                }
                else                                                            // by default visite the advertisments viewer page
                {
                    include "View/adsViewer.php";
                }
            }
            else                                                            // by default visite the advertisments viewer page
            {
                include "View/adsViewer.php";
            }
        }
        else if($_SESSION['User']{'statut'} == 2)                       // the user is an administrator
        {
            if(isset($_SESSION['main']))                                    // session variable "main" has been filled in
            {
                if($_SESSION['main'] == "advertisment")                         // visite an advertisment page
                {
                    include "View/advertisment.php";
                }
                else if($_SESSION['main'] == "adsViewer")                       // visite the advertisments viewer page
                {
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "applyForm")                       // visite the apply form page
                {
                    include "View/applyForm.php";
                }
                else if($_SESSION['main'] == "applied")                         // valide the apply form page
                {
                    $_SESSION['apply'] = $_POST;
                    if(SQLgetInfo("", $_POST['advName'], $_POST['mail']) == null)
                    {
                        SQLaddInfo($_POST['advId'], $_POST['ppl']);
                    }

                    $info = SQLgetInfo("", $_POST['advName'], $_POST['mail']);
                    SQLaddMail($info{0}{'id'}, $_POST['letter'], date("Y-m-d H:i:s"));
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "adModified")                      // visite the modify advertisment page
                {
                    $_SESSION['adModified'] = $_GET['adModified'];
                    if(!isset($_SESSION['adModified']))
                    {
                        header('index.php?main=adModified');
                    }
                    else
                    {
                        include "View/modifyAds.php";
                    }
                }
                else if($_SESSION['main'] == "valideAdsModified")               // valide the modify advertisment
                {
                    $myAdd = sqlRead("advertisment", "*", "id = '".$_POST['id']."'"){0};
                    $myFields = SQLgetField("", $myAdd{'name'});
                    $newArr = array('id'=>'', 'name'=>'', 'idAdvertisment'=>'');
                    array_push($myFields, $newArr, $newArr, $newArr, $newArr, $newArr);
                    $return = "";
                    if($_POST['name'] != $myAdd{'name'})
                    {
                        SQLmodAds("name", $_POST['name'], $_POST['id']);
                    }
                    if($_POST['shortDescrib'] != $myAdd{'shortDescrib'})
                    {
                        SQLmodAds("shortDescrib", $_POST['shortDescrib'], $_POST['id']);
                    }
                    if($_POST['longDescrib'] != $myAdd{'longDescrib'})
                    {
                        SQLmodAds("longDescrib", $_POST['longDescrib'], $_POST['id']);
                    }
                    if($_POST['wages'] != $myAdd{'wages'})
                    {
                        SQLmodAds("wages", $_POST['wages'], $_POST['id']);
                    }
                    if($_POST['place'] != $myAdd{'place'})
                    {
                        SQLmodAds("place", $_POST['place'], $_POST['id']);
                    }
                    if($_POST['workingTime'] != $myAdd{'workingTime'})
                    {
                        SQLmodAds("workingTime", $_POST['workingTime'], $_POST['id']);
                    }

                        $fields = SQLgetField("", "");
                    if($_POST['field1'] != $myFields{0}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field1'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{0}{'name'} != "" && $_POST['field1'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{0}{'name'} != "" && $_POST['field1'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field2'] != $myFields{1}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field2'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{1}{'name'} != "" && $_POST['field2'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{1}{'name'} != "" && $_POST['field2'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field3'] != $myFields{2}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field3'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{2}{'name'} != "" && $_POST['field3'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{2}{'name'} != "" && $_POST['field3'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field4'] != $myFields{3}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field4'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{3}{'name'} != "" && $_POST['field4'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{3}{'name'} != "" && $_POST['field4'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }
                    if($_POST['field5'] != $myFields{4}{'name'})
                    {
                        $fId;
                        for($mf=0; $mf<sizeof($fields); $mf++)
                        {
                            if($_POST['field5'] == $fields{$mf}{'name'})
                            {$fId=$fields{$mf}{'id'};}
                        }
                        if($myFields{4}{'name'} != "" && $_POST['field5'] != "")
                        {
                            SQLmodAdsField("idField", $fId, $_POST['id']);
                        }
                        else if($myFields{4}{'name'} != "" && $_POST['field5'] == "")
                        {
                            SQLdelAdsField($fId);
                        }
                        else
                        {
                            SQLaddAdsField($_POST['id'], $fId);
                        }
                    }

                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "viewProfile")                     // visite the profile page
                {
                    include "View/profile.php";
                }
                else if($_SESSION['main'] == "profiles")                        // visite the profiles viewer
                {
                    include "View/profilesViewer.php";
                }
                else if($_SESSION['main'] == "delProfile")                      // visite the profile destructor page
                {
                    include "View/delProfile.php";
                }
                else if($_SESSION['main'] == "addProfile")                      // visite the profile creator page
                {
                    include "View/addProfile.php";
                }
                else if($_SESSION['main'] == "profileAdded")                    // valide the profile creator page
                {
                    $resp = signin($_POST['fName'], $_POST['lName'], $_POST['mail'], $_POST['password'], $_POST['birthDate'], $_POST['address'], $_POST['statut'], $_POST['company'], $_POST['phone'], $_POST['resume'], $_POST['coverLetter'], $_POST['avatar']);
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "valideProfiles")                  // valide the profile modification
                {
                    $proId = $_POST['id'];
                    $proMod = SQLgetPeople("", "", "");
                    $profileMod;
                    for($p=0; $p<sizeof($proMod); $p++)
                    {
                        if($proMod{$p}{'id'} == $proId)
                        {
                            $profileMod = $proMod{$p};
                        }
                    }
                    $return = "";
                    if($_POST['fname'] != $profileMod{'fname'})
                    {
                        SQLmodPeople("fname", $_POST['fname'], $proId);
                    }
                    if($_POST['lname'] != $profileMod{'lname'})
                    {
                        SQLmodPeople("lname", $_POST['lname'], $proId);
                    }
                    if($_POST['mail'] != $profileMod{'mail'})
                    {
                        $people = SQLgetPeople("", "", "");
                        $change = false;
                        for($ppl = 0; $ppl < sizeof($people); $ppl++)
                        {
                            if($people{$ppl}{'mail'} == $_POST['mail'])
                            {
                                $change = true;
                            }
                        }
                        if(!$change)
                        {
                            SQLmodPeople("mail", $_POST['mail'], $proId);
                        }
                        else
                        {
                            $return .= $_POST['mail']." existe déja. ";
                        }
                    }
                    if($_POST['newPass'] != $profileMod{'password'})
                    {
                        SQLmodPeople("password", $_POST['newPass'], $proId);
                    }
                    if($_POST['birthday'] != $profileMod{'birthDate'})
                    {
                        SQLmodPeople("birthDate", $_POST['birthday'], $proId);
                    }
                    if($_POST['address'] != $profileMod{'address'})
                    {
                        SQLmodPeople("address", $_POST['address'], $proId);
                    }
                        
                        $comp = SQLgetComp("", "", "");
                        $sessionComp = "";
                        for($i=0; $i<sizeof($comp); $i++)
                        {
                            if($profileMod{'idCompany'} == $comp{$i}{'id'})
                            {
                                $sessionComp = $comp{$i}{'name'};
                            }
                        }
                    if($_POST['company'] != $sessionComp)
                    {
                        $change = SQLgetComp("", "", $profileMod{'mail'}){'id'};
                        for($c = 0; $c < sizeof($comp); $c++)
                        {
                            if($comp{$c}{'name'} == $_POST['company'])
                            {
                                $change = $comp{$c}{'id'};
                            }
                        }
                        if($change != SQLgetComp("", "", $profileMod{'mail'}){'id'})
                        {
                            SQLmodPeople("idCompany", $change, $proId);
                        }
                        else
                        {
                            $return .= $_POST['company']." n'existe pas. ";
                        }
                    }
                    if($_POST['phone'] != $profileMod{'phone'})
                    {
                        SQLmodPeople("phone", $_POST['phone'], $proId);
                    }

                    if($return != "")
                    {
                        echo $return;
                    }

                    for($p=0; $p<sizeof(SQLgetPeople("","","")); $p++)
                    {
                        if(SQLgetPeople("","",""){$p}{'id'} == $proId)
                        {
                            $profileMod = SQLgetPeople("","",""){$p};
                        }
                    }
                    header("Location: index.php?main=viewProfiles");
                }
                else if($_SESSION['main'] == "companies")                       // visite the companies viewer
                {
                    include "View/companiesViewer.php";
                }
                else if($_SESSION['main'] == "delCompany")                      // visite the company destructor
                {
                    include "View/delCompany.php";
                }
                else if($_SESSION['main'] == "addCompany")                      // visite the company creator
                {
                    include "View/addCompany.php";
                }
                else if($_SESSION['main'] == "companyAdded")                    // valide the company creator page
                {
                    SQLaddComp($_POST['name']);
                    header("Location: index.php?main=companies");
                }
                else if($_SESSION['main'] == "valideCompanies")                 // valide the company modification
                {
                    $comId = $_POST['id'];
                    $comMod = SQLgetComp("", "", "");
                    $companyMod;
                    for($c=0; $c<sizeof($comMod); $c++)
                    {
                        if($comMod{$c}{'id'} == $comId)
                        {
                            $companyMod = $comMod{$c};
                        }
                    }
                    if($_POST['name'] != $companyMod{'name'})
                    {
                        SQLmodComp("name", $_POST['name'], $comId);
                    }
                    header("Location: index.php?main=companies");
                }
                else if($_SESSION['main'] == "fields")                          // visite the fields viewer
                {
                    include "View/fieldsViewer.php";
                }
                else if($_SESSION['main'] == "delField")                        // visite the field destructor
                {
                    include "View/delField.php";
                }
                else if($_SESSION['main'] == "addField")                        // visite the field constructor
                {
                    include "View/addField.php";
                }
                else if($_SESSION['main'] == "fieldAdded")                      // valide the field constructor page
                {
                    SQLaddField($_POST['name']);
                    header("Location: index.php?main=fields");
                }
                else if($_SESSION['main'] == "valideFields")                    // valide the field modification
                {
                    $fldId = $_POST['id'];
                    $fldMod = SQLgetField("", "", "");
                    $fieldMod;
                    for($f=0; $f<sizeof($fldMod); $f++)
                    {
                        if($fldMod{$f}{'id'} == $fldId)
                        {
                            $fieldMod = $fldMod{$f};
                        }
                    }
                    if($_POST['name'] != $fieldMod{'name'})
                    {
                        SQLmodField("name", $_POST['name'], $fldId);
                    }
                    header("Location: index.php?main=fields");
                }
                else if($_SESSION['main'] == "valideProfile")                   // valide the user profile modification
                {
                    $return = "";
                    if($_POST['fname'] != $_SESSION['User']{'fname'})
                    {
                        SQLmodPeople("fname", $_POST['fname'], $_SESSION['User']{'id'});
                    }
                    if($_POST['lname'] != $_SESSION['User']{'lname'})
                    {
                        SQLmodPeople("lname", $_POST['lname'], $_SESSION['User']{'id'});
                    }
                    if($_POST['mail'] != $_SESSION['User']{'mail'})
                    {
                        $people = SQLgetPeople("", "", "");
                        $change = false;
                        for($ppl = 0; $ppl < sizeof($people); $ppl++)
                        {
                            if($people{$ppl}{'mail'} == $_POST['mail'])
                            {
                                $change = true;
                            }
                        }
                        if(!$change)
                        {
                            SQLmodPeople("mail", $_POST['mail'], $_SESSION['User']{'id'});
                        }
                        else
                        {
                            $return .= $_POST['mail']." existe déja. ";
                        }
                    }
                    if($_POST['newPass'] != $_SESSION['User']{'password'})
                    {
                        SQLmodPeople("password", $_POST['newPass'], $_SESSION['User']{'id'});
                    }
                    if($_POST['birthday'] != $_SESSION['User']{'birthDate'})
                    {
                        SQLmodPeople("birthDate", $_POST['birthday'], $_SESSION['User']{'id'});
                    }
                    if($_POST['address'] != $_SESSION['User']{'address'})
                    {
                        SQLmodPeople("address", $_POST['address'], $_SESSION['User']{'id'});
                    }
                        
                        $comp = SQLgetComp("", "", "");
                        $sessionComp = "";
                        for($i=0; $i<sizeof($comp); $i++)
                        {
                            if($_SESSION['User']{'idCompany'} == $comp{$i}{'id'})
                            {
                                $sessionComp = $comp{$i}{'name'};
                            }
                        }
                    if($_POST['company'] != $sessionComp)
                    {
                        $change = SQLgetComp("", "", $_SESSION['User']{'mail'}){'id'};
                        for($c = 0; $c < sizeof($comp); $c++)
                        {
                            if($comp{$c}{'name'} == $_POST['company'])
                            {
                                $change = $comp{$c}{'id'};
                            }
                        }
                        if($change != SQLgetComp("", "", $_SESSION['User']{'mail'}){'id'})
                        {
                            SQLmodPeople("idCompany", $change, $_SESSION['User']{'id'});
                        }
                        else
                        {
                            $return .= $_POST['company']." n'existe pas. ";
                        }
                    }
                    if($_POST['phone'] != $_SESSION['User']{'phone'})
                    {
                        SQLmodPeople("phone", $_POST['phone'], $_SESSION['User']{'id'});
                    }

                    if($return != "")
                    {
                        echo $return;
                    }

                    for($p=0; $p<sizeof(SQLgetPeople("","","")); $p++)
                    {
                        if(SQLgetPeople("","",""){$p}{'id'} == $_SESSION['User']{'id'})
                        {
                            $_SESSION['User'] = SQLgetPeople("","",""){$p};
                        }
                    }
                    header("Location: index.php?main=viewProfile");
                }
                else if($_SESSION['main'] == "disconnect")                      // disconnect the profile
                {
                    session_destroy();
                    //$_SESSION['main'] = "home";
                    //getControl();
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "contact")                         // visit the contact page
                {
                    include "View/contact.php";
                }
                else if($_SESSION['main'] == 'contacted')                       // valide the contact form
                {
                    SQLaddMail($_POST['idInformation'], $_POST['coverLetter'], $_POST['dateTime'], $_POST['receiver'], $_POST['sender']);
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == 'contactPpl')                      // visite the contact admin
                {
                    include "View/adminContact.php";
                }
                else if($_SESSION['main'] == 'answering')                       // valide the contact admin
                {
                    $id = $_POST['id'];
                    if(isset($_POST['answer']) && $_POST['answer'] != null)
                    {
                        SQLmodContactAdmin("answer", $_POST['answer'], $id);
                    }

                    if(isset($_POST['idAnswer']) && $_POST['idAnswer'] != null)
                    {
                        SQLmodContactAdmin("idAdmin", $_POST['idAnswer'], $id);
                    }

                    header("Location: index.php?main=home");
                }
                else if(substr($_SESSION['main'], 0, 7) == "contact")           // contact a people or a company
                {
                    $_SESSION['Contact']{'receiver'} = explode(',', $_SESSION['main'])[1];
                    $_SESSION['Contact']{'advertisment'} = explode(',', $_SESSION['main'])[2];
                    header("Location: index.php?main=contact");
                }
                else if($_SESSION['main'] == "modLetter")                       // valide the modification of the coverletter
                {
                    SQLmodInfo("coverLetter", $_POST['letter'], $_POST['advertisment']);
                    header("Location: index.php?main=contact");
                }
                else if($_SESSION['main'] == "postOffer")                       // visite the post offer form page
                {
                    include "View/postForm.php";
                }
                else if($_SESSION['main'] == "posted")                          // valide the post offer form page
                {
                    $_SESSION['postOffer'] = $_POST;
                    if(SQLgetAds("", $_POST['name'] , "") == null)
                    {
                        if(SQLaddAdv($_POST['name'], $_POST['idCompany'], $_POST['shortDescrib'], $_POST['longDescrib'], $_POST['wadges'], $_POST['place'], $_POST['workingTime']))
                        {
                            if(isset($_POST['field1']) && $_POST['field1'] != "")
                            {
                                SQLaddAdsField(end(SQLgetAds("", "", "")), $_POST['field1']);
                            }
                            
                            if(isset($_POST['field2']) && $_POST['field2'] != "")
                            {
                                SQLaddAdsField(end(SQLgetAds("", "", "")), $_POST['field2']);
                            }
                            
                            if(isset($_POST['field3']) && $_POST['field3'] != "")
                            {
                                SQLaddAdsField(end(SQLgetAds("", "", "")), $_POST['field3']);
                            }
                            
                            if(isset($_POST['field4']) && $_POST['field4'] != "")
                            {
                                SQLaddAdsField(end(SQLgetAds("", "", "")), $_POST['field4']);
                            }
                            
                            if(isset($_POST['field5']) && $_POST['field5'] != "")
                            {
                                SQLaddAdsField(end(SQLgetAds("", "", "")), $_POST['field5']);
                            }
                        }
                    }
                    
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == 'myOffers')                        // visite the advertisments posted
                {
                    include "View/myOffers.php";
                }
                else if($_SESSION['main'] == 'myApplies')                       // visite the advertisments applied
                {
                    include "View/myApplies.php";
                }
                else                                                            // by default visite the advertisments viewer page
                {
                    include "View/adsViewer.php";
                }
            }
            else                                                            // by default visite the advertisments viewer page
            {
                include "View/adsViewer.php";
            }
        }
        else                                                            // the user is an impostor
        {
            if(isset($_SESSION['main']))                                    // session variable "main" has been filled in
            {
                if($_SESSION['main'] == "signForm")                         // visite the signin form page
                {
                    include "View/signForm.php";
                }
                else if($_SESSION['main'] == "signed")                      // valide the signing form
                {
                    $resp = "";
                    $resp = signin($_POST['fName'], $_POST['lName'], $_POST['mail'], $_POST['password'], $_POST['birthDate'], $_POST['address'], $_POST['statut'], $_POST['company'], $_POST['phone'], $_POST['resume'], $_POST['coverLetter'], $_POST['avatar']);
                    if($resp == "Le profil a bien été créé.")       //verification is correct
                    {
                        echo "Your profile has been created !";
                        include "View/adsViewer.php";
                        header("Location: index.php?main=home");
                    }
                    else                                            //verification is not correct
                    {
                        echo $resp;
                        include "View/signForm.php";
                    }
                }
                else if($_SESSION['main'] == "login")                       // visite the login page
                {
                    session_destroy();
                    session_start();
                    $_SESSION['User'] = authVerification($_POST['mail'], $_POST['password'])[0];
                    $_SESSION['main'] = "adsViewer";
                    header("Location: index.php?main=home");
                }
                else if($_SESSION['main'] == "home")                        // visiting the home page
                {
                    include "View/authentification.php";
                    include "View/adsViewer.php";
                }
                else if($_SESSION['main'] == "advertisment")                     // visite an advertisment page
                {
                    include "View/advertisment.php";
                }
                else if($_SESSION['main'] == "applyForm")                       // visite the apply form page
                {
                    include "View/applyForm.php";
                }
                else if($_SESSION['main'] == "applied")                         // valide the apply form page
                {
                    //-- register profile --//
                    $resp = "";
                    $resp = signin($_POST['fName'], $_POST['lName'], $_POST['mail'], $_POST['password'], $_POST['birthDate'], $_POST['address'], $_POST['statut'], $_POST['company'], $_POST['phone'], $_POST['resume'], $_POST['coverLetter'], $_POST['avatar']);
                    if($resp == "Le profil a bien été créé.")       //verification is correct
                    {
                        echo "Your profile has been created !";
                        session_destroy();
                        session_start();
                        $_SESSION['User'] = authVerification($_POST['mail'], $_POST['password'])[0];
                    }
                    else                                            //verification is not correct
                    {
                        echo $resp;
                        include "View/signForm.php";
                    }

                    //-- register apply --//
                    $_SESSION['apply'] = $_POST;
                    if(SQLgetInfo("", $_POST['advName'], $_POST['mail']) == null)
                    {
                        SQLaddInfo($_POST['advId'], $_SESSION["User"]{'id'});
                    }
                    
                    include "View/adsViewer.php";
                }
                else                                                        // by default visite the login page
                {
                    echo 'you must have an account to proceed';
                    include "View/authentification.php";
                }
            }
            else
            {
                include "View/authentification.php";
                include "View/adsViewer.php";
            }
        }
    }
    else                                                            // the user is not connected
    {
        if(!isset($_SESSION['User']))
        {
            session_start();
            $_SESSION['User'] = array("id" => "0", "mail" => "noMail", "fname" => "", "lname" => "", "password" => "", "birthDate" => "", "address" => "", "statut" => "3", "idCompany" => "", "phone" => "", "urlResume" => "", "urlCoverletter" => "", "urlPix" => "");
            header("Location: index.php?main=home");
        }
    }
}
?>