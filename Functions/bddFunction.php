<?php
    //reset auto increment
        function resetAuto()
        {
            $connection = connect();
            $query = "
            ALTER TABLE adsfield AUTO_INCREMENT = 1;
            ALTER TABLE advertisment AUTO_INCREMENT = 1;
            ALTER TABLE company AUTO_INCREMENT = 1;
            ALTER TABLE field AUTO_INCREMENT = 1;
            ALTER TABLE information AUTO_INCREMENT = 1;
            ALTER TABLE mail AUTO_INCREMENT = 1;
            ALTER TABLE people AUTO_INCREMENT = 1;
            ALTER TABLE phonecall AUTO_INCREMENT = 1;";
            $result = mysqli_query($connection, $query);
        }
    //connection to the database
		function connect()
		{
			$connection = mysqli_connect('127.0.0.1:3307', 'root', '','jobboard');
			//connection à la base de donnée
			if(!$connection)
			{
                die('Connexion impossible : ' . mysql_error());
			}
			else
			{
				return $connection;
			}
            mysqli_close($connection);
        }
         
    //LOGIN
        function authVerification($adr, $psw)
		{
            $options = ['cost' => 10];
            $hachPsw = password_hash($psw, PASSWORD_BCRYPT, $options);

            $connection = connect();
            $query = 'SELECT * FROM people';
            $query .= ' WHERE mail = "'.$adr.'"';
            //var_dump($query);
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            if(password_verify($psw, $row[0]['password'])) 
            {
                return $row;
            } 
            else 
            {
            }

        }

    //SINGIN : Verify and Create a new people
        function signin($fname, $lname, $mail, $psw, $birth, $address, $statut, $company, $phone, $resume, $coverLetter, $pix)
        {
            $options = ['cost' => 8];
            $hachPsw = password_hash($psw, PASSWORD_BCRYPT, $options);

                $verif ="";
            // verification du nom et prenom
                $connection = connect();
                $query = 'SELECT * FROM people WHERE';
                $query .= ' lname = "'.$lname.'"';
                $query .= ' AND fname = "'.$fname.'"';
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if($row==null)
                {
                    $verif .= "";
                }
                else
                {
                    $verif .= $fname." ".$lname." existe déja! ";
                }
            // verification du mail
                $connection = connect();
                $query = 'SELECT * FROM people WHERE';
                $query .= ' mail = "'.$mail.'"';
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if($row==null)
                {
                    $verif .= "";
                }
                else
                {
                    $verif .= $mail." existe déja!! ";
                }
            // verification du phone
                $connection = connect();
                $query = 'SELECT * FROM people WHERE';
                $query .= ' phone = "'.$phone.'"';
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if($row==null)
                {
                    $verif .= "";
                }
                else
                {
                    $verif .= $phone." existe déja!!!";
                }
            // verification de la company
                if($company != '')
                {
                    $connection = connect();
                    $query = 'SELECT * FROM company WHERE';
                    $query .= ' name = "'.$company.'"';
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    if($row==null)
                    {
                        $verif .= "";
                        $table = "Company";
                        $champ = "name";
                        $values = "'".$company."'";
                        sqlCreate($table, $champ, $values);
    
                        $company = sqlRead($table, $champ, "company.name = ".$values);
                    }
                    else
                    {
                        $verif .= $company." existe déja!!!!";
                        $company = null;
                    }
                }
            // message de confirmation ou d'erreur
                if($verif == "")
                {
                    // Add a new user in the people table
                        $connection = connect();
                        if($company == null)
                        {$query = 'INSERT INTO people (fname, lname, mail, password, birthDate, address, statut, phone, urlResume, urlCoverletter, urlPix) VALUES ("'.$fname.'", "'.$lname.'", "'.$mail.'", "'.$hachPsw.'", "'.$birth.'", "'.$address.'", "'.$statut.'", "'.$phone.'", "'.$resume.'", "'.$coverLetter.'", "'.$pix.'")';}
                        else
                        {$query = 'INSERT INTO people (fname, lname, mail, password, birthDate, address, statut, idCompany, phone, urlResume, urlCoverletter, urlPix) VALUES ("'.$fname.'", "'.$lname.'", "'.$mail.'", "'.$hachPsw.'", "'.$birth.'", "'.$address.'", "'.$statut.'", "'.$company{"id"}.'", "'.$phone.'", "'.$resume.'", "'.$coverLetter.'", "'.$pix.'")';}
                        //var_dump($query);
                        $result = mysqli_query($connection, $query);
                        $verif = "Le profil a bien été créé.";
                        session_destroy();
                        session_start();
                        $_SESSION['User'] = authVerification($_POST['mail'], $_POST['password'])[0];
                        return $verif;
                }
                else
                {
                    return $verif;
                }
        }

// ABSTRACT QUERIES
    //requetes SQL : obtenir les champs ??? dans la table renseignée
        function sqlRead($table, $champ, $condition)
        {
            $connection = connect();
            $query = "SELECT DISTINCT ".$champ." FROM ".$table;
            if($condition != "")
            {$query .= " WHERE ".$condition;}
            //var_dump($query);
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $row;
        }
        
    //requetes SQL : modifier les champs ??? dans la table renseignée
        function sqlUpdate($table, $champ, $action, $condition)
        {   
            $connection = connect();         
            $query = "UPDATE ".$table;
            $query .= " SET ".$champ." = \"".$action."\"";
            $query .= " WHERE ".$condition;
            //var_dump($query);
            $result = mysqli_query($connection, $query);
        }
    
    //requetes SQL : supprimer les champs ??? dans la table renseignée
        function sqlDelete($table, $id)
        {
            $connection = connect();         
            $query = "DELETE FROM ".$table." WHERE id = ".$id;
            //var_dump($query);
            $result = mysqli_query($connection, $query);
        }

    //requetes SQL : créer les champs ??? dans la table renseignée
        function sqlCreate($table, $champs, $values)
        {            
            $connection = connect();
            $query = "INSERT INTO ".$table." (".$champs.") VALUES (".$values.")";
            //var_dump($query);
            $result = mysqli_query($connection, $query);
        }
    
// SELECT QUERY
    // ADVERTISMENT SELECT QUERY
        function SQLgetAds($key, $company, $field)
        {
            if($key == ""){$key = "Advertisment.id, Advertisment.name, Advertisment.idCompany, Advertisment.shortDescrib, Advertisment.longDescrib, Advertisment.wages, Advertisment.place, Advertisment.workingTime";}

            $table = "Advertisment";
            $condition = "";


            if($company!="")
            {
                $table .= " INNER JOIN company ON advertisment.idCompany = company.id ";
                if(strpos($company, ",") != false)
                {
                    $companyArr = explode(",", $company);
                    $company = "";
                    for($i=0;$i<sizeof($companyArr);$i++)
                    {
                        $company .= " Company.name = '".$companyArr[$i]."'";
                        $company .= " ||";
                    }
                    $company = substr($company, 0, -3);
                    $condition .= $company;
                }
                else
                {
                    $company=" Company.name = '".$company."'";
                    $condition .= $company;
                }
            }
            else{}

            if($field!="")
            {
                $table .= " INNER JOIN adsfield ON advertisment.id = adsfield.idAdvertisment INNER JOIN field ON adsfield.idField = field.id ";
                if(strpos($field, ",") != false)
                {
                    $fieldArr = explode(",", $field);
                    $field = "";
                    for($i=0;$i<sizeof($fieldArr);$i++)
                    {
                        $field .= " field.name = '".$fieldArr[$i]."'";
                        $field .= " ||";
                    }
                    $field = substr($field, 0, -3);
                    
                    if($condition != "")
                    {$condition .= " || ";}
                    
                    $condition .= $field;
                }
                else
                {
                    if($condition != "")
                    {$field = " || field.name = '".$field."'";}
                    else{$field = "field.name = '".$field."'";}
                    $condition .= $field;
                }
            }
            else{}

            return sqlRead($table, $key, $condition);
        }
    // COMPANY SELECT QUERY
        function SQLgetComp($key, $advertisment, $people)
        {
            if($key == "")
            {
                $key = "Company.id, Company.name";
                if($people != '')
                {$key .= ", People.idCompany";}
            }

            $table = "Company";
            $condition = "";

            if($advertisment != '')
            {
                $table .= " INNER JOIN advertisment ON Company.id = advertisment.idCompany ";
                if(strpos($advertisment, ",") != false)
                {
                    $adsArr = explode(",", $advertisment);
                    $advertisment = "";
                    for($i=0;$i<sizeof($adsArr);$i++)
                    {
                        $advertisment .= " Advertisment.name = '".$adsArr[$i]."'";
                        $advertisment .= " ||";
                    }
                    $advertisment = substr($advertisment, 0, -3);
                    $condition .= $advertisment;
                }
                else
                {
                    $advertisment=" Advertisment.name = '".$advertisment."'";
                    $condition .= $advertisment;
                }
            }


            if($people != '')
            {
                $table .= " INNER JOIN people ON Company.id = people.idCompany ";
                if(strpos($people, ",") != false)
                {
                    $peopleArr = explode(",", $people);
                    $people = "";
                    for($i=0;$i<sizeof($peopleArr);$i++)
                    {
                        $people .= " people.mail = '".$peopleArr[$i]."'";
                        $people .= " ||";
                    }
                    $people = substr($people, 0, -3);
                    if($condition != "")
                    {$condition .= " || ";}

                    $condition .= $people;
                }
                else
                {
                    if($condition != "")
                    {$people = " || people.mail = '".$people."'";}
                    else{$people = "people.mail = '".$people."'";}
                    $condition .= $people;
                }
            }

            return sqlRead($table, $key, $condition);
        }
    // FIELD SELECT QUERY 
        function SQLgetField($key, $advertisment)
        {
            if($key == "")
            {
                $key = "Field.id, Field.name";
                if($advertisment != ""){$key .= ", adsField.idAdvertisment";}
            }

            $table = "Field";
            $condition = "";

            if($advertisment != "")
            {
                $table .= " INNER JOIN adsField ON field.id = adsField.idField INNER JOIN advertisment ON advertisment.id = adsField.idAdvertisment ";
                if(strpos($advertisment, ",") != false)
                {
                    $adsArr = explode(",", $advertisment);
                    $advertisment = "";
                    for($i=0;$i<sizeof($adsArr);$i++)
                    {
                        $advertisment .= " Advertisment.name = '".$adsArr[$i]."'";
                        $advertisment .= " ||";
                    }
                    $advertisment = substr($advertisment, 0, -3);
                    $condition .= $advertisment;
                }
                else
                {
                    $advertisment=" Advertisment.name = '".$advertisment."'";
                    $condition .= $advertisment;
                }
            }

            return sqlRead($table, $key, $condition);
        }
    // PEOPLE SELECT QUERY
        function SQLgetPeople($key, $company, $advertisment)
        {
            if($key == "")
            {$key = "People.id, People.fname, People.lname, People.mail, People.password, People.birthDate, People.address, People.statut, People.idCompany, People.phone, People.urlResume, People.urlCoverletter";}
                $table = "People";
                $condition = "";

            if($company != "")
            {
                $key .= ", company.id, company.name";
                $table .= " INNER JOIN company ON People.idCompany = company.id ";
                $company = " company.name = '".$company."'";
                $condition .= $company;
            }

            if($advertisment != "")
            {
                $key .= ", advertisment.id, advertisment.name";
                $table .= " INNER JOIN information ON People.id = information.idPeople INNER JOIN Advertisment ON information.idAdvertisment = advertisment.id ";
                $advertisment = " advertisment.name = '".$advertisment."'";
                $condition .= $advertisment;
            }

            return sqlRead($table, $key, $condition);
        }
    // INFORMATIONS SELECT QUERY
        function SQLgetInfo($key, $advertisment, $people)
        {
            if($key == "")
            {$key = "Information.id, Information.idAdvertisment, Information.idPeople, Information.coverLetter ";}

            $table = "Information";
            $condition = "";

            if($advertisment != "")
            {
                $key .= ", advertisment.id, advertisment.name";
                $table .= " INNER JOIN Advertisment ON information.idAdvertisment = advertisment.id ";
                $advertisment = " advertisment.name = '".$advertisment."'";
                $condition .= $advertisment;
            }

            if($people != "")
            {
                $key .= ", People.id, People.mail";
                $table .= " INNER JOIN People ON People.id = information.idPeople ";
                if($condition != ""){$condition .= " &&";}
                $people = " People.mail = '".$people."'";
                $condition .= $people;
            }

            return sqlRead($table, $key, $condition);
        }
    // MAIL SELECT QUERY
        function SQLgetMail($key, $information)
        {
            if($key == "")
            {$key = "Mail.id, Mail.content, Mail.dateTime, Mail.idInformation, Mail.receiver, Mail.sender ";}

            $table = "Mail INNER JOIN Information ON Information.id = Mail.idInformation ";
            $condition = " information.id = ".$information;
            
            return sqlRead($table, $key, $condition);
        }
    // CONTACTADMIN SELECT QUERY
        function SQLgetContactAdmin($key, $people)
        {
            if($key == "")
            {$key = "*";}

            $table = "contactadmin";
            $condition = "";
            //$table .= " INNER JOIN People ON contactadmin.idAsk = people.id AND contactadmin.idAnswer = people.id";
            if($people != null)
            {$condition = " contactadmin.idAsk = ".$people;}
            
            return sqlRead($table, $key, $condition);
        }


// INSERT QUERY
    // INFORMATIONS INSERT QUERY
        function SQLaddInfo($advertisment, $people)
        {
            $table = "Information";
            $champ = "idAdvertisment , idPeople";
            $values = "'".$advertisment."', '".$people."'";

            return sqlCreate($table, $champ, $values);
        }
    // MAIL INSERT QUERY
        function SQLaddMail($info, $content, $dateTime, $receiver, $sender)
        {
            $table = "Mail";
            $champ = "content, dateTime, idInformation, receiver, sender";
            $values = "'".$content."', '".$dateTime."', '".$info."', '".$receiver."', '".$sender."'";

            return sqlCreate($table, $champ, $values);
        }
    // ADVERTISMENT INSERT QUERY
        function SQLaddAdv($name, $idCompany, $shortDescrib, $longDescrib, $wages, $place, $workingTime)
        {
            $table = "Advertisment";
            $champ = "name, idCompany, shortDescrib, longDescrib, wages, place, workingTime";
            $values = "'".$name."', '".$idCompany."', '".$shortDescrib."', '".$longDescrib."', '".$wages."', '".$place."', '".$workingTime."'";

            return sqlCreate($table, $champ, $values);
        }
    // ADSFIELD INSERT QUERY
        function SQLaddAdsField($idAdvertisment, $idField)
        {
            $table = "adsfield";
            $champ = "idAdvertisment, idField";
            $values = "'".$idAdvertisment."', '".$idField."'";
            
            return sqlCreate($table, $champ, $values);
        }
    // COMPANY INSERT QUERY
        function SQLaddComp($name)
        {
            $table = "company";
            $champ = "name";
            $values = "'".$name."'";
            
            return sqlCreate($table, $champ, $values);
        }
    // FIELD INSERT QUERY
        function SQLaddField($name)
        {
            $table = "field";
            $champ = "name";
            $values = "'".$name."'";
            
            return sqlCreate($table, $champ, $values);
        }
    // CONTACTADMIN INSERT QUERY
        function SQLaddContactAdmin($ask, $answer, $dateTime, $idPeople, $idAdmin)
        {
            $table = "contactadmin";
            $champ = "";
            $values = "";
            if($ask != "")
            {
                $champ .= "ask, ";
                $values .= "\"".$ask."\", ";
            }
            if($answer != "")
            {
                $champ .= "answer, ";
                $values .= "\"".$answer."\", ";
            }
            if($dateTime != "")
            {
                $champ .= "date, ";
                $values .= "'".$dateTime."', ";
            }
            if($idPeople != "")
            {
                $champ .= "idPeople, ";
                $values .= "'".$idPeople."', ";
            }
            if($idAdmin != "")
            {
                $champ .= "idAdmin, ";
                $values .= "'".$idAdmin."', ";
            }
            
            $champ = substr($champ, 0, -2);
            $values = substr($values, 0, -2);
            return sqlCreate($table, $champ, $values);
        }

// UPDATE QUERY
    // PEOPLE UPDATE QUERY
        function SQLmodPeople($key, $val, $id)
        {
            $table = "people";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    // ADVERTISMENT UPDATE QUERY
        function SQLmodAds($key, $val, $id)
        {
            $table = "advertisment";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    // ADSFIELD UPDATE QUERY
        function SQLmodAdsField($key, $val, $id)
        {
            $table = "adsField";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    // INFORMATION UPDATE QUERY
        function SQLmodInfo($key, $val, $id)
        {
            $table = "information";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    // COMPANY UPDATE QUERY
        function SQLmodComp($key, $val, $id)
        {
            $table = "company";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    // FIELD UPDATE QUERY
        function SQLmodField($key, $val, $id)
        {
            $table = "field";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    // CONTACTADMIN UPDATE QUERY
        function SQLmodContactAdmin($key, $val, $id)
        {
            $table = "contactadmin";
            $champ = $key;
            $value = $val;
            $condition = "id = '".$id."'";

            return sqlUpdate($table, $champ, $value, $condition);
        }
    

// DELETE QUERY
    // ADSFIELD DELETE QUERY
        function SQLdelAdsField($id)
        {
            $table = "adsfield";
            
            return sqlDelete($table, $id);
        }
    // PEOPLE DELETE QUERY
        function SQLdelPeople($id)
        {
            $table = "people";
            
            return sqlDelete($table, $id);
        }
    // COMPANY DELETE QUERY
        function SQLdelComp($id)
        {
            $table = "company";
            
            return sqlDelete($table, $id);
        }
    // FIELD DELETE QUERY
        function SQLdelField($id)
        {
            $table = "field";
            
            return sqlDelete($table, $id);
        }
    // CONTACTADMIN DELETE QUERY
        function SQLdelContactAdmin($id)
        {
            $table = "contactadmin";
            
            return sqlDelete($table, $id);
        }


/*REQUETE COMPLETE SUR PEOPLE
        $query = 'SELECT * FROM people';
        $query .= ' INNER JOIN company ON people.idCompany = company.id';
        $query .= ' WHERE mail = "'.$mail.'"';
        $query .= ' AND password = "'.$psw.'"';
        $query .= ' AND lname = "'.$lname.'"';
        $query .= ' AND fname = "'.$fname.'"';
        $query .= ' AND birthDate = "'.$birth.'"';
        $query .= ' AND phone = "'.$phone.'"';
        $query .= ' AND urlResume = "'.$resume.'"';
        $query .= ' AND urlCoverletter = "'.$coverLetter.'"';
        $query .= ' AND urlPix = "'.$pix.'"';
        $query .= ' AND idCompany  = "'.$company.'"';
    */
?>

