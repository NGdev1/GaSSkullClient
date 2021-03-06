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
?>

<div id="table-container">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Деталь</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>#</td>
            <td><input id="new_detail_name" class="input_green"/></td>
            <td>
                <button class="button button-save" onclick="sendAjax()">Сохранить</button>
            </td>
        </tr>

        </tbody>
    </table>
</div>

<script type="text/javascript">
    function sendAjax() {
        var newDetailName = $('#new_detail_name').val();
        if (!newDetailName) return;

        $.ajax({
            url: 'http://gasskull.ru/api/pricelistedit/DetailsEdit.php',
            type: 'POST',
            data: {
                'action': 'add',
                'DetailName': newDetailName
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