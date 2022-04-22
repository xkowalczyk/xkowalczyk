<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/personalDataApi.js"></script>


<form method="post">
    <input type="hidden" value="<?= esc($userObject[0]->user_id) ?>" name="user_id">
    Imię: <input type="text" require name="user_name" value="<?= esc($userObject[0]->user_name) ?>"><br>
    Nazwisko: <input type="text" name="user_lastname" value="<?= esc($userObject[0]->user_lastname) ?>"><br>
    Nazwa Użytkownika: <input type="text" name="user_login" value="<?= esc($userObject[0]->user_login) ?>"><br>
    <input type="button" id="saveSettingsButton" value="Zapisz ustawienia">
</form>