<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= esc(base_url()) ?>/apis/ProductApi.js"></script>
<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/product/style-product.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">

<body>
    <div class="body_product">
        <div class="body_product_image">
            <img src="<?= base_url("graph/products/".$product[0]->item_photo)?>" width="300px" height="300px">
        </div>
        <div class="body_product_information">
            <h2><?= esc($product[0]->item_name) ?></h2><br>
            <p><?= esc($product[0]->item_description) ?></p>
            <button onclick="addToBin(<?= esc($product[0]->item_id) ?>)">Dodaj do koszyka</button>
        </div>
    </div>
</body>