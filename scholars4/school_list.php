<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学校库页</title>
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
        <h1>学校库</h1>
        <form action="search_school.php" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="输入学校名称" name="search_name">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">搜索</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <h3>按特征检索</h3>
                <button class="btn btn-outline-primary" onclick="window.location.href='search_school.php?feature=985'">985</button>
                <button class="btn btn-outline-primary" onclick="window.location.href='search_school.php?feature=211'">211</button>
                <button class="btn btn-outline-primary" onclick="window.location.href='search_school.php?feature=s16'">双一流</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>按省份检索</h3>
                <?php
                $provinces = ["北京", "天津", "上海", "重庆", "河北", "山西", "辽宁", "吉林", "黑龙江", "江苏", "浙江", "安徽", "福建", "江西", "山东", "河南", "湖北", "湖南", "广东", "海南", "四川", "贵州", "云南", "陕西", "甘肃", "青海", "台湾", "内蒙古", "广西", "西藏", "宁夏", "新疆", "香港", "澳门"];
                foreach ($provinces as $province) {
                    echo "<button class='btn btn-outline-secondary' onclick=\"window.location.href='search_school.php?province=" . $province . "'\">" . $province . "</button> ";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
