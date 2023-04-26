<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 数据库连接信息
$servername = "localhost";
$username = "root";
$password = "sr19971008"; // 如果设置了密码，请在这里填写
$dbname = "scholars";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 设置字符集
$conn->set_charset("utf8");

// 从请求中获取搜索关键字
$requestData = json_decode(file_get_contents("php://input"), true);
$searchKeyword = $requestData["search"];

// 查询专业信息
$sql = "SELECT name_major, id_major FROM majors_info WHERE name_major LIKE ?";
$stmt = $conn->prepare($sql);
$likeKeyword = "%" . $searchKeyword . "%";
$stmt->bind_param("s", $likeKeyword);
$stmt->execute();
$result = $stmt->get_result();

// 输出查询结果
$results = array();
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

echo json_encode($results);

// 关闭连接
$stmt->close();
$conn->close();
?>