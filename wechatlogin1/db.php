<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'sr19971008';
$dbName = 'scholars';

// 创建数据表
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  openid VARCHAR(255) NOT NULL UNIQUE
)";

if (!$conn->query($sql)) {
  die("创建数据表失败: " . $conn->error);
}

$conn->close();
?>