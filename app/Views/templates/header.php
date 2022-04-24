<?php

use App\Libraries\Services\CategoryService;
use App\Libraries\Services\SessionService;

$categoryService = new CategoryService();
$sessionService = new SessionService();

$category = $categoryService->getCategory();
$isLogged = $sessionService->checkIssetSession('userLogged');

helper('html');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= esc(base_url()) ?>/css/style-global.css" rel="stylesheet" type="text/css">
    <link href="<?= esc(base_url()) ?>/css/header/style-header.css" rel="stylesheet" type="text/css">
    <link href="<?= esc(base_url()) ?>/css/import.css" rel="stylesheet" type="text/css">
    <title>XKOWALCZYK</title>
</head>
<header>
    <div class="header">

        <div class="header_top">

            <div class="header_top_logo" onclick='location.href="<?= esc(base_url()); ?>"'>
                <img src="<?= esc(base_url())?>/graph/ico.jpg" width="200px" height="40px">
            </div>

            <div class="header_top_search">
                <form method="GET" action="<?= esc(base_url()) ?>/ProductList/filter" class="header_top_search_searchform">
                    <input type="text" name="search_item" class="header_top_search_searchform_searchinput">
                    <input type="checkbox" name="item_withdesc">
                    <input type="submit">
                </form>
            </div>

            <div class="header_top_menu">
                <?php if ($isLogged == false) { ?>
                    <div class="header_top_menu_accountbutton">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAZRJREFUWEftl/ExBTEQh79XASqgE1RACVTAqwAVoAM6oAJ0QAd08FTA/EzOZDKX3OaymTkz9q8393LZ73Z/m92sWJitFsbDnwXaBq6BY0C/vewOWAObYUNrhB6AIy+KZJ974KQW6KsTjLZVdHZ6Ar0FJ/sVH/GbKWvKLBG6Am5iPQCXwIUBzB3oMQh+zLdFf+5Ap4AqZszOQ4WWAuUOdAg8ZzweAE8TaXMH6hahWLyx4KdEregoSu4amgskEFXUbVRlOtHPwvOpQsumrAVocPoaoKQdq3UFskLE67oAfYRKew+e9gBFaddA6Ar0EnRSKnvpq9RK3IA0OqhdWKx0QLoAqXfpy2ss19uagaQXaWSOSWOprpqBdN4oBXNMKdb55FplEnBOxFOQqrz0jGqO0JTT2v8XBfQZXxzSiTHXOixDVm1UhvXFIT8HpEapAUy535rreeQ9wag4stegHJAjQ3kra8r+gYYIKJeeGtG+1qvWD0O62HqPqklhE5AcCUp3bcscYwFrBrI46bamir4bRbTx4oC+AQPmWSWQyMshAAAAAElFTkSuQmCC" onclick="location.href='<?= esc(base_url()) ?>/login'" />
                    </div>
                <?php } else { ?>
                    <div class="header_top_menu_accountbutton">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAdZJREFUWEfVl9FVwkAQRd/LYfMrViCdCBVoCVoBUIFQAdABdqAViB1oB9gB/hJPnmcFYpCEbMhG434mk9mbN7MzO0TDFhvGg/8JJKAdBcGE0jWAti9VRc5NHA8JrHY+nRSKyAcAV75A0n5E3odxfFMWSHXAbH2ujHReJ9ArNiG4dP0JIyWRcg1ZsULSuAVM0/kQASOQd0VgdQA9mk3CHyyX/PMOJOk2BOZZQGtgQHJyTCXvQJB6BlhkKgR0QT79KlBtCkVkkrxpGdPPc/50YaSe9xyqAARIoxYw250yW90/gD7I0cmnrBLQ964v2zrULQLZvc9Nak9ArhyJXS1AAt5ALhjHS7uTgqADqUvgoojQN9CzzZ+CY2/zKLeVeAOSNAyBaZEC9v2xAukHSBob26tKrLzeVhnI5ksodUqwJKZrcvkzryoDgZyZOB6cAhQFwRRSP/1tdSDbt6TM3lUISdr6tFejfAAV7lvGoGlA70ZKBoe9G+ORSv03l/w8oK9GSdoLmI39WZlwHLO1E4c9HLljUB6QLwAXP04hc3Hky6bxQHae8pYjVrX0kXZRcV8hxznKxXHW5cvlu4NB0TZAkTcu9xiXDSop5LJB3TZOo3TdEGn/jQP6BF8PHDSPkS2HAAAAAElFTkSuQmCC" onclick="location.href='<?= esc(base_url()) ?>/account'" />
                    </div>
                <?php } ?>

                <div class="header_top_menu_shoppingcartbutton">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAeNJREFUWEftl+ExBEEQhb+LABEgAkSACBABGSACRIAIEMGRAREgAkSACKhXNXt653Zue2d3r7au9K+7urmZb1/3vO4dMbAYDYyHhQBaA86AHUCfFY/ALXDXVvGmCp0AlzMOfQF2ga9csCZAR8CN46BWUF4gpebNwDwBV8B9SJtgpd5SWHMdvjv4y0u8QDr8OPz1FdisOClWcCUndV4gpWEjQKhGVMRVYdcdBAUbqRQDnQcllhvt4l/8DghU4JURA/34985eeRrqbzBAF4AysVhAH6FAsw3PyKELkboUU70sVUPrgAqy9/AWtdceWgPnAMm194CurOHB2kAOkFK32lqKvw3kSVvF1xygPrxqwtEWSJ5ShGakukit7wzINlDbx6rANCFoqFOo/j7Nos6AbAOV+85SyTr0PjDuA0gjq8aOIlIqxSOLxt3DPoC0p26I7d5SSqnZBpQmubLtXZqlnqOcdpYy7SsbEJSnrah2BFO8HEzd9ra3rNiwds4JU6bqJobRHp0qZNVXbWjOVqqkmBRR6lTEttbiW9gbUJ0PpX5PAunp1KeSTwDM1aklsWTXLSleaUo5njeQR/KuFfq2k0POnJNKq+dhqtaUzDUHKJXWHCDB6I134mE5QDkHu//zD1Qn1S/pFGklogH0ngAAAABJRU5ErkJggg==" onclick="location.href='<?= esc(base_url()) ?>/bin'"/>
                </div>
            </div>

        </div>

        <div class="header_down">

            <div class="header_down_menu">

                <?php if (isset($category)) foreach ($category as $categoryItem) : ?>
                    <div class="header_down_menu_item" onclick='location.href="<?= esc(base_url()) ?>/ProductList/filter/c-<?= esc($categoryItem['category_id']) ?>"'>
                        <div class="header_down_menu_item_ico">
                            <?= img("graph/category/{$categoryItem['category_photo']}", false, ['width' => '50', 'height' => '50']); ?>
                        </div>
                        <div class="header_down_menu_item_text">
                            <span><?= esc($categoryItem['category_name']) ?></span><br>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</header>