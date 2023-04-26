<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_name = $_POST["search_name"];
    
    $sql = "SELECT * FROM scholars_info WHERE name LIKE '%$search_name%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出搜索结果
        while($row = $result->fetch_assoc()) {
            // 根据查询结果输出学者信息
        }
    } else {
        echo "找不到相关学者";
    }
}
$conn->close();
?>
