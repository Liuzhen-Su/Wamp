<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scholar_id = $_POST["scholar_id"];

    $sql = "SELECT * FROM scholars_info WHERE id = '$scholar_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出学者详细信息
        $row = $result->fetch_assoc();
        // 根据查询结果输出学者信息，如个人简介、论文列表等
    } else {
        echo "找不到相关学者";
    }
}
$conn->close();
?>
