<link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/index/style-index.css" rel="stylesheet" type="text/css">
<link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">

<body>
    <div class="body">

        <div class="body_hotprice">
            <?php if (isset($hot_product)) foreach ($hot_product as $hotProduct) : ?>
                <div class="body_hotprice_product">
                    <img src="<?= esc(base_url()) ?>/graph/products/<?= esc($hotProduct->item_photo) ?>" width="50px" height="50px"><br>
                    <p><?= esc($hotProduct->item_name) ?></p>
                    <p><?= esc($hotProduct->item_price) ?></p>
                    <button class="body_hotprice_checkbutton"  onclick="location.href='<?= esc(base_url()) ?>/product/<?= esc($hotProduct->item_id) ?>'">Sprawdź produkt</button>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="body_recommended">
            <div class="body_recommended_header">
                <h3>Polecane Produkty</h3>
            </div>
            <div class="body_recommended_products">
                <?php if (isset($featured_product)) foreach ($featured_product as $featuredProduct) : ?>
                    <div class="body_recommended_products_item">
                        <img src="<?= esc(base_url()) ?>/graph/products/<?= esc($featuredProduct->item_photo) ?>" width="50px" height="50px"><br>
                        <p><?= esc($featuredProduct->item_name) ?></p>
                        <p><?= esc($featuredProduct->item_price) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</body>