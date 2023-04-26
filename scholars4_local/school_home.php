<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学校主页</title>
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
        $school_id = $_GET['id'];
        $school_name = "";

        $sql_school = "SELECT name FROM schools_info WHERE id = '$school_id'";
        $result_school = $conn->query($sql_school);
        if ($result_school->num_rows > 0) {
            $row_school = $result_school->fetch_assoc();
            $school_name = $row_school['name'];
            echo "<h1>" . $school_name . "</h1>";
        } else {
            echo "没有找到相关学校";
        }
        ?>
        <div class="row">
            <div class="col-md-3">
                <?php
                $sql_college = "SELECT DISTINCT college FROM scholars_info WHERE school = '$school_name'";
                $result_college = $conn->query($sql_college);

                if ($result_college->num_rows > 0) {
                    while ($row_college = $result_college->fetch_assoc()) {
                        echo "<button class='btn btn-outline-secondary mb-2' onclick=\"window.location.href='school_home.php?id=" . $school_id . "&college=" . urlencode($row_college['college']) . "'\">" . $row_college['college'] . "</button><br>";
                    }
                } else {
                    echo "没有找到相关学院";
                }
                ?>
            </div>
            <div class="col-md-9">
                <?php
                $college = isset($_GET['college']) ? urldecode($_GET['college']) : "";

                if (!empty($college)) {
                    $sql_scholar = "SELECT id, name, title FROM scholars_info WHERE school = '$school_name' AND college = '$college'";
                    $result_scholar = $conn->query($sql_scholar);

                    if ($result_scholar->num_rows > 0) {
                        while ($row_scholar = $result_scholar->fetch_assoc()) {
                            echo "<a href='scholar_details.php?id=" . $row_scholar['id'] . "'>" . $row_scholar['name'] . " - " . $row_scholar['title'] . "</a><br>";
                        }
                    } else {
                        echo "没有找到相关学者";
                    }
                } else {
                    echo "请选择学院";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

