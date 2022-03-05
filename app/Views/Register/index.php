<link href="css/style-global.css" rel="stylesheet" type="text/css">
<link href="css/register/style-user-register.css" rel="stylesheet" type="text/css">
<link href="css/import.css" rel="stylesheet" type="text/css">

<div class="body">
    <div class="body_text">
        <p style="font-size: 40px;">Zarejestruj się!</p>
    </div>

    <div class="body_login">
        <form action="auth/register" method="POST" class="body_login_form">
            <input type="text" name="userName" placeholder="Imię" class="body_login_form_input"><br>
            <input type="text" name="userLastname" placeholder="Nazwisko" class="body_login_form_input"><br>
            <input type="text" name="userHomenumber" placeholder="Numer Mieszkania" class="body_login_form_input"><br>
            <input type="text" name="userCity" placeholder="Miejscowość" class="body_login_form_input"><br>
            <input type="text" name="userPostcode" placeholder="Kod Pocztowy" class="body_login_form_input"><br>
            <input type="text" name="userStreet" placeholder="Ulica" class="body_login_form_input"><br>
            <input type="email" name="userEmail" placeholder="E-mail" class="body_login_form_input"><br>
            <input type="text" name="userLogin" placeholder="Login" class="body_login_form_input"><br>
            <input type="password" name="userPassword" placeholder="Hasło" class="body_login_form_input"><br>
            <input type="hidden" name="registerToken" value="7x6gh">
            <input type="submit" value="Zarejestruj!" class="body_login_form_input_submit">
        </form>
    </div>
</div>

<p class="backhome" onclick="location.href='home'">Powrót na stronę główną</p>