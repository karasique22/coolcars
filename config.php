<?php

session_start();

// Данные для подключения к БД
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'car_dealership';

// Функция для подключения к БД
function connect_to_db()
{
    global $db_host, $db_user, $db_password, $db_name;

    // Подключаемся к БД
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Проверяем, есть ли ошибка при подключении
    if ($mysqli->connect_error) {
        die('Ошибка подключения к базе данных: ' . $mysqli->connect_error);
    }

    // Устанавливаем кодировку соединения
    $mysqli->set_charset('utf8');

    return $mysqli;
}
