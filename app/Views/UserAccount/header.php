<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/account/style-account-index.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/userApi.js"></script>
<div class="header">
    <div class="header_title">
        <h2>Strona użytkownika</h2>
    </div>
    <div class="header_navigation">
        <button class="header_navigation_button" onclick="location.href = '<?= esc(base_url()) ?>/account/orders'">Zamówienia</button>
        <button class="header_navigation_button" onclick="location.href = '<?= esc(base_url()) ?>/account/address'">Adresy</button>
        <button class="header_navigation_button" onclick="location.href = '<?= esc(base_url()) ?>/account/personal'">Dane konta</button>
        <button class="header_navigation_button" onclick="logout()">Wyloguj</button>
    </div>
</div>