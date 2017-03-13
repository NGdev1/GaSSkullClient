<?php
//session_start();
//
//if (empty($_SESSION['username'])) {
//    header("Location: /gasskull.ru/admin/login");
//}
//
//?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель администратора</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../css/style.css" rel="stylesheet" media="screen">
    <link href="../css/table.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/finder.js"></script>
    <script src="../js/buttonsDistributor.js"></script>
    <script src="../js/jquery.tabledit.js"></script>
</head>

<body>

<div class="container">
    <div class="center-content">

        <div class="navigation-bar">
            <div id="leftButtonContainer">
                <a id="buttonLeft" class="leftButton"></a>
            </div>

            <div id="rightButtonContainer">
                <a id="buttonRight" class="rightButton"></a>
            </div>
            <div id="title" class="title center">Панель администратора</div>
        </div>

        <div id="pathContainer">

        </div>

        <div id="content">

        </div>

        <div id="buttonsContainer">

        </div>
    </div>

</div>

<script type="text/javascript">

    function logout() {
        window.location.href = 'login/login.php?action=logout';
    }
    
    function back() {
        finder.upFolders(1);
        reloadInterface();
    }
    
    function goDeeper(pos) {
        finder.addFolder(pos);
        reloadInterface();
    }

    function setDepth(depth) {
        finder.setDepth(depth);
        reloadInterface();
    }

</script>
<!-- /container -->

</body>
</html>