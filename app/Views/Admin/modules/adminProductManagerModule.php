<script src="<?= esc(base_url()) ?>/apis/adminApi/productManagerModuleApi.js"></script>

<h3>Zarządzanie pruduktem ID: <?= esc($product->item_id) ?></h3>

<div class="productInfo">
        Nazwa produktu: <input type="text" name="product_name" value="<?= esc($product->item_name) ?>"><br><br>
        Opis produktu:<br> <textarea id="product_description" style="width: 400px; height: 100px"><?= esc($product->item_description) ?></textarea><br><br>
        Cena produktu: <input type="number" name="product_price" value="<?= esc($product->item_price) ?>"><br><br>
        Kategoria produktu:
        <select id="product_category">
            <?php if ($categoryList != null) foreach ($categoryList as $category): ?>
                <option <?php if ($product->item_category_id == $category['category_id']) esc('selected="selected"') ?> value="<?= esc($category['category_id']) ?>"><?= esc($category['category_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>
        SubKategoria produktu:
        <select id="product_subcategory">
            <?php if ($subcategoryList != null) foreach ($subcategoryList as $subcategory): ?>
                <option value="<?= esc($subcategory['subcategory_id']) ?>"><?= esc($subcategory['subcategory_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>
        Zdjęcie:<br>
        <img src="<?= esc(base_url("graph/products/".$product->item_photo)) ?>" width="200px" height="200px"><br><br>
        Zmień zdjęcie: <form enctype="multipart/form-data"><input type="file" id="product_photo"><br><br><br>
        <input type="button" value="Zapisz ustawienia" onclick="saveProductParameters(<?= esc($product->item_id) ?>)">
</div>