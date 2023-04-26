<?php
$host = 'localhost';
$user = 'root';
$password = 'sr19971008';
$db_name = 'scholars';

$connection = new mysqli($host, $user, $password, $db_name);

if ($connection->connect_error) {
    die('连接失败: ' . $connection->connect_error);
}
?>
