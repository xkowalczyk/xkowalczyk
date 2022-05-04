<?php

use App\Libraries\Services\CategoryService;

$request = \Config\Services::request();

$categoryService = new CategoryService();
$category = $categoryService->getCategory();
?>
<link rel="stylesheet" href="<?php esc(base_url())?>/css/productlist/style-category-list.css">

<div class="categorylist">
    <?php foreach ($category as $categoryItem) : ?>
        <?php $hrefString = base_url()."/ProductList/filter/c-".$categoryItem['category_id'] ?>
        <div class="categorylist_category">
            <a href="<?= esc($hrefString) ?>" class="categorylist_category_title"><?= esc($categoryItem['category_name']) ?></a>
            <?php $subCategory = $categoryService->getSubCategory($categoryItem['category_id']);
            foreach ($subCategory as $subCategoryItem) : ?>
                <?php $hrefString = base_url()."/ProductList/filter/s-".$subCategoryItem['subcategory_id'] ?>
                <br>&nbsp; &nbsp;<a href="<?= esc($hrefString) ?>"><?= esc($subCategoryItem['subcategory_name']) ?></a>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    <div class="sortparameters" style="margin-top: 10px;">
        <form action="<?= esc(current_url()) ?>" method="get">
            Cena minimalna: <input name="minprice" type="number" value="<?= esc($request->getGet('minprice')) ?>"><br>
            Cena maksymalna: <input name="maxprice" type="number" value="<?= esc($request->getGet('maxprice')) ?>"><br>
            <input type="submit" value="Sortuj">
        </form>
    </div>
</div>