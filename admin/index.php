<?php
include "../db/functions.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../admin/login");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель администратора</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../css/style.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../js/jquery.min.js"></script>
</head>

<body>

<div class="container">
    <div class="center-content">
        <div class="title">Панель администратора</div>

        <div>Пользователи:</div>
        <?php
        showAllUsers();
        ?>
    </div>
</div>
<!-- /container -->

</body>
</html>