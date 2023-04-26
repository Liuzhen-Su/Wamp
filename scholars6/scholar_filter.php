<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_name = $_POST["search_name"];
    $search_feature = $_POST["search_feature"];
    $search_province = $_POST["search_province"];

    $sql = "SELECT * FROM schools_info WHERE name LIKE '%$search_name%' AND province LIKE '%$search_province%'";

    if ($search_feature == "985") {
        $sql .= " AND is_985 = 1";
    } elseif ($search_feature == "211") {
        $sql .= " AND is_211 = 1";
    } elseif ($search_feature == "双一流") {
        $sql .= " AND is_s16 = 1";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出学校搜索结果
        while ($row = $result->fetch_assoc()) {
            // 根据查询结果输出学校信息
        }
    } else {
        echo "找不到相关学校";
    }
}
$conn->close();
?>
