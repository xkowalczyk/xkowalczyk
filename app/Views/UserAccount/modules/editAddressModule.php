<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/addressModuleApi.js"></script>

<div class="editaddress_form">
    <form>
        <input type="hidden" name="address_id" value="<?= esc($userAddress->address_id) ?>">
        Miejscowość: <input type="text" name="address_city" value="<?= esc($userAddress->address_city) ?>"><br>
        Ulica: <input type="text" name="address_street" value="<?= esc($userAddress->address_street) ?>"><br>
        Numer mieszkania: <input type="text" name="address_homenumber" value="<?= esc($userAddress->address_homenumber) ?>"><br>
        Kod pocztowy: <input type="number" name="address_postcode" value="<?= esc($userAddress->address_postcode) ?>"><br>
        <input type="button" id="saveSettingsButton" value="Zapisz adres">
    </form>
</div>