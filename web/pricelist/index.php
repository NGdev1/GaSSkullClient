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

<div class="center bold text">Раздел:</div>
<select id="sectionSelect" style="width: 50%;" class="input_green center">
    <option value="-1">Все</option>
</select>

<div>Прайс лист:</div>

<div id="table-container">
    <table id="price_list">
        <thead>
        <tr>
            <th>#</th>
            <th>Раздел</th>
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
            $sectionName = $sectionDao->getById($item->getIdSection())->getName();
            $detailName = $detailDao->getDetailById($item->getIdDetail())->getName();

            echo <<< HTML
            <tr>
                <td>{$item->getId()}</td>
                <td>{$sectionName}</td>
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
