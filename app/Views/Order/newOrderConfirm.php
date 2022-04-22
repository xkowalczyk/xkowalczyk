<?php echo $fullPrice; ?>
<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/order/style-order-confirm.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">



<div class="orderconfirm">
    <h2 style="text-align: center;">Dziękujemy za złożenie zamówienia <span style="color: red;"><?= esc($user->user_name) ?></span></h2>

    <div class="orderconfirm_list">
        <table class="orderconfirm_list_table" style="margin-left: auto; margin-right: auto;">
            <tr>
                <td><b>Nazwa produktu<b></td>
                <td><b>Ilość<b></td>
                <td><b>Cena<b></td>
            </tr>
            <?php $index = 0; foreach($orderProduct as $item): ?>
                <tr>
                    <td><?= esc($item[0]->item_name) ?></td>
                    <td><?= esc($productCount[$index][$item[0]->item_id])?></td>
                    <td><?= esc( (int)$productCount[$index][$item[0]->item_id]*(int)$item[0]->item_price)?>zł</td>
                </tr>
            <?php $index++; endforeach; ?>
        </table>
        <br>
        <p style="text-align: center;"><b>Pełna cena:</b> <span style="color: red;"><?= esc($fullPrice)+(int)$supplier->supplier_delivery_price ?>zł (cena wraz z dostawą)</span></p>
        <br><br>    
    </div>
    <div class="orderconfirm_address">
        <h4 style="text-align: center;">Adres dostawy:</h4>
        <p><b>Miejscowość: </b><?= esc($userAddress->address_city) ?></p>
        <p><b>Kod Pocztowy:: </b><?= esc($userAddress->address_postcode) ?></p>
        <p><b>Ulica: </b><?= esc($userAddress->address_street) ?></p>
        <p><b>Numer Mieszkania: </b><?= esc($userAddress->address_homenumber) ?></p>
        <br><br>
        <p><b>Rodzaj dostawy: </b><?= esc($supplier->supplier_name) ?></p>
    </div>
    <div class="orderconfirm_statusinfo">
        <p><b>Status zamówienia:</b> Złożone, oczekiwanie na płatność</p>
    </div>
</div>