<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>专业检索结果</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add custom styles here */
  </style>
</head>
<body>

<!-- Navigation bar -->
<!-- Add your navigation bar code here -->

<!-- Search input -->
<div class="container mt-5">
  <div class="input-group mb-3">
    <input type="text" class="form-control" id="search_input" placeholder="请输入专业名称">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button" onclick="searchMajor()">搜索</button>
    </div>
  </div>
</div>

<!-- Search results -->
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>专业名称</th>
        <th>专业代码</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Connect to database
      $servername = "localhost";
      $username = "root";
      $password = "sr19971008";
      $dbname = "scholars";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $major_name = $_GET['major_name'];
      $sql = "SELECT id, name_major, id_major FROM majors_info_2 WHERE name_major LIKE ?";
      $stmt = $conn->prepare($sql);
      $search_term = "%" . $major_name . "%";
      $stmt->bind_param("s", $search_term);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $name_major = $row["name_major"];
        $id_major = $row["id_major"];
        echo "<tr><td>$name_major</td><td>$id_major</td><td><button class='btn btn-primary' onclick='viewSchools($id)'>查看</button></td></tr>";
      }

      $stmt->close();
      $conn->close();
      ?>
    </tbody>
  </table>
</div>

<script>
  function searchMajor() {
    let major_name = document.getElementById("search_input").value;
    if (major_name) {
      window.location.href = "major_search_result.php?major_name=" + encodeURIComponent(major_name);
    } else {
      alert("请输入专业名称");
    }
  }

  function viewSchools(id_major) {
    window.location.href = "schools.php?id_major=" + id_major;
  }
</script>

</body>
</html>
