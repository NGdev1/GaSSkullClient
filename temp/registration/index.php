<?php
if(isset($_SESSION["username"])){
    header("Location: ../../");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель администратора</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../../css/style.css" rel="stylesheet" media="screen">
    <link href="../../css/singin.css" rel="stylesheet" media="screen">
    <script src="../../js/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<div class="container">

    <form method="POST" class="form-center-content" action="../../api/register/">
        <div class="form-signin-heading">Тестовая форма для проверки регистрации через приложение</div>
        <div class="title center">форма отправляется на api/register</div>
        <div class="text center">Эта флрма нужна для того чтобы проверять работу регистрации в приложении. Отправляется методом POST.</div>
        <div class="text center">То что вводится пользовалелем:</div>
        <label for="inputName" class="sr-only">Имя</label>
        <input name="name" type="text" value="Иван" id="inputName" class="form-control" placeholder="Имя" required="" autofocus="">

        <label for="inputCarNumber" class="sr-only">Номер авто</label>
        <input name="car_number" type="text" value="м345ун116" id="inputCarNumber" class="form-control" placeholder="Номер авто" required="">

        <label for="inputCarType" class="sr-only">Тип авто</label>
        <input name="car_type" type="text" value="1" id="inputCarType" class="form-control" placeholder="Тип авто" required="">

        <label for="inputPhone" class="sr-only">Телефон</label>
        <input name="phone_number" type="text" value="+73464735967" id="inputPhone" class="form-control" placeholder="Номер телефона ваш" required="">

        <div class="text center">Скрытые параметры:</div>

        <label for="device_id" class="sr-only">device_id</label>
        <input name="device_id" type="text" value="4254345" id="device_id" class="form-control" placeholder="device_id" required="">

        <label for="device_platform" class="sr-only">device_platform</label>
        <input name="device_platform" type="text" value="Android 5.3" id="device_id" class="form-control" placeholder="device_platform" required="">

        <label for="device_name" class="sr-only">device_name</label>
        <input name="device_name" type="text" value="Samsung Galaxy S3" id="device_name" class="form-control" placeholder="device_name" required="">

        <input name="submit" class="login-button" type="submit" value="Отправить"/>
        <a class="register-button" href="../../">Сайт</a>
    </form>

</div>
<!-- /container -->

</body>
</html>