<?php
//session_start();
//
//if (empty($_SESSION['username'])) {
//    header("Location: /gasskull.ru/admin/login");
//}

use Factory\Factory;

require_once "../../../../../bootstrap.php";

//\Utils\Utils::enableLogging();

$priceListDao = Factory::getPriceListDao();
$carTypeDao = Factory::getCarTypeDao();
$workDao = Factory::getWorkDao();
$sectionDao = Factory::getSectionDao();
$detailDao = Factory::getDetailDao();

?>


<div>Прайс лист:</div>

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

<script type="text/javascript">
    var sections = '{<?php echo implode(',', $sectionDao->getAll());?>}';
    var carTypes = '{<?php echo implode(',', $carTypeDao->getAll());?>}';
    var works = '{<?php echo implode(',', $workDao->getAll());?>}';
    var details = '{<?php echo implode(',', $detailDao->getAll());?>}';

    $('#price_list').Tabledit({
        url: 'http:/gasskull.ru/api/pricelistedit/',
        inputClass: 'input_green',
        buttons: {
            edit: {
                class: 'button button-edit-table',
                html: '<span class="glyphicon glyphicon-pencil"></span>',
                action: 'edit'
            },
            delete: {
                class: 'button button-edit-table',
                html: '<span class="glyphicon glyphicon-trash"></span>',
                action: 'delete'
            },
            save: {
                class: 'button button-save',
                html: 'Сохранить'
            },
            restore: {
                class: 'button btn-sm btn-warning',
                html: 'Восстановить',
                action: 'restore'
            },
            confirm: {
                class: 'button button-delete',
                html: 'Подтвердить'
            }
        },
        columns: {
            identifier: [0, 'id'],
            editable: [[1, 'Раздел', sections], [2, 'Тип авто', carTypes], [3, 'Название детали', details], [4, 'Название работы', works], [5, 'Цена']]
        }
    });

</script>
