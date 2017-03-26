<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 26.03.17
 * Time: 8:35
 */
require_once "../../../../../../bootstrap.php";

use Factory\Factory;

$priceListDao = Factory::getPriceListDao();
$carTypeDao = Factory::getCarTypeDao();
$workDao = Factory::getWorkDao();
$sectionDao = Factory::getSectionDao();
$detailDao = Factory::getDetailDao();
?>

<div id="table-container">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Раздел</th>
            <th>Тип авто</th>
            <th>Название детали</th>
            <th>Название работы</th>
            <th>Цена</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>#</td>
            <td><select id="sectionSelect" class="input_green"></select></td>
            <td><select id="carTypeSelect" class="input_green"></select></td>
            <td><select id="detailSelect" class="input_green"></select></td>
            <td><select id="workSelect" class="input_green"></select></td>
            <td><input id="price" class="input_green"/></td>
            <td>
                <button class="button button-save" onclick="sendAjax()">Сохранить</button>
            </td>
        </tr>

        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var sections = JSON.parse('{<?php echo implode(',', $sectionDao->getAll());?>}');
        var carTypes = JSON.parse('{<?php echo implode(',', $carTypeDao->getAll());?>}');
        var works = JSON.parse('{<?php echo implode(',', $workDao->getAll());?>}');
        var details = JSON.parse('{<?php echo implode(',', $detailDao->getAll());?>}');

        var sectionSelect = $('#sectionSelect');
        var carTypeSelect = $('#carTypeSelect');
        var detailSelect = $('#detailSelect');
        var workSelect = $('#workSelect');
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

        for (key in carTypes) {
            if (carTypes.hasOwnProperty(key)) {
                var newCarType = $('<option/>', {
                    text: carTypes[key],
                    'value': key
                });

                carTypeSelect.append(newCarType);
            }
        }

        for (key in works) {
            if (works.hasOwnProperty(key)) {
                var newWork = $('<option/>', {
                    text: works[key],
                    'value': key
                });

                workSelect.append(newWork);
            }
        }

        for (key in details) {
            if (details.hasOwnProperty(key)) {
                var newDetail = $('<option/>', {
                    text: details[key],
                    'value': key
                });

                detailSelect.append(newDetail);
            }
        }
    });

    function sendAjax() {
        var price = $('#price').val();
        var sectionId = $('#sectionSelect').find('option:selected').val();
        var detailId = $('#detailSelect').find('option:selected').val();
        var carTypeId = $('#carTypeSelect').find('option:selected').val();
        var workId = $('#workSelect').find('option:selected').val();

        if (!price) return;

        $.ajax({
            url: 'http://gasskull.ru/api/pricelistedit/',
            type: 'POST',
            data: {
                'action': 'add',
                'DetailId': detailId,
                'SectionId': sectionId,
                'CarTypeId': carTypeId,
                'WorkId': workId,
                'Price': price
            }
        }).done(function (data) {
            var resp = JSON.parse(data);
            if (resp.status == 'ok') {
                back();
            } else {
                alert(resp.errors);
            }
        });
    }
</script>