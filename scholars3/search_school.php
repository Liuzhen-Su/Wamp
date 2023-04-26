<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索结果</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .navbar {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }
        .container {
            margin-top: 80px;
        }
    </style>
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
        <h1>搜索结果</h1>
        <div class="row">
            <?php
            include 'db.php';

            $search_name = isset($_POST['search_name']) ? $_POST['search_name'] : "";
            $province = isset($_GET['province']) ? $_GET['province'] : "";
            $feature = isset($_GET['feature']) ? $_GET['feature'] : "";

            if (!empty($search_name)) {
                $sql = "SELECT * FROM schools_info WHERE name LIKE '%$search_name%'";
            } elseif (!empty($province)) {
                $sql = "SELECT * FROM schools_info WHERE province = '$province'";
            } elseif (!empty($feature)) {
                if ($feature === "985") {
                    $sql = "SELECT * FROM schools_info WHERE is_985 = 1";
                } elseif ($feature === "211") {
                    $sql = "SELECT * FROM schools_info WHERE is_211 = 1";
                } elseif ($feature === "s16") {
                    $sql = "SELECT * FROM schools_info WHERE is_s16 = 1";
                }
            } else {
                $sql = "SELECT * FROM schools_info";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='card mb-4'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'><a href='school_home.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></h5>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "没有找到相关学校";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>

