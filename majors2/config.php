<?php
$servername = "localhost";
$username = "root";
$password = "sr19971008"; // 请修改为您的MySQL密码
$dbname = "scholars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>