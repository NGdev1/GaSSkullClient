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

<!--suppress ALL -->
<script type="text/javascript">
    $(document).ready(function () {
        var sections = JSON.parse('{<?php echo implode(',', $sectionDao->getAll());?>}');
        var sectionSelect = $('#sectionSelect');
        var key;

        for (key in sections) {
            if (sections.hasOwnProperty(key)) {
                var newOption = $('<option/>', {
                    text: sections[key],
                    'value': key
                });

                sectionSelect.append(newOption);
            }
        }

        sectionSelect.change(function () {
            var selectedSection = sectionSelect.find('option:selected');
            var filter = '';
            if (selectedSection.val() != -1) {
                filter = selectedSection.text();
            }

            filterTable($('#price_list').find('tbody'), filter, 'tabledit-span', 'text-muted');
        })
    })
</script>

<div class="center bold text">Раздел:</div>
<select id="sectionSelect" style="width: 50%;" class="input_green center">
    <option value="-1">Все</option>
</select>

<div>Прайс лист:</div>

<div id="table-container">
    <table id="price_list">
        <thead>
        <tr>
            <th onclick="sortTable($('#price_list').find('tbody'), 0, 'tabledit-span', 'number')">#</th>
            <th onclick="sortTable($('#price_list').find('tbody'), 1, 'tabledit-span', 'string')">Раздел</th>
            <th onclick="sortTable($('#price_list').find('tbody'), 2, 'tabledit-span', 'string')">Тип авто</th>
            <th onclick="sortTable($('#price_list').find('tbody'), 3, 'tabledit-span', 'string')">Название детали</th>
            <th onclick="sortTable($('#price_list').find('tbody'), 4, 'tabledit-span', 'string')">Название работы</th>
            <th onclick="sortTable($('#price_list').find('tbody'), 5, 'tabledit-span', 'number')">Цена</th>
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

<div style="margin: 30px"></div>

<script type="text/javascript">
    var sections = '{<?php echo implode(',', $sectionDao->getAll());?>}';
    var carTypes = '{<?php echo implode(',', $carTypeDao->getAll());?>}';
    var works = '{<?php echo implode(',', $workDao->getAll());?>}';
    var details = '{<?php echo implode(',', $detailDao->getAll());?>}';

    $('#price_list').Tabledit({
        url: 'http://gasskull.ru/api/pricelistedit/',
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
            editable: [[1, 'SectionId', sections], [2, 'CarTypeId', carTypes], [3, 'DetailId', details], [4, 'WorkId', works], [5, 'Price']]
        }
    });

</script>
