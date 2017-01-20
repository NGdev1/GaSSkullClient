<?php

mysqli_init();
$db = new mysqli("localhost:3306", "root", "root", "auto_service");//"bNDjTuxbXZ6newX6");

if($db->connect_errno){
    echo "Не удалось подключиться к MySQL: (" . $db->connect_errno . ")" . $db->connect_error;
}

mysqli_query ($db, "set_client='utf8'");

mysqli_query ($db, "set character_set_results='utf8'");

mysqli_query ($db, "set collation_connection='utf8_general_ci'");

mysqli_query ($db, "SET NAMES utf8");