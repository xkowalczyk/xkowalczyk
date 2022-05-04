<script src="<?= esc(base_url()) ?>/apis/adminApi/configManagerModuleApi.js"></script>

<br><br>

<b>Regulamin:</b><br><br>
<textarea id="statute" style="width: 400px; height: 400px;"><?= esc($statute) ?></textarea><br>
<button onclick="saveStatute()">Zapisz regulamin</button><br><br><br>

<b>Kategorie: </b><br>

<div class="category">
    <?php if ($category != null) foreach ($category as $item): ?>
        <div class="category_item" style="border-bottom: 1px solid black">

            Kategoria: <input type="text" name="category_name" value="<?= esc($item['category_name']) ?>">
            <button onclick="removeCategory(<?= $item['category_id'] ?>)">Usuń kategorię</button>
            <br><br>
        </div>
    <?php endforeach; ?>
</div>

<br><br>

<b>Subkategorie:</b>
<div class="subcategory">
    <?php if ($subcategory != null) foreach ($subcategory as $item): ?>
        <div class="subcategory_item" style="border-bottom: 1px solid black">
            Subkategoria: <input type="text" name="subcategory_name" value="<?= esc($item['subcategory_name']) ?>">
            <button onclick="removeSubCategory(<?= $item['subcategory_id'] ?>)">Usuń subkategorię</button>
            <br><br>
        </div>
    <?php endforeach; ?>
</div>

<br><br>

<b>Dodaj kategorie (powyżej 8 może powodować błędy)</b><br><br>
Nazwa kategori: <input type="text" name="addcategory_name"><br>
Opis kategorii: <input type="text" name="addcategory_description"><br>
<button onclick="addCategory()">Dodaj kategorię</button>

<br><br>

<b>Dodaj subkategorię</b><br><br>
Nazwa subkategori: <input type="text" name="addsubcategory_name"><br>
Opis subkategorii: <input type="text" name="addsubcategory_description"><br>
Kategoria główna:
<select id="maincategory">
    <?php if ($category != null) foreach ($category as $item): ?>
        <option value="<?= esc($item['category_id']) ?>"><?= esc($item['category_name']) ?></option>
    <?php endforeach; ?>
</select><br><br>
<button onclick="addSubCategory()">Dodaj subkategorię</button>

<br><br><br> -