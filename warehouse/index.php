<?php
include 'config.php';

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$results = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST["search"];
    $search_query = $conn->real_escape_string($search_query);

    $sql = "SELECT id, id_xmol, name, title, email, homepage, intro, research, jobs, papers FROM scholars_info WHERE name LIKE '%$search_query%'";
    $query_results = $conn->query($sql);

    if ($query_results && $query_results->num_rows > 0) {
        $results = $query_results;
    } else {
        echo "没有找到相关学者。";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>学者信息检索</title>
</head>
<body>
    <form method="post">
        <input type="text" name="search" placeholder="搜索学者信息...">
        <input type="submit" value="搜索">
    </form>
    <?php if (isset($results)): ?>
        <?php while ($row = $results->fetch_assoc()): ?>
            <p>
                <strong><a href="scholar.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></strong><br>
                <?php echo $row['id_xmol']; ?>, <?php echo $row['email']; ?><br>
                职称: <?php echo $row['title']; ?><br>
                研究领域: <?php echo $row['research']; ?><br>
            </p>
            <hr>
        <?php endwhile; ?>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
