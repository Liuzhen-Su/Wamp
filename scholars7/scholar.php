<?php
require_once("config.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM scholars_info WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者信息检索网站 - 学者详情</title>
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
        <section id="scholar-details">
            <div class="container">
                <h2><?php echo $row["name"]; ?></h2>
                <div class="left-column">
                    <h3>个人简介</h3>
                    <p><?php echo $row["intro"]; ?></p>
                    <h3>学术兼职</h3>
                    <p><?php echo $row["jobs"]; ?></p>
                </div>
                <div class="center-column">
                    <h3>论文列表</h3>
                    <p><?php echo $row["papers"]; ?></p>
                </div>
                <div class="right-column">
                    <h3>Email</h3>
                    <p><?php echo $row["email"]; ?></p>
                    <h3>个人主页</h3>
                    <p><a href="<?php echo $row["homepage"]; ?>"><?php echo $row["homepage"]; ?></a></p>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
