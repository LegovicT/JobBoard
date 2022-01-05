<?php
echo '
<form id="postForm" action="index.php?main=posted" method="post">
    <h1>My new advertisment</h1>
    <label for="name">Name : </label><input type="text" name="name" placeholder="Post name" required>
    <label for="nameCompany">Company Name : </label><input type="text" name="nameCompany" placeholder="My company name" value="'.SQLgetComp("", "", $_SESSION['User']{'mail'}){0}{'name'}.'" required>
    <input type="text" name="idCompany" value="'.$_SESSION['User']{'idCompany'}.'" hidden>
    <label for="shortDescrib">Short desription : </label><input type="text" name="shortDescrib" placeholder="A short description" required>
    <label for="longDescrib">Long desription : </label><input type="text" name="longDescrib" placeholder="A longer description" required>
    <label for="wages">Wages (monthly, in euros) : </label><input type="number" name="wages" placeholder="1200">
    <label for="place">Place : </label><input type="text" name="place" placeholder="N°? name street, postcode City">
    <label for="workingTime">Working-time (hours per day) : </label><input type="number" name="workingTime" placeholder="8" required>

    <div class="fieldsSelected">Fields Selected : '.$_SESSION["field"].'</div>
    
    <div id="fields">
        <select onchange="changed(this)" class="field" name="field1" id="field1">
        <option value="">None</option>';
    //---- display fields selected ----//
            for($field = 0; $field < sizeof(SQLgetField("field.name", "")); $field++)
            {
                echo '
                <option value="'.SQLgetField("field.name", "")[$field]{"name"}.'">'.SQLgetField("field.name", "")[$field]{"name"}.'</option>';
            }
        echo '   
        </select>
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
<button class="return">Return</button>';

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