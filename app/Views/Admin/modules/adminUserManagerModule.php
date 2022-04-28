<script src="<?= esc(base_url()) ?>/apis/adminApi/userManagerModuleApi.js"></script>


<h3>Zarządzanie użytkownikiem (id: <?= esc($user->user_id) ?>)</h3>

<button onclick="addToBlackList('<?= esc($user->user_email) ?>')">Dodaj do użytkownika BLACKLISTY</button><br><br>
<button onclick="removeUserBlackList('<?= esc($user->user_email) ?>')">Usuń użytkownika z BLACKLISTY</button><br><br>

<div class="edituser_form">
    <form method="post">
        <input type="hidden" value="<?= esc($user->user_id) ?>" name="user_id">
        Imię: <input type="text" require name="user_name" value="<?= esc($user->user_name) ?>"><br>
        Nazwisko: <input type="text" name="user_lastname" value="<?= esc($user->user_lastname) ?>"><br>
        Nazwa Użytkownika: <input type="text" name="user_login" value="<?= esc($user->user_login) ?>"><br>
        Adres email: <input type="text" name="user_email" value="<?= esc($user->user_email) ?>"><br>
        <input type="button" id="saveUserPersonalSettingsButton" value="Zapisz ustawienia">
    </form>
</div><br>
<h3>Zarządzanie adresami użytkownika:</h3><br>
<?php if ($userAddress != null) foreach ($userAddress as $address): ?>
    <div class="editaddress_form">
        <form>
            <b>Zarządzanie adresem id: <?= esc($address->address_id) ?></b><br>
            <input type="hidden" name="address_id" value="<?= esc($address->address_id) ?>">
            Miejscowość: <input type="text" name="address_city" value="<?= esc($address->address_city) ?>"><br>
            Ulica: <input type="text" name="address_street" value="<?= esc($address->address_street) ?>"><br>
            Numer mieszkania: <input type="text" name="address_homenumber" value="<?= esc($address->address_homenumber) ?>"><br>
            Kod pocztowy: <input type="number" name="address_postcode" value="<?= esc($address->address_postcode) ?>"><br>
            <input type="button" id="saveUserAddressSettingsButton" value="Zapisz adres">
            <input type="button" value="Usuń adres" onclick="removeAddress(<?= esc($address->address_id) ?>)">
        </form>
    </div><br>
<?php endforeach; ?>