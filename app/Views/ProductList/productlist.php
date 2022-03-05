<div class="body_productlist">
    <?php foreach($productList as $product) : ?>
        <div class="body_productlist_product" onclick='location.href ="product/checkproduct/<?= esc($product->item_id) ?>"'> 
            <h4><?= esc($product->item_name) ?></h4>
            <?= img("graph/products/{$product->item_photo}", false, ['height' => '100', 'width' => '100']); ?>
        </div>
    <?php endforeach; ?>
</div>