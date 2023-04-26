<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者详情页</title>
    <link rel="stylesheet" href="scripts\bootstrap.min.css">
    <script src="scripts\jquery.min.js"></script>
    <script src="scripts\popper.min.js"></script>
    <script src="scripts\bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">首页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="school_list.php">学校库</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="major_search.php">专业库</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ScholarGPT.html">ScholarGPT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="zhiku.html">智库服务</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <?php
        include 'db.php';

        $id = $_GET['id'];

        $sql = "SELECT * FROM scholars_info WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='row'>";
            echo "<div class='col-md-4'>";
            echo "<h3>个人简介</h3>";
            echo "<p>" . $row['intro'] . "</p>";
            echo "<h3>学术兼职</h3>";
            echo "<p>" . $row['jobs'] . "</p>";
            echo "</div>";
            echo "<div class='col-md-4'>";
            echo "<h3>论文列表</h3>";
            echo "<p>" . $row['papers'] . "</p>";
            echo "</div>";
            echo "<div class='col-md-4'>";
            echo "<h3>Email</h3>";
            echo "<p>" . $row['email'] . "</p>";
            echo "<h3>个人主页</h3>";
            echo "<p><a href='" . $row['homepage'] . "'>" . $row['homepage'] . "</a></p>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "没有找到相关学者";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
