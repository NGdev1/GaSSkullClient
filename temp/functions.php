<?php

function tryToLogin($name, $password)
{
    include "db.php";

    if ($name == null || $password == null) return false;
    if ($name == '') return false;

    if (!$stmt = $db->prepare("SELECT login, password FROM admin WHERE login=?;")) {
        echo "Не удалось подготовить запрос (" . $db->errno . ") " . $db->error;
    }

    if (!$stmt->bind_param("s", $name)) {
        echo "Не удалось привязать параметры (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Не удалось выполнить запрос (" . $db->errno . ") " . $db->error;
    }

    if (!$result = $stmt->get_result()) {
        echo "Не удалось получить результат (" . $db->errno . ") " . $db->error;
    }

    if (md5($result->fetch_assoc()['password']) == md5($password)) {
        return true;
    } else return false;
}

function showAllUsers(){
    include "temp/db.php";
    if(!$stmt = $db->prepare("SELECT * FROM users")){
        echo "Не удалось подготовить запрос (" . $db->errno . ") " . $db->error;
    }

    if(!$stmt->execute()){
        echo "Не удалось выполнить запрос (" . $db->errno . ") " . $db->error;
    }

    if(!$result = $stmt->get_result()){
        echo "Не удалось получить результат (" . $db->errno . ") " . $db->error;
    }

    while ($myrow = $result->fetch_assoc()) {
        echo <<<HERE
                        <div>$myrow[device_name]</div>
                        <div>$myrow[device_platform]</div>
                        <br/>
HERE;

    }
}

