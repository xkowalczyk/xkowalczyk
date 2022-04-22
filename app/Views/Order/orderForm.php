<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/order/style-order-form.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/productApi.js"></script>
<script src="<?= esc(base_url()) ?>/apis/userApi/addressModuleApi.js"></script>


<h2 style="text-align: center;">Nowe zamówienie</h2>

<div class="orderformd">
    <form action="<?= esc(base_url('neworder/confirmation'))?>" method="post" class="orderform">
        <input type="hidden" name="user_id" value="<?= esc($userId) ?>">
        <input type="hidden" name="order_token" value="order-token">
        <?php $index = 0; foreach($orderProduct as $item): ?>
            <div class="body_productlist_item">
                <img src="<?=esc(base_url())?>/graph/products/<?=esc($item[0]->item_photo)?>" class="body_productlist_item_photo">
                <p><?= esc($item[0]->item_name)?></p>
                Ilość: <input type="number" name="<?= esc($item[0]->item_id)?>" value="<?= esc($productCount[$index][$item[0]->item_id])?>">
                <input type="button" value="Usuń produkt" onclick="dellBinItem(<?= esc($item[0]->item_id) ?>)" require>
            </div>
        <?php $index++; endforeach; ?><br>

        <h3>Adres dostawy:</h3> <br>
        <div class="autoAddressForm">
            <p>Wybierz adres z listy adresów</p>
            <select name="address-option">
                <?php if($userAddress != null){ foreach($userAddress as $address): ?>
                    <option value="<?= esc($address->address_id) ?>"><?= esc($address->address_city." | ".$address->address_street)?></option>
                    
                <?php endforeach; } if($userAddress == null){ ?>
                    <p>Brak dodanego adresu, uzupełnij dane:</p>
                <?php } ?>
            </select>
        </div>    
        <br><br>
        <span>Wpisz adres dostawy manualnie</span>: <input type="checkbox"  name="addressType" class="addressType" onclick="changeAddressType()">
        <div class="manualAddressForm" hidden>
            <br>
            Miejscowość: <input type="text" name="address_city" require><br>
            Kod pocztowy: <input type="number" name="address_postcode" require><br>
            Ulica: <input type="text" name="address_street" require><br>
            Numer mieszkania: <input type="text" name="address_homenumber" require><br><br>
            <input type="button" id="addAddressButton" value="Przypisz adres do konta">
        </div>
        <br><br>
        <div class="deliveryType">
            <p>Wybierz sposób dostawy</p> 
            <select name="suppliersType">
                <?php if($suppliersList != null) foreach($suppliersList as $suppliers): ?>
                    <option value="<?= esc($suppliers->supplier_id) ?>"><?= esc($suppliers->supplier_name." | ".$suppliers->supplier_delivery_price."zł")?></option>
                <?php endforeach; ?>
            </select><br>
        </div>
        <br><br><br>
        Akceptuję <a href="<?= base_url('statute')?>" target="_blank">regulamin</a> serwisu <input type="checkbox" class="statuteAcceptStatus"><br><br>
        <input type="button" value="Złóż zamówienie" class="confirmOrderButton" onclick="sendNewOrderForm()">
        <input type="submit">
    </form>

</div>
<script src="<?= esc(base_url('/js/orderform-helper.js')) ?>"></script>