<script src="<?= esc(base_url()) ?>/apis/adminApi/productManagerModuleApi.js"></script>

<div class="productInfo">
    Nazwa produktu: <input type="text" name="product_name"><br><br>
    Opis produktu:<br> <textarea id="product_description" style="width: 400px; height: 100px"></textarea><br><br>
    Cena produktu: <input type="number" name="product_price"><br><br>
    Kategoria produktu:
    <select id="product_category">
        <?php if ($categoryList != null) foreach ($categoryList as $category): ?>
            <option value="<?= esc($category['category_id']) ?>"><?= esc($category['category_name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    SubKategoria produktu:
    <select id="product_subcategory">
        <?php if ($subcategoryList != null) foreach ($subcategoryList as $subcategory): ?>
            <option value="<?= esc($subcategory['subcategory_id']) ?>"><?= esc($subcategory['subcategory_name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Zdjęcie produktu: <form enctype="multipart/form-data"><input type="file" id="product_photo"><br><br><br>
        <input type="button" value="Zapisz ustawienia" onclick="putNewProduct()">
</div>

