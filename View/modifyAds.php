<?php
$myAd = array();
$advert = SQLgetAds("", "", "");
for($add = 0; $add < sizeof($advert); $add++)
{
    if($_SESSION['adModified'] == $advert{$add}{'id'})
    {
        $myAd = $advert{$add};
    }
}
$myFields = SQLgetField("", $myAd{'name'});

echo '
<form id="modAds" action="index.php?main=valideAdsModified" method="post">
    <h1>Modify my advertisment</h1>
    <input type="number" name="id" value="'.$myAd{'id'}.'" hidden>
    <label for="name">Name : </label><input type="text" name="name" value="'.$myAd{'name'}.'" required>
    <label for="nameCompany">Company Name : </label><input type="text" name="nameCompany" placeholder="My company name" value="'.SQLgetComp("", "", $_SESSION['User']{'mail'}){0}{'name'}.'" required>
    <input type="text" name="idCompany" value="'.$_SESSION['User']{'idCompany'}.'" hidden>
    <label for="shortDescrib">Short desription : </label><input type="text" name="shortDescrib" value="'.$myAd{'shortDescrib'}.'" required>
    <label for="longDescrib">Long desription : </label><input type="text" name="longDescrib" value="'.$myAd{'longDescrib'}.'" required>
    <label for="wages">Wages (monthly, in euros) : </label><input type="number" name="wages"  value="'.$myAd{'wages'}.'">
    <label for="place">Place : </label><input type="text" name="place"  value="'.$myAd{'place'}.'">
    <label for="workingTime">Working-time (hours per day) : </label><input type="number" name="workingTime"  value="'.$myAd{'workingTime'}.'" required>

    <div class="fieldsSelected">Fields Selected : '.$_SESSION["field"].'</div>
    <div id="fields">';

    for($i=1; $i<6; $i++)
    {
        if(isset($myFields{$i-1}))
        {
            echo'
            <select onchange="changed(this)" class="field" name="field'.$i.'" id="field'.$i.'">
                <option value="'.$myFields{$i-1}{'name'}.'">'.$myFields{$i-1}{'name'}.'</option>
                <option value="">None</option>';
        //---- display fields selected ----//
                for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
                {
                    echo '
                    <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
                }
        }
        else
        {
            if($i>1 && isset($myFields{$i-2}))
            {
                echo'
                <select onchange="changed(this)" class="field" name="field'.$i.'" id="field'.$i.'">
                <option value="">None</option>';
            //---- display fields selected ----//
                    for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
                    {
                        echo '
                        <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
                    }
            }
            else
            {
                echo'
                <select onchange="changed(this)" class="field" name="field'.$i.'" id="field'.$i.'" hidden>
                <option value="">None</option>';
            //---- display fields selected ----//
                    for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
                    {
                        echo '
                        <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
                    }
            }
        }
            echo '   
            </select>';
    }
    echo '
        </div>
        <input class="submit" type="submit" value="Submit" name="submit">
    </form>
    <button class="return">Return</button>';

/*
    echo'
        <select onchange="changed(this)" class="field" name="field2" id="field2" hidden>
        <option value="">None</option>';
    //---- display fields selected ----//
            for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
            {
                echo '
                <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
            }
        echo '   
        </select>
        <select onchange="changed(this)" class="field" name="field3" id="field3" hidden>
        <option value="">None</option>';
    //---- display fields selected ----//
            for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
            {
                echo '
                <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
            }
        echo '   
        </select>
        <select onchange="changed(this)" class="field" name="field4" id="field4" hidden>
        <option value="">None</option>';
    //---- display fields selected ----//
            for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
            {
                echo '
                <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
            }
        echo '   
        </select>
        <select onchange="changed(this)" class="field" name="field5" id="field5" hidden>
        <option value="">None</option>';
    //---- display fields selected ----//
            for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
            {
                echo '
                <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
            }
        echo '   
        </select>
    </div>

    <input class="submit" type="submit" value="Submit" name="submit">
</form>
<button class="return">Return</button>';*/

?>

<script>
    function changed(elem)
    {
        //alert(elem.value);
        var field = elem.id;
        numField = field.substr(5);
        numField++;
        var name = "field"+numField;
        document.getElementById(name).hidden = false;
    }
</script>