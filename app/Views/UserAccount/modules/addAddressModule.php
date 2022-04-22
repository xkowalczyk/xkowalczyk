<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/addressModuleApi.js"></script>

<div class="addaddress">
    <h3>Formularz nowego adresu dostawy</h3>
    <form>
        <input type="hidden" name="user_id" value="<?= esc($userId) ?>">
        Miejscowość: <input type="text" name="address_city"><br>
        Ulica: <input type="text" name="address_street"><br>
        Numer mieszkania: <input type="text" name="address_homenumber"><br>
        Kod pocztowy: <input type="number" name="address_postcode"><br>
        <input type="button" id="addAddressButton" value="Zapisz adres">
    </form>
</div>