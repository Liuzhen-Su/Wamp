<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学者详情</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: space-around;
            padding: 50px;
        }
        .column {
            width: 30%;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $scholar_id = $_GET["id"];
    $sql = "SELECT * FROM scholars_info WHERE id = '$scholar_id'";
    $result = $conn->query($sql);
    $scholar = $result->fetch_assoc();
    ?>
    <div class="column">
        <h1>个人简介</h1>
        <p><?php echo $scholar["intro"]; ?></p>
        <h1>学术兼职</h1>
        <p><?php echo $scholar["jobs"]; ?></p>
    </div>
    <div class="column">
        <h1>论文列表</h1>
        <?php
        $papers = explode(";", $scholar["papers"]);
        echo '<ul>';
        foreach ($papers as $paper) {
            echo '<li>' . $paper . '</li>';
        }
        echo '</ul>';
        ?>
    </div>
    <div class="column">
        <h1>Email</h1>
        <p><?php echo $scholar["email"]; ?></p>
        <h1>个人主页</h1>
        <p><a href="<?php echo $scholar["homepage"]; ?>" target="_blank"><?php echo $scholar["homepage"]; ?></a></p>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
