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
        <h1>学者信息检索</h1>
        <form action="search_scholar.php" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="输入学者姓名" name="search_name">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">搜索</button>
                </div>
            </div>
        </form>
        <div id="search_results">
            <!-- 搜索结果将在这里显示 -->
        </div>
    </div>
</body>
</html>
