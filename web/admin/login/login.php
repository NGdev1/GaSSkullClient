<?php

use Services\UserServicesImpl;
use Utils\Utils;

Utils::enableLogging();

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action == 'logout'){
        session_start();
        $_SESSION['username'] = NULL;

        header("Location: /gasskull.ru/admin/login");
        exit;
    }
}

if (isset($_POST['submit'])) {
    $userServices = UserServicesImpl::getInstance();
    $state = $userServices->tryToLogin($_POST['name'], $_POST['pass']);
    if ($state == 2) {
        session_start();
        $_SESSION['username'] = $_POST['name'];

        header("Location: /gasskull.ru/admin");
        exit;
    }
}

//if no action
header("Location: /gasskull.ru/admin/login");
exit;

