<?php
require_once 'db_connection.php';

function get_degrees($conn) {
    $sql = "SELECT DISTINCT name_degree FROM majors_info_2 ORDER BY name_degree";
    $result = $conn->query($sql);
    $degrees = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $degrees[] = $row['name_degree'];
        }
    }
    return $degrees;
}

$action = $_GET['action'] ?? '';

if ($action === 'degrees') {
    $degrees = get_degrees($conn);
    echo json_encode($degrees);
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页 - 大学专业搜索</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="search-box">
            <form id="search-form">
                <input type="text" id="search-input" placeholder="请输入专业名称">
                <button type="submit">搜索</button>
            </form>
        </div>
        <div class="interactive-table">
            <div class="table-section">
                <div class="section-title">学位种类</div>
                <div id="degree-buttons"></div>
            </div>
            <div class="table-section">
                <div class="section-title">大类名称</div>
                <div id="major-categories"></div>
            </div>
            <div class="table-section">
                <div class="section-title">一级学科名称</div>
                <div id="major-disciplines"></div>
            </div>
            <div class="table-section">
                <div class="section-title">专业名称</div>
                <div id="majors"></div>
            </div>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
