<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者信息检索网站</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">首页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="school_list.php">学校库</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h1>学者信息检索</h1>
        <div class="search-container">
            <form action="index.php" method="post">
                <input type="text" name="search" class="search-input" placeholder="请输入学者名字" required>
                <button type="submit" class="search-button">搜索</button>
            </form>
        </div>
        <div class="results-container">
            <?php
            include 'db.php';
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("连接失败: " . $conn->connect_error);
            }
            $results = false;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $search_query = $_POST["search"];
                $search_query = $conn->real_escape_string($search_query);
                $sql = "SELECT id, name, title, research FROM scholars_info WHERE name LIKE '%$search_query%'";
                $query_results = $conn->query($sql);
                if ($query_results && $query_results->num_rows > 0) {
                    $results = $query_results;
                } else {
                    echo "没有找到相关学者。";
                }
            }
            if ($results) {
                while ($row = $results->fetch_assoc()) {
                    echo '<div class="scholar-card">';
                    echo '<a href="scholar_details.php?id=' . $row["id"] . '" class="scholar-name">' . $row["name"] . '</a>';
                    echo '<p class="scholar-title">' . $row["title"] . '</p>';
                    echo '<p class="scholar-research">研究领域: ' . $row["research"] . '</p>';
                    echo '</div>';
                }
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
