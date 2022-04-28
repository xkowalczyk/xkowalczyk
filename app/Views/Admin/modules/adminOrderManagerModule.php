<script src="<?= esc(base_url()) ?>/apis/adminApi/orderManagerModuleApi.js"></script>

<div class="orderconfirm_list" style="margin-top: 30px;">
    <h3>Zamówienie nr: <?= esc($order->order_id) ?></h3><br>
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
    <b>Status zamówienia:</b> <?= esc($orderStatus) ?><br>

    <h3>Adres dostawy:</h3><br>
    <b>Miejscowość: </b> <?= esc($shippingAddress->address_city) ?><br>
    <b>Kod pocztowy:</b> <?= esc($shippingAddress->address_postcode) ?><br>
    <b>Ulica:</b> <?= esc($shippingAddress->address_street) ?><br>
    <b>Numer mieszkania:</b> <?= esc($shippingAddress->address_homenumber) ?><br><br>
    <b>Zmień status zamówienia:</b>

    <select onchange="changeStatus(<?= esc($order->order_id) ?>, 1)" id="status-id">
        <option value="0">Wybierz status</option>
        <option value="1">Zamówienie złożone: oczekiwanie na płatność</option>
        <option value="2">Zamówienie złożone: Płatność zaksięgowana</option>
        <option value="3">Zamówienie złożone: Płatność anulowana</option>
        <option value="4">Zamówienie złożone: Płatność w toku</option>
        <option value="5">Zamówienie złożone: Wysłane</option>
        <option value="6">Zamówienie zostało anulowane</option>
    </select>
</div>
