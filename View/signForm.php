<form id="signForm" action="index.php?main=signed" method="post">
    <label for="fName">First name : </label><input type="text" name="fName" placeholder="my first name" required>
    <label for="lName">Last name : </label><input type="text" name="lName" placeholder="my last name" required>
    <label for="address">Address : </label><input type="text" name="address" placeholder="n°? name street, postcode City">
    <label for="birthDate">Birthday : </label><input type="date" name="birthDate" placeholder="DD/MM/YYYY">
    <label for="mail">E-mail : </label><input type="email" name="mail" placeholder="address@domain.ext" required>
    <label for="phone">Phone : </label><input type="phone" name="phone" placeholder="0123456789">
    <label for="password">Password : </label><input type="password" name="password" placeholder="my password" required>
    <label for="password">Confirm password : </label><input type="password" name="passwordConfirm" placeholder="confirm my password" required>
    <label for="statut-select">I'm here to : </label>
    <select onchange="statutChanged(this.value)" name="statut" class="statut">
        <option value="0">find an offer</option>
        <option value="1">post an offer</option>
    </select>
    <div id="company">
        <label for="company" type="hidden"></label><input type="hidden" name="company" placeholder="My company" value="">
    </div>

    <article>
        <label for="file">Upload your resume</label>
        <input type="file" id="resume" name="resume" accept=".pdf">
    </article>
    <article>
        <label for="file">Upload your cover letter</label>
        <input type="file" id="coverLetter" name="coverLetter" accept=".pdf">
    </article>
    <article>
        <label for="file">Upload you profile picture</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">
    </article>

    <button class="return">Return</button>
    <input class="submit" type="submit" value="Submit" name="submit">
</form>

<script>
    function statutChanged(elem)
    {
        if(elem == "1")
        {
            document.getElementById('company').innerHTML = '<label for="company">Company : </label><input type="text" name="company" placeholder="My company">';
        }
        else if(elem == "0")
        {
            document.getElementById('company').innerHTML = '<label for="company" type="hidden"></label><input type="hidden" name="company" placeholder="My company" value="">';
        }

    }
</script>