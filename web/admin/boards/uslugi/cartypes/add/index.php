<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 14.03.17
 * Time: 10:48
 */


require_once "../../../../../../bootstrap.php";

use Factory\Factory;

$daoCarTypes = Factory::getCarTypeDao();
?>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Тип авто</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
<tr>
    <td>#</td>
    <td><input id="new_car_type" class="input_green"/></td>
    <td><button class="button button-save" onclick="sendAjax()">Сохранить</button></td>
</tr>

    </tbody>
</table>

<script type="text/javascript">
    function sendAjax() {
        var val = $('#new_car_type').val();
        if(!val) return;

        $.ajax({
            url: 'http:/gasskull.ru/api/pricelistedit/CarTypesEdit.php',
            type: 'POST',
            data:{
                'action': 'add',
                'CarTypeName': val
            }
        }).done(function (data) {
            var resp = JSON.parse(data);
            if(resp.status == 'ok'){
                back();
            } else {
                alert(resp.errors);
            }
        });
    }
</script>