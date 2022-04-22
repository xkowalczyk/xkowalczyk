<link href="<?= esc(base_url()) ?>/css/account/modules/style-account-addressmodule.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/addressModuleApi.js"></script>

<div class="address">
    <?php if($userAddress != null) foreach($userAddress as $address): ?>
        <div class="address_item">
            <p>Miejscowość: <?= esc($address->address_city) ?></p><br>
            <p>Ulica: <?= esc($address->address_street) ?></p><br>
            <p>Numer mieszkania: <?= esc($address->address_homenumber) ?></p><br>
            <p>Kod pocztowy: <?= esc($address->address_postcode) ?></p><br>
            <form action="<?= esc(base_url()) ?>/account/address/edit" method="post">
                <input type="hidden" name="address_id" value="<?= esc($address->address_id) ?>">
                <input type="submit" value="Edytuj adres">
            </form>
            <button onclick="removeAddress(<?= esc($address->address_id) ?>)">Usuń adres</button>
        </div>
    <?php endforeach; ?>
    <br>
    <button onclick="location.href = '<?= esc(base_url('account/address/add')) ?>'">Dodaj nowy adres</button>
</div>