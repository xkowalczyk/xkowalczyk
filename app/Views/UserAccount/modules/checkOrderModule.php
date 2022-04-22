

<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/account/modules/style-account-ordersmodule.css" rel="stylesheet" type="text/css">

<div class="order">
    <h3>Podsumowanie zamówienia nr: <?= esc($order->order_id) ?></h3><br><br>
    <b>Data zamówienia:</b> <?= esc($order->order_date) ?><br>
    <b>Sposób dostawy:</b> <?php if($supplier != null) esc($supplier->supplier_name)?><br>
    <b>Status zamówienia:</b> <?= esc($orderStatus) ?>
</div>

