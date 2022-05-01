<h3>Zarządzanie produktami:</h3>
<button onclick="location.href = '<?= esc(base_url('admin/addproduct')) ?>'">Dodaj nowy produkt</button><br><br>

<div class="productlist">
    <?php if ($productsList != null) foreach ($productsList as $product): ?>
        <div class="product<?= esc($product->item_id)?>">
            <b>ID: <?= esc($product->item_id)?> </b>(<?= esc($product->item_name) ?>)
            <form method="post" action="<?= esc(base_url('admin/productmanager'))?>">
                <input type="hidden" name="product-id" value="<?= esc($product->item_id)?>">
                <input type="submit" value="Zarządzaj produktem">
            </form>
        </div><br>
    <?php endforeach; ?>
</div>