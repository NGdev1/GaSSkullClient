<?php

include "../../temp/functions.php";

if (isset($_POST['submit'])) {
    if (tryToLogin($_POST['name'], $_POST['pass'])) {
        session_start();
        $_SESSION['username'] = $_POST['name'];

        header("Location: ../../admin");
        exit;
    } else {
        header("Location: ../");
    }
}
else{
    header("Location: ../");
}

