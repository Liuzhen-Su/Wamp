<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>专业检索</title>
  <link rel="stylesheet" href="scripts\bootstrap.min.css">
  <script src="scripts\jquery.min.js"></script>
  <script src="scripts\popper.min.js"></script>
  <script src="scripts\bootstrap.min.js"></script>
  <style>
    /* Add custom styles here */
  </style>
</head>
<body>

<!-- Navigation bar -->
<!-- Add your navigation bar code here -->
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
<!-- Search input -->
<div class="container mt-5">
  <div class="input-group mb-3">
    <input type="text" class="form-control" id="search_input" placeholder="请输入专业名称">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button" onclick="searchMajor()">搜索</button>
    </div>
  </div>
</div>

<!-- Degree category buttons -->
<div class="container">
  <div class="btn-group btn-group-toggle">
    <?php
    $degree_categories = ['学术型硕士', '专业学位硕士', '学术型博士', '专业学位博士'];
    foreach ($degree_categories as $degree) {
      echo "<button type='button' class='btn btn-outline-primary' onclick='loadMajorCategories(\"$degree\")'>$degree</button>";
    }
    ?>
  </div>
</div>

<!-- Major categories, disciplines and majors -->
<div class="container mt-3">
  <div class="row">
    <div class="col-md-4" id="major_categories">
      <!-- Major categories will be loaded here -->
    </div>
    <div class="col-md-4" id="disciplines">
      <!-- Disciplines will be loaded here -->
    </div>
    <div class="col-md-4" id="majors">
      <!-- Majors will be loaded here -->
    </div>
  </div>
</div>

<script>
  // Add JavaScript functions here
  function searchMajor() {
  const major_name = $("#search_input").val();
  if (major_name.trim() === "") {
    alert("请输入专业名称");
    return;
  }
  window.location.href = "major_search_result.php?major_name=" + encodeURIComponent(major_name);
}

function loadMajorCategories(degree) {
  $.ajax({
    type: "GET",
    url: "get_major_categories.php",
    data: { degree: degree },
    success: function (response) {
      $("#major_categories").html(response);
      $("#disciplines").empty();
      $("#majors").empty();
    }
  });
}

function loadDisciplines(major_category) {
  $.ajax({
    type: "GET",
    url: "get_disciplines.php",
    data: { major_category: major_category },
    success: function (response) {
      $("#disciplines").html(response);
      $("#majors").empty();
    }
    });
  }

function loadMajors(discipline) {
  $.ajax({
    type: "GET",
    url: "get_majors.php",
    data: { discipline: discipline },
    success: function (response) {
    $("#majors").html(response);
    }
});
}

function viewSchools(id_major) {
  window.location.href = "schools.php?id_major=" + id_major;
}
</script>
</body>
</html>
