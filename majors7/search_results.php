<?php
require_once 'db_connection.php';

function search_majors($conn, $query) {
    $sql = "SELECT id_major, name_major FROM majors_info_2 WHERE name_major LIKE ? ORDER BY name_major";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $query);
    $query = '%' . $query . '%';
    $stmt->execute();
    $result = $stmt->get_result();
    $majors = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $majors[] = array(
                'id_major' => $row['id_major'],
                'name_major' => $row['name_major']
            );
        }
    }
    return $majors;
}

$query = $_GET['query'] ?? '';
$degree = $_GET['degree'] ?? '';

if ($query) {
    $majors = search_majors($conn, $query);
} elseif ($degree) {
    $majors = get_majors_by_degree($conn, $degree);
} else {
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索结果 - 大学专业搜索</title>
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
        <div>
            <?php foreach ($majors as $major): ?>
                <div>
                    <?php echo htmlspecialchars($major['name_major']); ?> (<?php echo $major['id_major']; ?>)
                    <a href="school_list.php?id_major=<?php echo $major['id_major']; ?>">查看</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
