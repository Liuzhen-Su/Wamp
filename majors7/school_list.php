<?php
require_once 'db_connection.php';

function get_major_info($conn, $id_major) {
    $sql = "SELECT name_major, id_major, school_list FROM majors_info_2 WHERE id_major = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_major);
    $stmt->execute();
    $result = $stmt->get_result();
    $major_info = null;

    if ($result->num_rows > 0) {
        $major_info = $result->fetch_assoc();
        $major_info['school_list'] = json_decode($major_info['school_list'], true);
    }
    return $major_info;
}

$id_major = $_GET['id_major'] ?? '';

if (!$id_major) {
    header('Location: index.php');
    exit();
}

$major_info = get_major_info($conn, $id_major);

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($major_info['name_major']); ?> - 开设院校 - 大学专业搜索</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($major_info['name_major']); ?> (<?php echo $major_info['id_major']; ?>)</h1>
        <div>
            <?php foreach ($major_info['school_list'] as $school): ?>
                <div>
                    <a href="baidu.com" target="_blank"><?php echo htmlspecialchars($school['name']); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
