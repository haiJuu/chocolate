<?php
// PDO sql連線指令
$dsn = "mysql:host=localhost;dbname=expstore;charset=utf8";
$user = "haijuu";
$password = "820918";
$link = new PDO($dsn, $user, $password);

// 設置字符集
$link->exec("SET NAMES utf8");

date_default_timezone_set('Asia/Taipei');
