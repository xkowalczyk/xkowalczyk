<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/admin/style-admin-index.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/userApi.js"></script>

<h2>Strona administracyjna</h2>

<div class="adminheader">
    <button onclick="location.href = '<?= esc(base_url()) ?>/admin/orders'">Zarządzaj zamówieniami</button>
    <button onclick="location.href = '<?= esc(base_url()) ?>/admin/products'">Zarządzaj produktami</button>
    <button onclick="location.href = '<?= esc(base_url()) ?>/admin/users'">Zarządzaj użytkownikami</button>
</div>