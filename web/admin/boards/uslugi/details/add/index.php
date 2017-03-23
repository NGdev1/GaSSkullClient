<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 23.03.17
 * Time: 21:20
 */
require_once "../../../../../../bootstrap.php";

use Factory\Factory;

$daoDetails = Factory::getDetailDao();
$sectionDao = Factory::getSectionDao();
?>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Деталь</th>
        <th>Раздел</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>#</td>
        <td><input id="new_detail_name" class="input_green"/></td>
        <td><select id="sectionSelect" class="input_green"></select></td>
        <td>
            <button class="button button-save" onclick="sendAjax()">Сохранить</button>
        </td>
    </tr>

    </tbody>
</table>

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
    });

    function sendAjax() {
        var newDetailName = $('#new_detail_name').val();
        var sectionId = $('#sectionSelect').find('option:selected').val();
        if (!newDetailName) return;

        $.ajax({
            url: 'http://gasskull.ru/api/pricelistedit/DetailsEdit.php',
            type: 'POST',
            data: {
                'action': 'add',
                'DetailName': newDetailName,
                'IdSection': sectionId
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