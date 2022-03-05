<link href="css/style-global.css" rel="stylesheet" type="text/css">
<link href="css/login/style-user-login.css" rel="stylesheet" type="text/css">
<link href="css/import.css" rel="stylesheet" type="text/css">

<body>
    <div class="body">
        <div class="body_text">
            <p style="font-size: 40px;">Zaloguj się!</p>
        </div>

        <div class="body_login">
            <form action="auth/login" method="POST" class="body_login_form">
                <input type="email" name="userEmail" placeholder="Podaj adres e-mail" class="body_login_form_input" required><br>
                <input type="password" name="userPassword" placeholder="Podaj hasło" class="body_login_form_input" required><br><br>
                <input type="hidden" name="loginToken" value="7x6gh">
                <input type="submit" value="Zaloguj!" class="body_login_form_input_submit">
            </form>

            <button class="body_login_register" onclick='location.href="register"'>Zarejstruj się</button>
        </div>
    </div>

    <p class="backhome" onclick="location.href='home'">Powrót na stronę główną</p>
</body>