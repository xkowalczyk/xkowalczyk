<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/bin/style-bin.css" rel="stylesheet" type="text/css">
<script src="<?= esc(base_url()) ?>/apis/productApi.js"></script>

<body>
    <div class="body_productlist">
        <?php if($productList != null){ ?>
        <form action="<?= esc(base_url('neworder'))?>" method="post">
            <input type="hidden" name="order-token" value="order">
            <?php foreach($productList as $item): ?>
                <div class="body_productlist_item">
                    <img src="<?=esc(base_url())?>/graph/products/<?=esc($item[0]->item_photo)?>" class="body_productlist_item_photo">
                    <p><?= esc($item[0]->item_name)?></p>
                    <button onclick="dellBinItem(<?= esc($item[0]->item_id) ?>)" class="body_productlist_item_dellItemButton">Usuń z koszyka</button>
                    Ilość: <input type="number" name="<?= esc($item[0]->item_id)?>" value="1">
                </div>
            <?php endforeach; ?>
            <br><br>
            <input type="submit" value="Złóż zamówienie">
        </form>
        <?php } else {?>
            <h2>Koszyk jest pusty</h2>
        <?php } ?>
    </div>
</body>