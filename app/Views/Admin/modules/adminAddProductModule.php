<br><br>
<div class="addproductform">
    <form>
        Nazwa produktu: <input type="text" name="product_name"><br><br>
        Opis produktu <textarea id="product_description"></textarea><br><br>
        Cena produktu: <input type="number" name="product_price"><br><br>
        Kategoria produktu:
        <select name="product_category">
            <?php if ($categoryList != null) foreach ($categoryList as $category): ?>
                <option value="<?= esc($category['category_id']) ?>"><?= esc($category['category_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>
        SubKategoria produktu:
        <select name="product_subcategory">
            <?php if ($subcategoryList != null) foreach ($subcategoryList as $subcategory): ?>
                <option value="<?= esc($subcategory['subcategory_id']) ?>"><?= esc($subcategory['subcategory_name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="file" name="product_photo">
    </form>
</div>