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
    include "db/db.php";
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

function generate_password($length)
{
    $arr = array(
        '1','2','3','4','5','6', '7','8','9','0'
    );
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $length; $i++)
    {
        // Вычисляем случайный индекс массива
        $index = rand(0, count($arr) - 1);
        $pass .= $arr[$index];
    }
    return $pass;
}

function delete_user_with_device($deviceId, $errors){
    include "db.php";
    if (!$stmt = $db->prepare("DELETE FROM auto_service.users WHERE 
device_id = ?;")
    ) {
        $errors[] = "Не удалось подготовить запрос (" . $db->errno . ") " . $db->error;
        return;
    }

    if (!$stmt->bind_param(
        "s",
        $deviceId
    )
    ) {
        $errors[] = "Не удалось привязать параметры (" . $stmt->errno . ") " . $stmt->error;
        return;
    }

    if (!$stmt->execute()) {
        $errors[] = "Не удалось выполнить запрос (" . $db->errno . ") " . $db->error;
        return;
    }
}

