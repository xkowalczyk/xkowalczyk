<?php
$model = model(CategoryModel::class);
$category = $model->getCategory();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/header/style-global.css" rel="stylesheet" type="text/css">
    <link href="css/header/style-header.css" rel="stylesheet" type="text/css">
    <link href="css/import.css" rel="stylesheet" type="text/css">
    <title>XKOWALCZYK</title>
</head>
<header>
    <div class="header">

        <div class="header_top">

            <div class="header_top_logo">
                <img src="graph/ico.jpg" width="200px" height="40px">
            </div>

            <div class="header_top_search">
                <form class="header_top_search_searchform">
                    <input type="text" name="search_item" class="header_top_search_searchform_searchinput">
                    <input type="checkbox" name="item_withdesc">
                    <input type="submit">
                </form>
            </div>

            <div class="header_top_menu">
                <div class="header_top_menu_accountbutton">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAZRJREFUWEftl/ExBTEQh79XASqgE1RACVTAqwAVoAM6oAJ0QAd08FTA/EzOZDKX3OaymTkz9q8393LZ73Z/m92sWJitFsbDnwXaBq6BY0C/vewOWAObYUNrhB6AIy+KZJ974KQW6KsTjLZVdHZ6Ar0FJ/sVH/GbKWvKLBG6Am5iPQCXwIUBzB3oMQh+zLdFf+5Ap4AqZszOQ4WWAuUOdAg8ZzweAE8TaXMH6hahWLyx4KdEregoSu4amgskEFXUbVRlOtHPwvOpQsumrAVocPoaoKQdq3UFskLE67oAfYRKew+e9gBFaddA6Ar0EnRSKnvpq9RK3IA0OqhdWKx0QLoAqXfpy2ss19uagaQXaWSOSWOprpqBdN4oBXNMKdb55FplEnBOxFOQqrz0jGqO0JTT2v8XBfQZXxzSiTHXOixDVm1UhvXFIT8HpEapAUy535rreeQ9wag4stegHJAjQ3kra8r+gYYIKJeeGtG+1qvWD0O62HqPqklhE5AcCUp3bcscYwFrBrI46bamir4bRbTx4oC+AQPmWSWQyMshAAAAAElFTkSuQmCC" onclick="location.href='login'" />
                </div>

                <div class="header_top_menu_shoppingcartbutton">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAeNJREFUWEftl+ExBEEQhb+LABEgAkSACBABGSACRIAIEMGRAREgAkSACKhXNXt653Zue2d3r7au9K+7urmZb1/3vO4dMbAYDYyHhQBaA86AHUCfFY/ALXDXVvGmCp0AlzMOfQF2ga9csCZAR8CN46BWUF4gpebNwDwBV8B9SJtgpd5SWHMdvjv4y0u8QDr8OPz1FdisOClWcCUndV4gpWEjQKhGVMRVYdcdBAUbqRQDnQcllhvt4l/8DghU4JURA/34985eeRrqbzBAF4AysVhAH6FAsw3PyKELkboUU70sVUPrgAqy9/AWtdceWgPnAMm194CurOHB2kAOkFK32lqKvw3kSVvF1xygPrxqwtEWSJ5ShGakukit7wzINlDbx6rANCFoqFOo/j7Nos6AbAOV+85SyTr0PjDuA0gjq8aOIlIqxSOLxt3DPoC0p26I7d5SSqnZBpQmubLtXZqlnqOcdpYy7SsbEJSnrah2BFO8HEzd9ra3rNiwds4JU6bqJobRHp0qZNVXbWjOVqqkmBRR6lTEttbiW9gbUJ0PpX5PAunp1KeSTwDM1aklsWTXLSleaUo5njeQR/KuFfq2k0POnJNKq+dhqtaUzDUHKJXWHCDB6I134mE5QDkHu//zD1Qn1S/pFGklogH0ngAAAABJRU5ErkJggg==" />
                </div>
            </div>

        </div>

        <div class="header_down">

            <div class="header_down_menu">

                <?php if (isset($category)) foreach ($category as $category_item) : ?>
                    <div class="header_down_menu_item">

                        <div class="header_down_menu_item_ico">
                            <img src="graph/<?= esc($category_item['category_photo']) ?>" width="50px" height="50px" />
                        </div>

                        <div class="header_down_menu_item_text">
                            <span><?= esc($category_item['category_name']) ?></span><br>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</header>