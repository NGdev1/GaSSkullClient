<?php
session_start();

if (empty($_SESSION['username'])) {
    header("Location: http://gasskull.ru/admin/login/");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Панель администратора</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="../res/css/style.css" rel="stylesheet" media="screen">
    <link href="../res/css/table.css" rel="stylesheet" media="screen">
    <link href="../res/css/glyphicon.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../res/js/jquery.min.js"></script>
    <script src="../res/js/finder.js"></script>
    <script src="../res/js/buttonsDistributor.js"></script>
    <script src="../res/js/jquery.tabledit.js"></script>
    <script src="../res/js/jquery.tablefilter.js"></script>
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

        <div style="height: 220px; position: relative; top: -40px; left: 30px; z-index: -1; opacity: 100">
            <img class="center" style="width: 330px;" src="../res/images/Logo/Logo1.svg"/>
        </div>

    </div>

</div>

<script type="text/javascript">

    function logout() {
        window.location.href = 'login/login.php?action=logout';
    }

    function back() {
        finder.upFolders(1);
        reload();
    }

    function goDeeper(pos) {
        finder.addFolder(pos);
        reload();
    }

    function setDepth(depth) {
        finder.setDepth(depth);
        reload();
    }

    $(document).on('keyup', function(event) {
        switch (event.keyCode) {
            case 27: // Escape.
                back();
                break;
        }
    })

</script>
<!-- /container -->

</body>
</html>