<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 26.03.2017
 * Time: 20:23
 */

require_once "../../../../../../bootstrap.php";

use Factory\Factory;

$daoWorks = Factory::getWorkDao();
?>

<div id="table-container">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Работа</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>#</td>
            <td><input id="new_work_name" class="input_green"/></td>
            <td>
                <button class="button button-save" onclick="sendAjax()">Сохранить</button>
            </td>
        </tr>

        </tbody>
    </table>
</div>

<script type="text/javascript">
    function sendAjax() {
        var newWorkName = $('#new_work_name').val();
        if (!newWorkName) return;

        $.ajax({
            url: 'http://gasskull.ru/api/pricelistedit/WorksEdit.php',
            type: 'POST',
            data: {
                'action': 'add',
                'WorkName': newWorkName
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