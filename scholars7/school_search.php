<?php
require_once("config.php");

if (isset($_GET["query"])) {
    $query = $_GET["query"];
    $sql = "SELECT id, name FROM schools_info WHERE name LIKE '%$query%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者信息检索网站 - 学校搜索结果</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">首页</a></li>
                <li><a href="schools.html">学校库</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="school-results">
            <div class="container">
                <h2>搜索结果：</h2>
                <ul>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li><a href='school.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></li>";
                        }
                    } else {
                        echo "<p>没有找到相关学校。</p>";
                    }
                    ?>
                </ul>
            </div>
        </section>
    </main>
</body>

</html>
