<?php
require_once("config.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM schools_info WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者信息检索网站 - 学校主页</title>
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
        <section id="school-page">
            <div class="container">
                <h1><?php echo $row["name"]; ?></h1>
                <div class="left-column">
                    <h3>学院列表</h3>
                    <ul>
                        <?php
                        $sql_colleges = "SELECT DISTINCT college FROM scholars_info WHERE school = '{$row["name"]}'";
                        $result_colleges = $conn->query($sql_colleges);
                        while ($row_colleges = $result_colleges->fetch_assoc()) {
                            echo "<li><a href='school.php?id=" . $id . "&college=" . urlencode($row_colleges["college"]) . "'>" . $row_colleges["college"] . "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="right-column">
                    <h3>学者列表</h3>
                    <ul>
                        <?php
                        if (isset($_GET["college"])) {
                            $selected_college = urldecode($_GET["college"]);
                            $sql_scholars = "SELECT id, name, title FROM scholars_info WHERE school = '{$row["name"]}' AND college = '{$selected_college}'";
                            $result_scholars = $conn->query($sql_scholars);
                            while ($row_scholars = $result_scholars->fetch_assoc()) {
                                echo "<li><a href='scholar.php?id=" . $row_scholars["id"] . "'>" . $row_scholars["name"] . " (" . $row_scholars["title"] . ")</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
