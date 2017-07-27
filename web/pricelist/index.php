<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 15.04.17
 * Time: 16:26
 */
use Factory\Factory;

require_once "../../bootstrap.php";

//\Utils\Utils::enableLogging();

$priceListDao = Factory::getPriceListDao();
$carTypeDao = Factory::getCarTypeDao();
$workDao = Factory::getWorkDao();
$sectionDao = Factory::getSectionDao();
$detailDao = Factory::getDetailDao();

?>

<!DOCTYPE html>
<html>
<head>
    <title>GaSSkull</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../res/css/site/style.css" rel="stylesheet" media="screen">
    <link href="../res/css/style.css" rel="stylesheet" media="screen">
    <link href="../res/css/table.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../res/js/jquery.min.js"></script>
</head>

<body>

<div class="header-background-big animated-element">
    <div class="image-top-logo"></div>
    <div class="text-top-left">Высокая гора</div>
    <div class="text-top-right">Казань</div>
    <div class="text-phone">+7(945)2345435</div>
</div>
<div class="header-margin"></div>

<div id="content">

    <div class="container">

        <div>Прайс лист:</div>

        <div id="table-container">
            <table id="price_list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Тип авто</th>
                    <th>Название детали</th>
                    <th>Название работы</th>
                    <th>Цена</th>
                </tr>
                </thead>

                <tbody>

                <?php
                $i = 0;
                $priceList = $priceListDao->getAllServices();

                foreach ($priceList as $item) {

                    $carType = $carTypeDao->getCarTypeById($item->getIdCarType())->getName();
                    $workName = $workDao->getById($item->getIdWork())->getName();
                    $detailName = $detailDao->getDetailById($item->getIdDetail())->getName();

                    echo <<< HTML
            <tr>
                <td>{$item->getId()}</td>
                <td>{$carType}</td>
                <td>{$detailName}</td>
                <td>{$workName}</td>
                <td>{$item->getPrice()}</td>
            </tr>
HTML;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container center">
    <button class="button-secondary" onclick="loadContent('pricelist/', 'Прайс-лист')">Прайс-лист</button>
    <button class="button-secondary">Записаться</button>
    <button class="button-secondary">Написать</button>
    <button class="button-secondary">Приложение</button>
</div>

<div class="footer">
    <div class="text-site center">Низкие цены, высокое качество.</div>
</div>

<div class="image-bottom-logo center"></div>
<!-- /container -->
</body>
</html>
