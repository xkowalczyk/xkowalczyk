<link href="css/style-global.css" rel="stylesheet" type="text/css">
<link href="css/register/style-user-register.css" rel="stylesheet" type="text/css">
<link href="css/import.css" rel="stylesheet" type="text/css">

<div class="body">
    <div class="body_text">
        <p style="font-size: 40px;">Zaloguj się!</p>
    </div>

    <div class="body_login">
        <form action="auth/register" method="post" class="body_login_form">
            <input type="text" name="user-name" placeholder="Imię" class="body_login_form_input"><br>
            <input type="text" name="user-lastname" placeholder="Nazwisko" class="body_login_form_input"><br>
            <input type="text" name="user-address" placeholder="Adres (Słoneczna 15/A)" class="body_login_form_input"><br>
            <input type="text" name="user-city" placeholder="Miejscowość" class="body_login_form_input"><br>
            <input type="text" name="user-citycode" placeholder="Kod Pocztowy" class="body_login_form_input"><br>
            <input type="email" name="user-email" placeholder="E-mail" class="body_login_form_input"><br>
            <input type="text" name="user-login" placeholder="Login" class="body_login_form_input"><br>
            <input type="password" name="user-password" placeholder="Hasło" class="body_login_form_input"><br>
            <input type="submit" value="Zarejestruj!" class="body_login_form_input_submit">
        </form>
    </div>
</div>

<p class="backhome" onclick="location.href='home'">Powrót na stronę główną</p>