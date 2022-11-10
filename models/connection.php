<?php

function connect()
{
    try {
        $connect = new PDO("mysql:host=" . _DB_HOST . ";dbname=" . _DB_NAME . ";charset=utf8mb4", _DB_USER, _DB_PASS);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Success';
        return $connect;
    } catch (PDOException $e) {
        echo 'Error when connecting: ' . $e->getMessage();
    }
}