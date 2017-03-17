<?php
session_start();
if (!empty($_SESSION["username"])) {
    header("Location: /gasskull.ru/admin");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель администратора</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../../res/css/style.css" rel="stylesheet" media="screen">
    <link href="../../res/css/singin.css" rel="stylesheet" media="screen">
    <script src="../../res/js/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<div class="container">
    <form class="form-center-content" action="login.php" method="post">
        <div class="form-signin-heading">Вход</div>
        <div class="title center">Панель администратора</div>
        <div class="text center">Панель администратора нужна для того чтобы отвечать на вопросы клиентов (из мобильного
            приложения), редактировать сайт, список услуг
        </div>
        <label for="inputName" class="sr-only">Имя</label>
        <input name="name" type="text" id="inputName" class="form-control" placeholder="Имя" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="">

        <button name="submit" class="login-button" type="submit">Войти</button>
        <a class="register-button" href="../../">Сайт</a>
    </form>

</div>
<!-- /container -->

</body>
</html>