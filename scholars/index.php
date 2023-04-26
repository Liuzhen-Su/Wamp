<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者信息检索</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .search-container {
            text-align: center;
            margin-top: 100px;
        }
        .search-input {
            width: 400px;
            padding: 10px;
            font-size: 18px;
        }
        .search-button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            margin-left: 10px;
        }
        .search-button:hover {
            background-color: #45a049;
        }
        .results-container {
            margin-top: 50px;
        }
        .scholar-card {
            background-color: #f1f1f1;
            padding: 20px;
            margin: 10px;
        }
        .scholar-name {
            font-weight: bold;
            font-size: 24px;
        }
        .scholar-title {
            font-size: 18px;
            color: #666;
        }
        .scholar-research {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <form action="index.php" method="post">
            <input type="text" name="search" class="search-input" placeholder="请输入学者名字" required>
            <button type="submit" class="search-button">搜索</button>
        </form>
    </div>
    <div class="results-container">
        <?php
        include 'config.php';
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
                echo '<a href="details.php?id=' . $row["id"] . '" class="scholar-name">' . $row["name"] . '</a>';
                echo '<p class="scholar-title">' . $row["title"] . '</p>';
                echo '<p class="scholar-research">研究领域: ' . $row["research"] . '</p>';
                echo '</div>';
            }
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
