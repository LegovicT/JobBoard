<?php
    echo '
    <section class="fieldsViewer">';
    $fields = SQLgetField("", "");

    for($fld=0; $fld<sizeof($fields); $fld++)
    {
        echo '
            <article id="field'.$fields{$fld}{'id'}.'" class="fieldsView">
                <form class="fieldsForm" action="index.php?main=valideFields" method="Post">
                <input name="id" type="number" value="'.$fields{$fld}{'id'}.'" hidden>
                    <h4>Name : <input class="nptField'.$fields{$fld}{'id'}.'" name="name" type="text" value="'.$fields{$fld}{'name'}.'" readonly> </h4> 
                    <input id="modFieldSubmit" class="nptField'.$fields{$fld}{'id'}.'"  type="submit" value="Submit" hidden>
                </form>
                <button id="fld'.$fields{$fld}{'id'}.'" class="modFields">Modify</button>
                <button id="fld'.$fields{$fld}{'id'}.'" class="delFields">Delete</button>
            </article>';
    }

    echo '
    <button class="addFields">Create</button>
</section>';
?>