

<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/account/modules/style-account-ordersmodule.css" rel="stylesheet" type="text/css">

<div class="orderconfirm_list" style="margin-top: 30px;">
    <h3>Podsumowanie zamówienia nr: <?= esc($order->order_id) ?></h3><br>
    <table class="orderconfirm_list_table">
        <tr>
            <td><b>Nazwa produktu<b></td>
            <td><b>Cena<b></td>
        </tr>
        <?php $index = 0; if($orderProduct != null) foreach($orderProduct as $item): ?>
            <tr>
                <td><?= esc($item->item_name) ?></td>
                <td><?= esc($item->item_price)?>zł</td>
            </tr>
            <?php $index++; endforeach; ?>
    </table>
    <br>
    <p><b>Pełna cena:</b> <span style="color: red;"><?= esc($orderAmount)+(int)$supplier->supplier_delivery_price ?>zł (cena wraz z dostawą)</span></p>
</div>

<div class="order">
    <b>Data zamówienia:</b> <?= esc($order->order_date) ?><br>
    <b>Sposób dostawy:</b> <?= esc($supplier->supplier_name)?><br>
    <b>Status zamówienia:</b> <?= esc($orderStatus) ?>
</div>
