<?php

require_once "../../../bootstrap.php";

use Factory\Factory;
use Utils\Utils;

Utils::enableLogging();

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action == 'logout'){
        session_start();
        $_SESSION['username'] = NULL;

        header("Location: http://gasskull.ru/admin/login");
        exit;
    }
}

if (isset($_POST['submit'])) {
    $adminServices = Factory::getAdminService();
    $state = $adminServices->tryToLogin($_POST['name'], $_POST['pass']);
    if ($state == 2) {
        session_start();
        $_SESSION['username'] = $_POST['name'];

        header("Location: http://gasskull.ru/admin");
        exit;
    }
}

//if no action
header("Location: http://gasskull.ru/admin/login");
exit;

