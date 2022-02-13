<link href="css/index/style-global.css" rel="stylesheet" type="text/css">
<link href="css/index/style-index.css" rel="stylesheet" type="text/css">
<link href="css/import.css" rel="stylesheet" type="text/css">

<body>
    <div class="body">

        <div class="body_hotprice">
            <?php if (isset($hot_product)) foreach ($hot_product as $hotProduct) : ?>
                <div class="body_hotprice_product">
                    <img src="graph/products<?= esc($hotProduct->item_photo) ?>" width="50px" height="50px"><br>
                    <p><?= esc($hotProduct->item_name) ?></p>
                    <p><?= esc($hotProduct->item_price) ?></p>
                    <button>Sprawdź produkt</button>
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
                        <img src="graph/products<?= esc($featuredProduct->item_photo) ?>" width="50px" height="50px"><br>
                        <p><?= esc($featuredProduct->item_name) ?></p>
                        <p><?= esc($featuredProduct->item_price) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</body>